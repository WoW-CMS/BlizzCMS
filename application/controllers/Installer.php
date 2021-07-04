<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Installer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! is_null(config_item('installer_blocked')))
        {
            show_404();
        }

        $this->lang->load('installer');
    }

    public function index()
    {
        $version  = phpversion();
        $compare  = (version_compare($version, '7.3', '>=') && version_compare($version, '8.0', '<'));
        $gd       = extension_loaded('gd');
        $gmp      = extension_loaded('gmp');
        $curl     = function_exists('curl_version');
        $mbstring = extension_loaded('mbstring');
        $mysql    = (extension_loaded('mysql') || extension_loaded('mysqlnd'));
        $openssl  = extension_loaded('openssl');
        $soap     = extension_loaded('soap');
        $zip      = extension_loaded('zip');
        $cache    = (is_dir(APPPATH . 'cache') && is_writable(APPPATH . 'cache'));
        $uploads  = (is_dir(FCPATH . 'uploads') && is_writable(FCPATH . 'uploads'));
        $button   = ($compare && $gd && $gmp && $curl && $mbstring && $mysql && $openssl && $soap && $zip && $cache && $uploads);

        $data = [
            'info' => ['version' => $version, 'enable' => $compare],
            'extensions' => [
                ['name' => 'GD', 'enable' => $gd],
                ['name' => 'GMP', 'enable' => $gmp],
                ['name' => 'Curl', 'enable' => $curl],
                ['name' => 'Mbstring', 'enable' => $mbstring],
                ['name' => 'MySQL', 'enable' => $mysql],
                ['name' => 'OpenSSL', 'enable' => $openssl],
                ['name' => 'SOAP', 'enable' => $soap],
                ['name' => 'Zip', 'enable' => $zip]
            ],
            'permissions' => [
                ['name' => lang('cache_directory'), 'enable' => $cache],
                ['name' => lang('uploads_directory'), 'enable' => $uploads]
            ],
            'button' => $button
        ];

        $this->load->view('installer/index', $data);
    }

    public function cms()
    {
        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('hostname', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('prefix', lang('prefix'), 'trim|alpha_dash|max_length[6]');
            $this->form_validation->set_rules('database', lang('database'), 'trim|required|alpha_dash|max_length[64]');
            $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_dash|max_length[32]');
            $this->form_validation->set_rules('password', lang('password'), 'trim|required|max_length[32]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('installer/cms_db');
            }
            else
            {
                $hostname = $this->input->post('hostname', TRUE);
                $port     = $this->input->post('port', TRUE);
                $prefix   = $this->input->post('prefix', TRUE);
                $database = $this->input->post('database', TRUE);
                $username = $this->input->post('username', TRUE);
                $password = $this->input->post('password');

                $connect = $this->load->database([
                    'hostname' => $hostname,
                    'username' => $username,
                    'password' => $password,
                    'database' => $database,
                    'port'     => $port,
                    'dbdriver' => 'mysqli'
                ], TRUE);

                $this->load->dbutil($connect);

                if (! $this->dbutil->database_exists($database))
                {
                    $this->session->set_flashdata('error', lang('db_connection_error'));
                    return $this->load->view('installer/cms_db');
                }

                $this->cache->file->save('inst_cms', [
                    'cms_hostname'  => $hostname,
                    'cms_port'      => $port,
                    'cms_database'  => $database,
                    'cms_username'  => $username,
                    'cms_password'  => $password,
                    'cms_prefix'    => $prefix
                ], 3600);

                redirect(site_url('install/auth'));
            }
        }
        else
        {
            $this->load->view('installer/cms_db');
        }
    }

    public function auth()
    {
        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('hostname', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('prefix', lang('prefix'), 'trim|alpha_dash|max_length[6]');
            $this->form_validation->set_rules('database', lang('database'), 'trim|required|alpha_dash|max_length[64]');
            $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_dash|max_length[32]');
            $this->form_validation->set_rules('password', lang('password'), 'trim|required|max_length[32]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('installer/auth_db');
            }
            else
            {
                $hostname = $this->input->post('hostname', TRUE);
                $port     = $this->input->post('port', TRUE);
                $prefix   = $this->input->post('prefix', TRUE);
                $database = $this->input->post('database', TRUE);
                $username = $this->input->post('username', TRUE);
                $password = $this->input->post('password');

                $connect = $this->load->database([
                    'hostname' => $hostname,
                    'username' => $username,
                    'password' => $password,
                    'database' => $database,
                    'port'     => $port,
                    'dbdriver' => 'mysqli'
                ], TRUE);

                $this->load->dbutil($connect);

                if (! $this->dbutil->database_exists($database))
                {
                    $this->session->set_flashdata('error', lang('db_connection_error'));
                    return $this->load->view('installer/auth_db');
                }

                $cache = $this->cache->file->get('inst_cms');

                if ($cache === false)
                {
                    $this->session->set_flashdata('error', lang('data_file_error'));
                    return $this->load->view('installer/auth_db');
                }

                $result = array_merge($cache, [
                    'auth_hostname' => $hostname,
                    'auth_port'     => $port,
                    'auth_database' => $database,
                    'auth_username' => $username,
                    'auth_password' => $password,
                    'auth_prefix'   => $prefix
                ]);

                $rewrite = $this->_rewrite_database($result);

                if (! $rewrite)
                {
                    $this->session->set_flashdata('error', lang('file_permission_error'));
                    return $this->load->view('installer/auth_db');
                }

                $this->cache->file->delete('inst_cms');

                redirect(site_url('install/settings'));
            }
        }
        else
        {
            $this->load->view('installer/auth_db');
        }
    }

    public function settings()
    {
        $data = [
            'expansions' => config_item('supported_expansions')
        ];

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required|min_length[3]');
            $this->form_validation->set_rules('realmlist', lang('realmlist'), 'trim');
            $this->form_validation->set_rules('expansion', lang('expansion'), 'trim|required|is_natural');
            $this->form_validation->set_rules('emulator', lang('emulator'), 'trim|required|alpha_dash');
            $this->form_validation->set_rules('bnet', lang('bnet_account'), 'trim|required|in_list[true,false]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('installer/settings', $data);
            }
            else
            {
                $this->load->library('migration');

                if ($this->migration->current() === FALSE)
                {
                    show_error($this->migration->error_string());
                }

                $this->settings->update_batch([
                    [
                        'key' => 'app_name',
                        'value' => $this->input->post('name', TRUE)
                    ],
                    [
                        'key' => 'realmlist',
                        'value' => $this->input->post('realmlist', TRUE)
                    ],
                    [
                        'key' => 'expansion',
                        'value' => $this->input->post('expansion')
                    ],
                    [
                        'key' => 'emulator',
                        'value' => $this->input->post('emulator', TRUE)
                    ],
                    [
                        'key' => 'emulator_bnet',
                        'value' => $this->input->post('bnet')
                    ],
                ], 'key');

                $this->load->library('config_writer');

                $config = $this->config_writer->get_instance();

                if (empty(config_item('encryption_key')))
                {
                    $config->write('encryption_key', bin2hex($this->encryption->create_key(24)));
                }

                if (config_item('sess_driver') != 'database')
                {
                    $config->write('sess_driver', 'database');
                    $config->write('sess_save_path', 'sessions');
                }

                if (is_null(config_item('installer_blocked')))
                {
                    $installer = $this->config_writer->get_instance(APPPATH . 'config/installer.php');
                    $installer->write('installer_blocked', TRUE);
                }

                redirect(site_url(), 'refresh');
            }
        }
        else
        {
            $this->load->view('installer/settings', $data);
        }
    }

    /**
     * Rewrite config database file
     *
     * @param array $settings
     * @return bool
     */
    private function _rewrite_database($settings = [])
    {
        if (! is_array($settings) || empty($settings))
        {
            return false;
        }

        $line = "<?php".PHP_EOL;
        $line .= "defined('BASEPATH') OR exit('No direct script access allowed');".PHP_EOL.PHP_EOL;
        $line .= "\$active_group"." = 'cms';".PHP_EOL;
        $line .= "\$query_builder"." = TRUE;".PHP_EOL.PHP_EOL;
        $line .= "\$db['cms']"." = [".PHP_EOL;
        $line .= "\t'dsn'    => '',".PHP_EOL;
        $line .= "\t'hostname' => '{$settings['cms_hostname']}',".PHP_EOL;
        $line .= "\t'username' => '{$settings['cms_username']}',".PHP_EOL;
        $line .= "\t'password' => '{$settings['cms_password']}',".PHP_EOL;
        $line .= "\t'database' => '{$settings['cms_database']}',".PHP_EOL;
        $line .= "\t'port'    => {$settings['cms_port']},".PHP_EOL;
        $line .= "\t'dbdriver' => 'mysqli',".PHP_EOL;
        $line .= "\t'dbprefix' => '{$settings['cms_prefix']}',".PHP_EOL;
        $line .= "\t'pconnect' => FALSE,".PHP_EOL;
        $line .= "\t'db_debug' => (ENVIRONMENT !== 'production'),".PHP_EOL;
        $line .= "\t'cache_on' => FALSE,".PHP_EOL;
        $line .= "\t'cachedir' => '',".PHP_EOL;
        $line .= "\t'char_set' => 'utf8mb4',".PHP_EOL;
        $line .= "\t'dbcollat' => 'utf8mb4_unicode_520_ci',".PHP_EOL;
        $line .= "\t'swap_pre' => '',".PHP_EOL;
        $line .= "\t'encrypt' => FALSE,".PHP_EOL;
        $line .= "\t'compress' => FALSE,".PHP_EOL;
        $line .= "\t'stricton' => FALSE,".PHP_EOL;
        $line .= "\t'failover' => [],".PHP_EOL;
        $line .= "\t'save_queries' => TRUE,".PHP_EOL;
        $line .= "];".PHP_EOL.PHP_EOL;
        $line .= "\$db['auth']"." = [".PHP_EOL;
        $line .= "\t'dsn'    => '',".PHP_EOL;
        $line .= "\t'hostname' => '{$settings['auth_hostname']}',".PHP_EOL;
        $line .= "\t'username' => '{$settings['auth_username']}',".PHP_EOL;
        $line .= "\t'password' => '{$settings['auth_password']}',".PHP_EOL;
        $line .= "\t'database' => '{$settings['auth_database']}',".PHP_EOL;
        $line .= "\t'port'    => {$settings['auth_port']},".PHP_EOL;
        $line .= "\t'dbdriver' => 'mysqli',".PHP_EOL;
        $line .= "\t'dbprefix' => '{$settings['auth_prefix']}',".PHP_EOL;
        $line .= "\t'pconnect' => FALSE,".PHP_EOL;
        $line .= "\t'db_debug' => (ENVIRONMENT !== 'production'),".PHP_EOL;
        $line .= "\t'cache_on' => FALSE,".PHP_EOL;
        $line .= "\t'cachedir' => '',".PHP_EOL;
        $line .= "\t'char_set' => 'utf8mb4',".PHP_EOL;
        $line .= "\t'dbcollat' => 'utf8mb4_unicode_520_ci',".PHP_EOL;
        $line .= "\t'swap_pre' => '',".PHP_EOL;
        $line .= "\t'encrypt' => FALSE,".PHP_EOL;
        $line .= "\t'compress' => FALSE,".PHP_EOL;
        $line .= "\t'stricton' => FALSE,".PHP_EOL;
        $line .= "\t'failover' => [],".PHP_EOL;
        $line .= "\t'save_queries' => TRUE,".PHP_EOL;
        $line .= "];";

        $this->load->helper('file');

        if (! write_file(APPPATH.'config/database.php', $line))
        {
            return false;
        }

        return true;
    }
}