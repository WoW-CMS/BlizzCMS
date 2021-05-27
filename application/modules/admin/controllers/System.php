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

class System extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin() || $this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('system_model');
		$this->load->language('admin');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('system/index');
	}

	public function general()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('realmlist', 'Realmlist', 'trim');
			$this->form_validation->set_rules('theme', 'Theme', 'trim');
			$this->form_validation->set_rules('expansion', 'Expansion', 'trim|required|is_natural');
			$this->form_validation->set_rules('emulator', 'Emulator', 'trim|required|alpha_dash');
			$this->form_validation->set_rules('bnet', 'Bnet Account', 'trim|required|in_list[true,false]');
			$this->form_validation->set_rules('discord', 'Discord URL', 'trim|alpha_dash');
			$this->form_validation->set_rules('facebook', 'Facebook URL', 'trim|valid_url');
			$this->form_validation->set_rules('twitter', 'Twitter URL', 'trim|valid_url');
			$this->form_validation->set_rules('youtube', 'Youtube URL', 'trim|valid_url');

			$this->form_validation->set_rules('admin_access', 'Admin access', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('mod_access', 'Mod access', 'trim|required|is_natural_no_zero');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('system/general');
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
						'key' => 'app_theme',
						'value' => $this->input->post('theme', TRUE)
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
					[
						'key' => 'discord_server_id',
						'value' => $this->input->post('discord', TRUE)
					],
					[
						'key' => 'facebook_url',
						'value' => $this->input->post('facebook', TRUE)
					],
					[
						'key' => 'twitter_url',
						'value' => $this->input->post('twitter', TRUE)
					],
					[
						'key' => 'youtube_url',
						'value' => $this->input->post('youtube', TRUE)
					],
					[
						'key' => 'admin_access_level',
						'value' => $this->input->post('admin_access', TRUE)
					],
					[
						'key' => 'mod_access_level',
						'value' => $this->input->post('mod_access', TRUE)
					]
				], 'key');

				// Clear cache
				$this->cache->file->delete('settings');

				$this->session->set_flashdata('success', lang('settings_updated'));
				redirect(site_url('admin/system/general'));
			}
		}
		else
		{
			$this->template->build('system/general');
		}
	}

	public function captcha()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('captcha_register', 'Captcha Register', 'trim');
			$this->form_validation->set_rules('captcha_login', 'Captcha Login', 'trim');
			$this->form_validation->set_rules('captcha_forgot', 'Captcha Forgot', 'trim');
			$this->form_validation->set_rules('captcha_type', 'Captcha Type', 'trim|in_list[hcaptcha,recaptcha]');
			$this->form_validation->set_rules('captcha_theme', 'Captcha Theme', 'trim|in_list[light,dark]');
			$this->form_validation->set_rules('captcha_public', 'Captcha Public', 'trim|alpha_dash');
			$this->form_validation->set_rules('captcha_private', 'Captcha Private', 'trim|alpha_dash');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('system/captcha');
			}
			else
			{
				$this->db->update_batch('settings', [
					[
						'key'   => 'captcha_register',
						'value' => ($this->input->post('captcha_register', TRUE) != 'true') ? 'false' : 'true'
					],
					[
						'key'   => 'captcha_login',
						'value' => ($this->input->post('captcha_login', TRUE) != 'true') ? 'false' : 'true'
					],
					[
						'key'   => 'captcha_forgot',
						'value' => ($this->input->post('captcha_forgot', TRUE) != 'true') ? 'false' : 'true'
					],
					[
						'key'   => 'captcha_type',
						'value' => $this->input->post('captcha_type')
					],
					[
						'key'   => 'captcha_theme',
						'value' => $this->input->post('captcha_theme')
					],
					[
						'key'   => 'captcha_public',
						'value' => $this->input->post('captcha_public')
					],
					[
						'key'   => 'captcha_private',
						'value' => $this->input->post('captcha_private')
					]
				], 'key');

				// Clear cache
				$this->cache->file->delete('settings');

				$this->session->set_flashdata('success', lang('settings_updated'));
				redirect(site_url('admin/system/captcha'));
			}
		}
		else
		{
			$this->template->build('system/captcha');
		}
	}

	public function email()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('register', 'Register', 'trim');
			$this->form_validation->set_rules('email_protocol', 'Email Protocol', 'trim|in_list[mail,sendmail,smtp]');
			$this->form_validation->set_rules('email_host', 'Email Host', 'trim');
			$this->form_validation->set_rules('email_user', 'Email User', 'trim');
			$this->form_validation->set_rules('email_pass', 'Email Password', 'trim');
			$this->form_validation->set_rules('email_port', 'Email Port', 'trim|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('email_crypto', 'Email Crypto', 'trim|in_list[tls,ssl]');
			$this->form_validation->set_rules('email_sender', 'Email Sender', 'trim|valid_email');
			$this->form_validation->set_rules('email_sender_name', 'Email Sender Name', 'trim');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('system/email');
			}
			else
			{
				$this->db->update_batch('settings', [
					[
						'key'   => 'register_validation',
						'value' => ($this->input->post('register', TRUE) != 'true') ? 'false' : 'true'
					],
					[
						'key'   => 'email_protocol',
						'value' => $this->input->post('email_protocol')
					],
					[
						'key'   => 'email_hostname',
						'value' => $this->input->post('email_host', TRUE)
					],
					[
						'key'   => 'email_username',
						'value' => $this->input->post('email_user')
					],
					[
						'key'   => 'email_port',
						'value' => $this->input->post('email_port')
					],
					[
						'key'   => 'email_crypto',
						'value' => $this->input->post('email_crypto')
					],
					[
						'key'   => 'email_sender',
						'value' => $this->input->post('email_sender', TRUE)
					],
					[
						'key'   => 'email_sender_name',
						'value' => $this->input->post('email_sender_name', TRUE)
					]
				], 'key');

				if (! empty($this->input->post('email_pass')))
				{
					$this->db->set('value', encrypt($this->input->post('email_pass')))->where('key', 'email_password')->update('settings');
				}

				// Clear cache
				$this->cache->file->delete('settings');

				$this->session->set_flashdata('success', lang('settings_updated'));
				redirect(site_url('admin/system/email'));
			}
		}
		else
		{
			$this->template->build('system/email');
		}
	}

	public function cache()
	{
		if ($this->input->method() != 'get')
		{
			show_404();
		}

		if (! $this->cache->file->clean())
		{
			$this->session->set_flashdata('error', lang('cache_error'));
		}
		else
		{
			$this->session->set_flashdata('success', lang('cache_deleted'));
		}

		redirect(site_url('admin/system'));
	}

	public function sessions()
	{
		if ($this->input->method() != 'get')
		{
			show_404();
		}

		$this->db->truncate('sessions');

		redirect(site_url('admin/system'));
	}

	public function logs()
	{
		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$search       = $this->input->get('search');
		$search_clean = $this->security->xss_clean($search);

		$config = [
			'base_url'    => site_url('admin/system/logs'),
			'total_rows'  => $this->system_model->count_all($search_clean),
			'per_page'    => 25,
			'uri_segment' => 4
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'logs'  => $this->system_model->get_all($config['per_page'], $offset, $search_clean),
			'links'  => $this->pagination->create_links(),
			'search' => $search
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('system/logs', $data);
	}
}