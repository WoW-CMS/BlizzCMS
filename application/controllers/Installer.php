<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
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

	/**
	 * Index page
	 */
	public function index()
	{
		$version      = version_compare(phpversion(), '7.3', '>');
		$gd_ext       = extension_loaded('gd');
		$gmp_ext      = extension_loaded('gmp');
		$curl_ext     = function_exists('curl_version');
		$mbstring_ext = extension_loaded('mbstring');
		$mysql_ext    = (extension_loaded('mysql') || extension_loaded('mysqlnd'));
		$openssl_ext  = extension_loaded('openssl');
		$soap_ext     = extension_loaded('soap');
		$cache        = (is_dir(APPPATH . 'cache') && is_writable(APPPATH . 'cache'));
		$uploads      = (is_dir(FCPATH . 'uploads') && is_writable(FCPATH . 'uploads'));
		$button       = ($version && $gd_ext && $gmp_ext && $curl_ext && $mbstring_ext && $mysql_ext && $openssl_ext && $soap_ext && $cache && $uploads);

		$data = [
			'requirements' => [
				['requirement' => lang('php_version'), 'enable' => $version],
				['requirement' => lang('gd_extension'), 'enable' => $gd_ext],
				['requirement' => lang('gmp_extension'), 'enable' => $gmp_ext],
				['requirement' => lang('curl_extension'), 'enable' => $curl_ext],
				['requirement' => lang('mbstring_extension'), 'enable' => $mbstring_ext],
				['requirement' => lang('mysql_extension'), 'enable' => $mysql_ext],
				['requirement' => lang('openssl_extension'), 'enable' => $openssl_ext],
				['requirement' => lang('soap_extension'), 'enable' => $soap_ext],
				['requirement' => lang('cache_writable'), 'enable' => $cache],
				['requirement' => lang('uploads_writable'), 'enable' => $uploads]
			],
			'button' => $button
		];

		$this->load->view('installer/index', $data);
	}

	/**
	 * Set Settings
	 */
	public function settings()
	{
		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('language', 'Language', 'trim|required|alpha_dash');
			$this->form_validation->set_rules('website_hostname', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('website_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('website_prefix', 'Prefix', 'trim|alpha_dash|max_length[6]');
			$this->form_validation->set_rules('website_database', 'Database', 'trim|required|alpha_dash|max_length[64]');
			$this->form_validation->set_rules('website_username', 'Username', 'trim|required|alpha_dash|max_length[32]');
			$this->form_validation->set_rules('website_password', 'Password', 'trim|required|max_length[32]');
			$this->form_validation->set_rules('auth_hostname', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('auth_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('auth_prefix', 'Prefix', 'trim|alpha_dash|max_length[6]');
			$this->form_validation->set_rules('auth_database', 'Database', 'trim|required|alpha_dash|max_length[64]');
			$this->form_validation->set_rules('auth_username', 'Username', 'trim|required|alpha_dash|max_length[32]');
			$this->form_validation->set_rules('auth_password', 'Password', 'trim|required|max_length[32]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('installer/settings');
			}
			else
			{
				$hostname = $this->input->post('website_hostname', TRUE);
				$port = $this->input->post('website_port', TRUE);
				$prefix = $this->input->post('website_prefix', TRUE);
				$database = $this->input->post('website_database', TRUE);
				$username = $this->input->post('website_username', TRUE);
				$password = $this->input->post('website_password');
				$auth_hostname = $this->input->post('website_hostname', TRUE);
				$auth_port = $this->input->post('auth_port', TRUE);
				$auth_prefix = $this->input->post('auth_prefix', TRUE);
				$auth_database = $this->input->post('auth_database', TRUE);
				$auth_username = $this->input->post('auth_username', TRUE);
				$auth_password = $this->input->post('auth_password');

				$checkDB = $this->load->database([
					'hostname' => $hostname,
					'username' => $username,
					'password' => $password,
					'database' => $database,
					'port'     => $port,
					'dbdriver' => 'mysqli'
				], TRUE);

				$this->load->dbutil($checkDB);

				if ($this->dbutil->database_exists($database))
				{
					$rewriteDB = $this->_rewrite_database([
						'website_hostname' => $hostname,
						'website_port'     => $port,
						'website_database' => $database,
						'website_username' => $username,
						'website_password' => $password,
						'website_prefix'   => $prefix,
						'auth_hostname'    => $auth_hostname,
						'auth_port'        => $auth_port,
						'auth_database'    => $auth_database,
						'auth_username'    => $auth_username,
						'auth_password'    => $auth_password,
						'auth_prefix'      => $auth_prefix,
					]);

					if (! $rewriteDB)
					{
						$this->session->set_flashdata('error', lang('settings_config_error'));
						return $this->load->view('installer/settings');
					}

					$this->load->library('config_writer');

					$config = $this->config_writer->get_instance();
					$config->write('language', $this->input->post('language'));

					if (empty(config_item('encryption_key')))
					{
						$config->write('encryption_key', bin2hex($this->encryption->create_key(24)));
					}

					redirect(site_url('install/database'));
				}

				$this->session->set_flashdata('error', lang('settings_db_error'));
				$this->load->view('installer/settings');
			}
		}
		else
		{
			$this->load->view('installer/settings');
		}
	}

	public function database()
	{
		$this->load->library('migration');

		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
		}

		$this->load->library('config_writer');

		if (config_item('sess_driver') != 'database')
		{
			$config = $this->config_writer->get_instance();
			$config->write('sess_driver', 'database');
			$config->write('sess_save_path', 'sessions');
		}

		redirect(site_url('install/preferences'));
	}

	public function preferences()
	{
		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('realmlist', 'Realmlist', 'trim');
			$this->form_validation->set_rules('expansion', 'Expansion', 'trim|required|is_natural');
			$this->form_validation->set_rules('emulator', 'Emulator', 'trim|required|alpha_dash');
			$this->form_validation->set_rules('bnet', 'Bnet', 'trim|required|in_list[true,false]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('installer/preferences');
			}
			else
			{
				$this->db->update_batch('settings', [
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

				if (is_null(config_item('installer_blocked')))
				{
					$installer = $this->config_writer->get_instance(APPPATH.'config/installer.php');
					$installer->write('installer_blocked', TRUE);
				}

				redirect(site_url());
			}
		}
		else
		{
			$this->load->view('installer/preferences');
		}
	}

	/**
	 * Rewrite config database file
	 *
	 * @param array $settings
	 * @return boolean
	 */
	private function _rewrite_database($settings = [])
	{
		if (!is_array($settings) || empty($settings))
		{
			return false;
		}

		$data = "<?php".PHP_EOL;
		$data .= "defined('BASEPATH') OR exit('No direct script access allowed');".PHP_EOL.PHP_EOL;
		$data .= "\$active_group"." = 'website';".PHP_EOL;
		$data .= "\$query_builder"." = TRUE;".PHP_EOL.PHP_EOL;
		$data .= "\$db['website']"." = array(".PHP_EOL;
		$data .= "\t'dsn'	=> '',".PHP_EOL;
		$data .= "\t'hostname' => '".$settings['website_hostname']."',".PHP_EOL;
		$data .= "\t'username' => '".$settings['website_username']."',".PHP_EOL;
		$data .= "\t'password' => '".$settings['website_password']."',".PHP_EOL;
		$data .= "\t'database' => '".$settings['website_database']."',".PHP_EOL;
		$data .= "\t'port'	=> '".$settings['website_port']."',".PHP_EOL;
		$data .= "\t'dbdriver' => 'mysqli',".PHP_EOL;
		$data .= "\t'dbprefix' => '".$settings['website_prefix']."',".PHP_EOL;
		$data .= "\t'pconnect' => FALSE,".PHP_EOL;
		$data .= "\t'db_debug' => (ENVIRONMENT !== 'production'),".PHP_EOL;
		$data .= "\t'cache_on' => FALSE,".PHP_EOL;
		$data .= "\t'cachedir' => '',".PHP_EOL;
		$data .= "\t'char_set' => 'utf8mb4',".PHP_EOL;
		$data .= "\t'dbcollat' => 'utf8mb4_unicode_520_ci',".PHP_EOL;
		$data .= "\t'swap_pre' => '',".PHP_EOL;
		$data .= "\t'encrypt' => FALSE,".PHP_EOL;
		$data .= "\t'compress' => FALSE,".PHP_EOL;
		$data .= "\t'stricton' => FALSE,".PHP_EOL;
		$data .= "\t'failover' => array(),".PHP_EOL;
		$data .= "\t'save_queries' => TRUE,".PHP_EOL;
		$data .= ");".PHP_EOL.PHP_EOL;
		$data .= "\$db['auth']"." = array(".PHP_EOL;
		$data .= "\t'dsn'	=> '',".PHP_EOL;
		$data .= "\t'hostname' => '".$settings['auth_hostname']."',".PHP_EOL;
		$data .= "\t'username' => '".$settings['auth_username']."',".PHP_EOL;
		$data .= "\t'password' => '".$settings['auth_password']."',".PHP_EOL;
		$data .= "\t'database' => '".$settings['auth_database']."',".PHP_EOL;
		$data .= "\t'port'	=> '".$settings['auth_port']."',".PHP_EOL;
		$data .= "\t'dbdriver' => 'mysqli',".PHP_EOL;
		$data .= "\t'dbprefix' => '".$settings['auth_prefix']."',".PHP_EOL;
		$data .= "\t'pconnect' => FALSE,".PHP_EOL;
		$data .= "\t'db_debug' => (ENVIRONMENT !== 'production'),".PHP_EOL;
		$data .= "\t'cache_on' => FALSE,".PHP_EOL;
		$data .= "\t'cachedir' => '',".PHP_EOL;
		$data .= "\t'char_set' => 'utf8',".PHP_EOL;
		$data .= "\t'dbcollat' => 'utf8_general_ci',".PHP_EOL;
		$data .= "\t'swap_pre' => '',".PHP_EOL;
		$data .= "\t'encrypt' => FALSE,".PHP_EOL;
		$data .= "\t'compress' => FALSE,".PHP_EOL;
		$data .= "\t'stricton' => FALSE,".PHP_EOL;
		$data .= "\t'failover' => array(),".PHP_EOL;
		$data .= "\t'save_queries' => TRUE,".PHP_EOL;
		$data .= ");";

		$this->load->helper('file');

		if (! write_file(APPPATH.'config/database.php', $data))
		{
			return false;
		}

		return true;
	}
}