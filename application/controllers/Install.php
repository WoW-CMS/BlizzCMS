<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends BS_Controller
{
    protected $pageviewsExcludeUris = [
        'install/.*+'
    ];

    public function __construct()
    {
        parent::__construct();

        if (! config_item('installation_active')) {
            show_404();
        }
    }

    public function index()
    {
        $version      = PHP_VERSION;
        $checkVersion = version_compare($version, '7.4', '>=');

        $loadedExtensions   = get_loaded_extensions();
        $requiredExtensions = ['bcmath', 'curl', 'gd', 'gmp', 'mbstring', 'mysqli', 'openssl', 'soap', 'zip'];
        $missingExtensions  = array_diff($requiredExtensions, $loadedExtensions);
        $verifiedExtensions = array_diff($requiredExtensions, $missingExtensions);

        $dependencies = is_file(FCPATH . 'vendor/autoload.php');

        $directoryPaths = [
            APPPATH . '/cache',
            APPPATH . '/config/config.php',
            APPPATH . '/config/database.php',
            APPPATH . '/config/install.php'
        ];
        $missingPermissions = array_filter($directoryPaths, fn($v) => ! is_writable($v));

        $data = [
            'version'             => $version,
            'version_supported'   => $checkVersion,
            'verified_extensions' => $verifiedExtensions,
            'missing_extensions'  => $missingExtensions,
            'dependencies'        => $dependencies,
            'missing_permissions' => $missingPermissions,
            'next_step'           => ($checkVersion && $missingExtensions === [] && $dependencies && $missingPermissions === [])
        ];

        $this->load->view('install/index', $data);
    }

    public function database_step()
    {
        $this->form_validation->set_rules('cms_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('cms_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('cms_prefix', lang('prefix'), 'trim|alpha_dash|max_length[6]');
        $this->form_validation->set_rules('cms_database', lang('database'), 'trim|required|alpha_dash|max_length[64]');
        $this->form_validation->set_rules('cms_username', lang('username'), 'trim|required|alpha_dash|max_length[32]');
        $this->form_validation->set_rules('cms_password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('auth_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('auth_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('auth_prefix', lang('prefix'), 'trim|alpha_dash|max_length[6]');
        $this->form_validation->set_rules('auth_database', lang('database'), 'trim|required|alpha_dash|max_length[64]');
        $this->form_validation->set_rules('auth_username', lang('username'), 'trim|required|alpha_dash|max_length[32]');
        $this->form_validation->set_rules('auth_password', lang('password'), 'trim|required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $cmsdb = $this->load->database([
                'hostname' => $this->input->post('cms_hostname'),
                'username' => $this->input->post('cms_username'),
                'password' => $this->input->post('cms_password'),
                'database' => $this->input->post('cms_database'),
                'port'     => $this->input->post('cms_port'),
                'dbdriver' => 'mysqli'
            ], true);

            if ($cmsdb->conn_id === false) {
                $this->session->set_flashdata('error', lang('install_cms_db_failed'));
                redirect(site_url('install/database'));
            }

            $authdb = $this->load->database([
                'hostname' => $this->input->post('auth_hostname'),
                'username' => $this->input->post('auth_username'),
                'password' => $this->input->post('auth_password'),
                'database' => $this->input->post('auth_database'),
                'port'     => $this->input->post('auth_port'),
                'dbdriver' => 'mysqli'
            ], true);

            if ($authdb->conn_id === false) {
                $this->session->set_flashdata('error', lang('install_auth_db_failed'));
                redirect(site_url('install/database'));
            }

            $rewrite = $this->_rewrite_config([
                'cms_hostname'  => $this->input->post('cms_hostname'),
                'cms_port'      => $this->input->post('cms_port'),
                'cms_database'  => $this->input->post('cms_database'),
                'cms_username'  => $this->input->post('cms_username'),
                'cms_password'  => addcslashes($this->input->post('cms_password'), "'\\"),
                'cms_prefix'    => $this->input->post('cms_prefix'),
                'auth_hostname' => $this->input->post('auth_hostname'),
                'auth_port'     => $this->input->post('auth_port'),
                'auth_database' => $this->input->post('auth_database'),
                'auth_username' => $this->input->post('auth_username'),
                'auth_password' => addcslashes($this->input->post('auth_password'), "'\\"),
                'auth_prefix'   => $this->input->post('auth_prefix')
            ]);

            if (! $rewrite) {
                $this->session->set_flashdata('error', lang('install_change_file_failed'));
                redirect(site_url('install/database'));
            }

            redirect(site_url('install/settings'));
        } else {
            $this->load->view('install/database');
        }
    }

    public function settings_step()
    {
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('realmlist', lang('realmlist'), 'trim');
        $this->form_validation->set_rules('expansion', lang('expansion'), 'trim|required|is_natural');
        $this->form_validation->set_rules('emulator', lang('emulator'), 'trim|required|alpha_dash');
        $this->form_validation->set_rules('bnet', lang('bnet_authentication'), 'trim|required|in_list[true,false]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->load->library(['migration', 'config_writer']);

            if ($this->migration->current() === false) {
                show_error($this->migration->error_string());
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'app_name',
                    'value' => $this->input->post('name', true)
                ],
                [
                    'key'   => 'app_realmlist',
                    'value' => $this->input->post('realmlist', true)
                ],
                [
                    'key'   => 'app_expansion',
                    'value' => $this->input->post('expansion')
                ],
                [
                    'key'   => 'app_emulator',
                    'value' => $this->input->post('emulator')
                ],
                [
                    'key'   => 'app_emulator_bnet',
                    'value' => $this->input->post('bnet')
                ]
            ], 'key');

            $this->cache->delete('settings');

            $configWriter = $this->config_writer->get_instance();

            if (config_item('encryption_key') === '') {
                $configWriter->write('encryption_key', bin2hex($this->encryption->create_key(24)));
            }

            if (config_item('sess_driver') !== 'database') {
                $configWriter->write('sess_driver', 'database');
                $configWriter->write('sess_save_path', 'sessions');
            }

            redirect(site_url('install/last'), 'refresh');
        } else {
            $this->load->view('install/settings');
        }
    }

    public function last_step()
    {
        $data = [
            'option' => null
        ];

        if ($this->input->method() === 'post') {
            $inputs = $this->input->post();

            $option = $inputs['option'];

            $data['option'] = $option;
            unset($inputs['option']);

            if ($option === 'previous') {
                $this->form_validation->set_rules('previous_username', lang('username'), 'trim|required|alpha_numeric');
            } else {
                $this->form_validation->set_rules('nickname', lang('nickname'), 'trim|required|alpha_dash|max_length[15]|is_user_field_unique[nickname]');
                $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_numeric|min_length[4]|max_length[15]|differs[nickname]|is_user_field_unique[username]');
                $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|is_user_field_unique[email]');
                $this->form_validation->set_rules('password', lang('password'), 'trim|required|min_length[8]');
                $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[8]|matches[password]');
            }

            $this->form_validation->set_data($inputs);

            if ($this->form_validation->run()) {
                $count = $this->user_model->count_all();

                if ($count !== 0) {
                    $this->session->set_flashdata('warning', lang('install_step_locked'));
                    redirect(site_url('install/last'));
                }

                if ($option === 'previous') {
                    $adminId = $this->server_auth_model->account_id($inputs['previous_username']);

                    if (empty($adminId)) {
                        $this->session->set_flashdata('error', lang('install_find_account_failed'));
                        redirect(site_url('install/last'));
                    }

                    if ($this->server_auth_model->account_gmlevel($adminId) <= 2) {
                        $this->session->set_flashdata('error', lang('install_require_gm_rank'));
                        redirect(site_url('install/last'));
                    }

                    $auth     = $this->server_auth_model->connect();
                    $accounts = $auth->get('account')->result();

                    foreach ($accounts as $account) {
                        $this->user_model->insert([
                            'id'       => $account->id,
                            'nickname' => $account->username,
                            'username' => $account->username,
                            'email'    => ! empty($account->email) ? $account->email : strtolower($account->username) . '@localhost',
                            'role'     => Role_model::ROLE_USER
                        ]);
                    }

                    $this->user_model->update(['role' => Role_model::ROLE_ADMIN], ['id' => $adminId]);
                } else {
                    $accountId = $this->server_auth_model->create_account($inputs['username'], $inputs['email'], $inputs['password']);

                    $this->user_model->insert([
                        'id'       => $accountId,
                        'nickname' => $inputs['nickname'],
                        'username' => $inputs['username'],
                        'email'    => $inputs['email'],
                        'password' => $inputs['password'],
                        'role'     => Role_model::ROLE_ADMIN
                    ]);
                }

                if (config_item('installation_active')) {
                    $this->load->library('config_writer');

                    $configWriter = $this->config_writer->get_instance(APPPATH . 'config/install.php');

                    $configWriter->write('installation_active', false);
                }

                redirect(site_url(), 'refresh');
            }
        }

        $this->load->view('install/last', $data);
    }

    /**
     * Rewrite config database file
     *
     * @param array $settings
     * @return bool
     */
    private function _rewrite_config($settings)
    {
        if ($settings === []) {
            return false;
        }

        $line = "<?php" . PHP_EOL;
        $line .= "defined('BASEPATH') OR exit('No direct script access allowed');" . PHP_EOL . PHP_EOL;
        $line .= "\$active_group = 'cms';" . PHP_EOL;
        $line .= "\$query_builder = true;" . PHP_EOL . PHP_EOL;
        $line .= "\$db['cms'] = [" . PHP_EOL;
        $line .= "\t'dsn'      => ''," . PHP_EOL;
        $line .= "\t'hostname' => '{$settings['cms_hostname']}'," . PHP_EOL;
        $line .= "\t'username' => '{$settings['cms_username']}'," . PHP_EOL;
        $line .= "\t'password' => '{$settings['cms_password']}'," . PHP_EOL;
        $line .= "\t'database' => '{$settings['cms_database']}'," . PHP_EOL;
        $line .= "\t'port'     => {$settings['cms_port']}," . PHP_EOL;
        $line .= "\t'dbdriver' => 'mysqli'," . PHP_EOL;
        $line .= "\t'dbprefix' => '{$settings['cms_prefix']}'," . PHP_EOL;
        $line .= "\t'pconnect' => false," . PHP_EOL;
        $line .= "\t'db_debug' => (ENVIRONMENT !== 'production')," . PHP_EOL;
        $line .= "\t'cache_on' => false," . PHP_EOL;
        $line .= "\t'cachedir' => ''," . PHP_EOL;
        $line .= "\t'char_set' => 'utf8mb4'," . PHP_EOL;
        $line .= "\t'dbcollat' => 'utf8mb4_unicode_ci'," . PHP_EOL;
        $line .= "\t'swap_pre' => ''," . PHP_EOL;
        $line .= "\t'encrypt'  => false," . PHP_EOL;
        $line .= "\t'compress' => false," . PHP_EOL;
        $line .= "\t'stricton' => false," . PHP_EOL;
        $line .= "\t'failover' => []," . PHP_EOL;
        $line .= "\t'save_queries' => true," . PHP_EOL;
        $line .= "];" . PHP_EOL . PHP_EOL;
        $line .= "\$db['auth'] = [" . PHP_EOL;
        $line .= "\t'dsn'      => ''," . PHP_EOL;
        $line .= "\t'hostname' => '{$settings['auth_hostname']}'," . PHP_EOL;
        $line .= "\t'username' => '{$settings['auth_username']}'," . PHP_EOL;
        $line .= "\t'password' => '{$settings['auth_password']}'," . PHP_EOL;
        $line .= "\t'database' => '{$settings['auth_database']}'," . PHP_EOL;
        $line .= "\t'port'     => {$settings['auth_port']}," . PHP_EOL;
        $line .= "\t'dbdriver' => 'mysqli'," . PHP_EOL;
        $line .= "\t'dbprefix' => '{$settings['auth_prefix']}'," . PHP_EOL;
        $line .= "\t'pconnect' => false," . PHP_EOL;
        $line .= "\t'db_debug' => (ENVIRONMENT !== 'production')," . PHP_EOL;
        $line .= "\t'cache_on' => false," . PHP_EOL;
        $line .= "\t'cachedir' => ''," . PHP_EOL;
        $line .= "\t'char_set' => 'utf8mb4'," . PHP_EOL;
        $line .= "\t'dbcollat' => 'utf8mb4_unicode_ci'," . PHP_EOL;
        $line .= "\t'swap_pre' => ''," . PHP_EOL;
        $line .= "\t'encrypt'  => false," . PHP_EOL;
        $line .= "\t'compress' => false," . PHP_EOL;
        $line .= "\t'stricton' => false," . PHP_EOL;
        $line .= "\t'failover' => []," . PHP_EOL;
        $line .= "\t'save_queries' => true," . PHP_EOL;
        $line .= "];";

        if (! write_file(APPPATH . 'config/database.php', $line)) {
            return false;
        }

        return true;
    }
}
