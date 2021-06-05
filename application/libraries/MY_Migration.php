<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @copyright  Copyright (c) 2013 - 2015, Michel Roca (https://github.com/mRoca)
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Migration extends CI_Migration
{
    /**
     * Whether the library is enabled
     *
     * @var bool
     */
    protected $_migration_enabled = FALSE;

    /**
     * Migration numbering type
     *
     * @var    bool
     */
    protected $_migration_type = 'sequential';

    /**
     * Path to migration classes
     *
     * @var string
     */
    protected $_migration_path = NULL;

    /**
     * Current migration version
     *
     * @var mixed
     */
    protected $_migration_version = 0;

    /**
     * Database table with migration info
     *
     * @var string
     */
    protected $_migration_table = 'migrations';

    /**
     * Whether to automatically run migrations
     *
     * @var    bool
     */
    protected $_migration_auto_latest = FALSE;

    /**
     * Migration basename regex
     *
     * @var string
     */
    protected $_migration_regex;

    /**
     * Error message
     *
     * @var string
     */
    protected $_error_string = '';

    /**
     * Current module
     *
     * @var string
     */
    protected $_current_module = '';

    /**
     * Configs
     *
     * @var array
     */
    protected $_core_config = [];

    /**
     * Initialize Migration Class
     *
     * @param array $config
     * @return void
     */
    public function __construct($config = [])
    {
        // Only run this constructor on main library load
        if (! in_array(get_class($this), ['CI_Migration', config_item('subclass_prefix').'Migration'], true))
        {
            return;
        }

        foreach ($config as $key => $val)
        {
            $this->{'_'.$key} = $val;
        }

        $this->_core_config = $config; // Load configs
        $this->init_module(); // Initialize module load

        log_message('info', 'Migrations Class Initialized');

        // Are they trying to use migrations while it is disabled?
        if ($this->_migration_enabled !== TRUE)
        {
            show_error('Migrations has been loaded but is disabled or set up incorrectly.');
        }

        // If not set, set it
        $this->_migration_path !== '' || $this->_migration_path = APPPATH.'migrations/';

        // Add trailing slash if not set
        $this->_migration_path = rtrim($this->_migration_path, '/').'/';

        // Load migration language
        $this->lang->load('migration');

        // They'll probably be using dbforge
        $this->load->dbforge();

        // Make sure the migration table name was set.
        if (empty($this->_migration_table))
        {
            show_error('Migrations configuration file (migration.php) must have "migration_table" set.');
        }

        // Migration basename regex
        $this->_migration_regex = ($this->_migration_type === 'timestamp')
            ? '/^\d{14}_(\w+)$/'
            : '/^\d{3}_(\w+)$/';

        // Make sure a valid migration numbering type was set.
        if (! in_array($this->_migration_type, ['sequential', 'timestamp'], true))
        {
            show_error('An invalid migration numbering type was specified: '.$this->_migration_type);
        }

        // If the migrations table is missing, make it
        if (! $this->db->table_exists($this->_migration_table))
        {
            $this->dbforge->add_field(array(
                'module'  => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ),
                'version' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'unsigned' => TRUE,
                    'default' => 0
                )
            ));

            $this->dbforge->create_table($this->_migration_table, TRUE);

            $this->db->insert($this->_migration_table, ['module' => 'CI_Core', 'version' => 0]);
        }

        // Do we auto migrate to the latest migration?
        if ($this->_migration_auto_latest === TRUE && ! $this->latest())
        {
            show_error($this->error_string());
        }
    }

    // --------------------------------------------------------------------

    /**
     * Retrieves current schema version
     *
     * @param string $module
     * @return string
     */
    protected function _get_version($module = '')
    {
        ! $module && $module = $this->_current_module;

        $row = $this->db->where('module', $module)->get($this->_migration_table)->row();
        return $row ? $row->version : 0;
    }

    // --------------------------------------------------------------------

    /**
     * Stores the current schema version
     *
     * @param string $migration
     * @param string $module
     * @return void
     */
    protected function _update_version($migration, $module = '')
    {
        ! $module && $module = $this->_current_module;

        $row = $this->db->where('module', $module)->get($this->_migration_table)->num_rows();

        if ($row)
        {
            $this->db->update($this->_migration_table, ['version' => $migration], ['module' => $module]);
        }
        else
        {
            $this->db->insert($this->_migration_table, ['module' => $module, 'version' => $migration]);
        }
    }

    // --------------------------------------------------------------------

    public function display_current_migrations()
    {
        $modules = $this->list_all_modules_with_migrations();

        $migrations = [];

        foreach ($modules as $module)
        {
            $this->init_module($module[1]);
            $migrations[$module[1]] = $this->_get_version($module[1]);
        }

        return $migrations;
    }

    public function display_all_migrations()
    {
        $modules = $this->list_all_modules_with_migrations();

        $migrations = [];

        foreach ($modules as $module)
        {
            $this->init_module($module[1]);
            $migrations[$module[1]] = $this->find_migrations();
        }

        return $migrations;
    }

    public function migrate_all_modules()
    {
        $modules = $this->list_all_modules_with_migrations();

        foreach ($modules as $module)
        {
            $this->init_module($module[1]);
            $this->current();
        }

        return TRUE;
    }

    public function list_all_modules_with_migrations()
    {
        $modules = $this->list_all_modules();

        foreach ($modules as $i => $module)
        {
            list($location, $name) = $module;

            if ($this->init_module($name) !== TRUE)
            {
                unset($modules[$i]);
            }
        }

        return array_merge([['', 'CI_Core']], $modules);
    }

    public function list_all_modules()
    {
        return get_mods_list();
    }

    public function init_module($module = 'CI_Core')
    {
        if ($module === 'CI_Core')
        {
            $config = $this->_core_config;
            $config['migration_path'] == '' && $config['migration_path'] = APPPATH . 'migrations/';
        }
        else
        {
            // Backward function
            // Before PHP 7.1.0, list() only worked on numerical arrays and assumes the numerical indices start at 0.
            if (version_compare(phpversion(), '7.1', '<'))
            {
                // php version isn't high enough
                list($path, $file) = Modules::find('migration', $module, 'config/');
            }
            else
            {
                [$path, $file] = Modules::find('migration', $module, 'config/');
            }

            if ($path === FALSE)
            {
                return FALSE;
            }

            if (! $config = Modules::load_file($file, $path, 'config'))
            {
                return FALSE;
            }

            ! $config['migration_path'] && $config['migration_path'] = '../migrations';

            $config['migration_path'] = normalize_path($path . $config['migration_path']);
        }

        foreach ($config as $key => $val)
        {
            $this->{'_' . $key} = $val;
        }

        if ($this->_migration_enabled !== TRUE)
        {
            return FALSE;
        }

        $this->_migration_path = rtrim($this->_migration_path, '/').'/';

        if (! file_exists($this->_migration_path))
        {
            return FALSE;
        }

        $this->_current_module = $module;

        return TRUE;
    }
}