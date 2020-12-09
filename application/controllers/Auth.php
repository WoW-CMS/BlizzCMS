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

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function login()
	{
		if ($this->website->isLogged())
		{
			redirect(site_url('user'));
		}

		$this->template->title(config_item('app_name'), lang('tab_login'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('username', 'Username/Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if (config_item('captcha_login') == 'true')
			{
				$captcha_rule = (config_item('captcha_type') == 'hcaptcha') ? 'h-captcha-response' : 'g-recaptcha-response';
				$this->form_validation->set_rules($captcha_rule, 'Captcha', 'trim|required|validate_captcha');
			}

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('auth/login');
			}
			else
			{
				$response = $this->website->authentication(
					$this->input->post('username', TRUE),
					$this->input->post('password')
				);

				if (! $response)
				{
					$this->session->set_flashdata('error', lang('notification_user_error'));
					$this->template->build('auth/login');
				}
				else
				{
					redirect(site_url('user'));
				}
			}
		}
		else
		{
			$this->template->build('auth/login');
		}
	}

	public function logout()
	{
		if (! $this->website->isLogged())
		{
			show_404();
		}

		$this->session->sess_destroy();
		redirect(site_url());
	}

	public function register()
	{
		if ($this->website->isLogged())
		{
			redirect(site_url('user'));
		}

		$this->template->title(config_item('app_name'), lang('tab_register'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|alpha_numeric|max_length[16]');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[3]|max_length[16]|differs[nickname]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[8]|matches[password]');

			if (config_item('captcha_register') == 'true')
			{
				$captcha_rule = (config_item('captcha_type') == 'hcaptcha') ? 'h-captcha-response' : 'g-recaptcha-response';
				$this->form_validation->set_rules($captcha_rule, 'Captcha', 'trim|required|validate_captcha');
			}

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('auth/register');
			}
			else
			{
				$nickname   = $this->input->post('nickname', TRUE);
				$username   = $this->input->post('username', TRUE);
				$email      = $this->input->post('email', TRUE);
				$password   = $this->input->post('password');

				$emulator       = config_item('emulator');
				$validation     = (config_item('register_validation') == 'true');
				$is_pending     = false;

				if (! $this->auth->account_unique($username, 'username'))
				{
					$this->session->set_flashdata('error', 'Username is already in use');
					redirect(site_url('register'));
				}

				if (! $this->auth->account_unique($email, 'email'))
				{
					$this->session->set_flashdata('error', 'Email is already in use');
					redirect(site_url('register'));
				}

				if ($is_pending)
				{
					$this->session->set_flashdata('warning', 'account pending');
					redirect(site_url('register'));
				}

				if ($validation)
				{
					// $this->base->send_email($email, lang('email_subject_validation'), $message);

					$this->session->set_flashdata('warning', lang('alert_account_pending'));
					redirect(site_url('register'));
				}
				else
				{
					if (in_array($emulator, ['trinity'], true))
					{
						$salt = random_bytes(32);

						$this->auth->connect()->insert('account', [
							'username'  => $username,
							'salt'      => $salt,
							'verifier'  => game_hash($username, $password, 'srp6', $salt),
							'email'     => $email,
							'expansion' => config_item('expansion')
						]);
					}
					elseif (in_array($emulator, ['azeroth', 'old_trinity'], true))
					{
						$this->auth->connect()->insert('account', [
							'username'        => $username,
							'sha_pass_hash'   => game_hash($username, $password),
							'email'           => $email,
							'expansion'       => config_item('expansion')
						]);
					}

					$id = $this->auth->connect()->insert_id();

					// Insert/update account if emulator support bnet
					if (config_item('emulator_bnet') == 'true')
					{
						$this->auth->connect()->insert('battlenet_accounts', [
							'id'            => $id,
							'email'         => $email,
							'sha_pass_hash' => game_hash($email, $password, 'bnet')
						]);

						$this->auth->connect()->where('id', $id)->update('account', [
							'battlenet_account' => $id,
							'battlenet_index'   => 1
						]);
					}

					// Add user to website db
					$this->db->insert('users', [
						'id'        => $id,
						'nickname'  => $nickname,
						'username'  => $username,
						'email'     => $email,
						'joined_at' => now()
					]);

					$this->session->set_flashdata('success', lang('alert_account_created'));
					redirect(site_url('login'));
				}
			}
		}
		else
		{
			$this->template->build('auth/register');
		}
	}

	public function recovery()
	{
		if ($this->website->isLogged())
		{
			redirect(site_url('user'));
		}

		$this->template->title(config_item('app_name'), lang('tab_reset'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			if (config_item('captcha_forgot') == 'true')
			{
				$captcha_rule = (config_item('captcha_type') == 'hcaptcha') ? 'h-captcha-response' : 'g-recaptcha-response';
				$this->form_validation->set_rules($captcha_rule, 'Captcha', 'trim|required|validate_captcha');
			}

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('auth/recovery');
			}
			else
			{
				$email = $this->input->post('email', TRUE);

				// $this->base->send_email($email, lang('email_subject_authorize'), $message);

				$this->session->set_flashdata('success', lang('alert_forgot_success'));
				redirect(site_url('recovery'));
			}
		}
		else
		{
			$this->template->build('auth/recovery');
		}
	}
}