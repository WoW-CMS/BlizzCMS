<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends BS_Model
{
    protected $table = 'modules';

    /**
     * Reserved module names
     *
     * @var array
     */
    public const RESERVED_NAMES = [
        'CI',
        'admin',
        'user'
    ];

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check if a module exists in the saved cache
     *
     * @param string $module
     * @return bool
     */
    public function exists($module)
    {
        if (! $this->db->table_exists($this->table)) {
            return [];
        }

        $cache = $this->cache->get('modules');

        if ($cache !== false) {
            return in_array($module, $cache, true);
        }

        $rows = $this->db->get($this->table)->result_array();
        $list  = array_column($rows, 'module');

        $this->cache->save('modules', $list, 604800);

        return in_array($module, $list, true);
    }
}
