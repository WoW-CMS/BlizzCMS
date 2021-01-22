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

class User extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('user_model');
		$this->load->language('user');

		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('my_account'));

		$this->template->build('index');
	}

	public function settings()
	{
		$this->template->title(config_item('app_name'), lang('my_account'));

		$this->template->build('settings');
	}

	public function change_nickname()
	{
		if ($this->input->method() != 'post')
		{
			show_404();
		}

		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|alpha_numeric|max_length[16]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			return $this->settings();
		}
		else
		{
			$nickname = $this->input->post('nickname', TRUE);
			$password = $this->input->post('password');
			$user     = $this->website->get_user();

			if (! $this->auth->valid_password($user->username, $password))
			{
				$this->session->set_flashdata('error', lang('password_error'));
				redirect(site_url('user/settings'));
			}

			$this->db->set('nickname', $nickname)->where('id', $user->id)->update('users');
			$this->session->set_userdata('nickname', $nickname);

			$this->session->set_flashdata('success', lang('nickname_changed'));
			redirect(site_url('user/settings'));
		}
	}

	public function change_email()
	{
		if ($this->input->method() != 'post')
		{
			show_404();
		}

		$this->form_validation->set_rules('new_email', 'New Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('confirm_new_email', 'New Email Confirmation', 'trim|required|matches[new_email]');
		$this->form_validation->set_rules('cu_password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			return $this->settings();
		}
		else
		{
			$new_email  = $this->input->post('new_email', TRUE);
			$password   = $this->input->post('cu_password');
			$user       = $this->website->get_user();

			if (! $this->auth->account_unique($new_email, 'email'))
			{
				$this->session->set_flashdata('error', lang('email_already'));
				redirect(site_url('user/settings'));
			}

			if (! $this->auth->valid_password($user->username, $password))
			{
				$this->session->set_flashdata('error', lang('password_error'));
				redirect(site_url('user/settings'));
			}

			$this->auth->connect()->set('email', $new_email)->where('id', $user->id)->update('account');

			// If emulator support bnet update password on table
			if (config_item('emulator_bnet') == 'true')
			{
				$bnet = $this->auth->game_hash($new_email, $password, 'bnet');

				$this->auth->connect()->where('id', $user->id)->update('battlenet_accounts', [
					'email'         => $new_email,
					'sha_pass_hash' => $bnet
				]);
			}

			$this->db->set('email', $new_email)->where('id', $user->id)->update('users');

			$this->session->set_flashdata('success', lang('email_changed'));
			redirect(site_url('settings'));
		}
	}

	public function change_password()
	{
		if ($this->input->method() != 'post')
		{
			show_404();
		}

		$this->form_validation->set_rules('current_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[8]|max_length[32]|differs[password]');
		$this->form_validation->set_rules('confirm_new_password', 'New Password Confirmation', 'trim|required|min_length[8]|max_length[32]|matches[new_password]');

		if ($this->form_validation->run() == FALSE)
		{
			return $this->settings();
		}
		else
		{
			$password     = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			$user         = $this->website->get_user();
			$emulator     = config_item('emulator');

			if (! $this->auth->valid_password($user->username, $password))
			{
				$this->session->set_flashdata('error', lang('password_error'));
				redirect(site_url('user/settings'));
			}

			if (in_array($emulator, ['trinity'], true))
			{
				$salt = random_bytes(32);

				$this->auth->connect()->where('id', $user->id)->update('account', [
					'salt'     => $salt,
					'verifier' => $this->auth->game_hash($user->username, $new_password, 'srp6', $salt)
				]);
			}
			elseif (in_array($emulator, ['cmangos'], true))
			{
				$salt = strtoupper(bin2hex(random_bytes(32)));

				$this->auth->connect()->where('id', $user->id)->update('account', [
					'sessionkey' => '',
					'v'          => $this->auth->game_hash($user->username, $new_password, 'hex', $salt),
					's'          => $salt
				]);
			}
			elseif (in_array($emulator, ['azeroth', 'old_trinity', 'mangos'], true))
			{
				$this->auth->connect()->where('id', $user->id)->update('account', [
					'sha_pass_hash' => $this->auth->game_hash($user->username, $new_password),
					'sessionkey'    => '',
					'v'             => '',
					's'             => ''
				]);
			}

			// If emulator support bnet update password on table
			if (config_item('emulator_bnet') == 'true')
			{
				$bnet = $this->auth->game_hash($user->email, $new_password, 'bnet');

				$this->auth->connect()->set('sha_pass_hash', $bnet)->where('id', $user->id)->update('battlenet_accounts');
			}

			$this->session->set_flashdata('success', lang('password_changed'));
			redirect(site_url('user/settings'));
		}
	}

	public function change_avatar()
	{
		if ($this->input->method() != 'post')
		{
			show_404();
		}

		$this->form_validation->set_rules('avatar', 'Avatar', 'trim|required|is_natural_no_zero');

		if ($this->form_validation->run() == FALSE)
		{
			return $this->settings();
		}
		else
		{
			$avatar = $this->input->post('avatar', TRUE);
			$id     = $this->session->userdata('id');

			$this->db->set('avatar', $avatar)->where('id', $id)->update('users');

			$this->session->set_flashdata('success', lang('avatar_changed'));
			redirect(site_url('user/settings'));
		}
	}
}
