<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2019, WoW-CMS
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017+, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

class User extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');

		if (!ini_get('date.timezone'))
		{
			date_default_timezone_set($this->config->item('timezone'));
		}
	}

	public function login()
	{
		if (!$this->wowmodule->getStatusModule('Login'))
		{
			redirect(base_url(),'refresh');
		}

		if ($this->wowauth->isLogged())
		{
			redirect(base_url(),'refresh');
		}

		$data = [
			'pagetitle' => $this->lang->line('tab_login'),
			'recapKey' => $this->config->item('recaptcha_sitekey'),
			'lang' => $this->lang->lang()
		];

		if ($this->input->method() == 'post')
		{
			$rules = [
				[
					'field' => 'username',
					'label' => 'Username/Email',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				]
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('login', $data);
			}
			else
			{
				$username = $this->input->post('username', TRUE);
				$password = $this->input->post('password');
				$response = $this->user_model->authentication($username, $password);

				if (!$response)
				{
					$data['msg_error_login'] = lang('notification_user_error');
					$this->template->build('login', $data);
				}
				else
				{
					redirect(site_url('panel'));
				}
			}
		}
		else
		{
			$this->template->build('login', $data);
		}
	}

	public function register()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url('maintenance'),'refresh');
		}

		if (!$this->wowmodule->getStatusModule('Register'))
		{
			redirect(base_url(),'refresh');
		}

		if ($this->wowauth->isLogged())
		{
			redirect(base_url(), 'refresh');
		}

		$data = [
			'pagetitle' => $this->lang->line('tab_register'),
			'recapKey' => $this->config->item('recaptcha_sitekey'),
			'lang' => $this->lang->lang()
		];

		if ($this->input->method() == 'post')
		{
			$rules = [
				[
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required|alpha_numeric|min_length[3]|max_length[16]|differs[nickname]',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|alpha_numeric|min_length[8]',
					'errors' => [
						'required' => 'You must provide a %s.',
						'alpha_numeric' => 'The %s must be at least 8 alphanumeric characters long.',
						'min_length[8]' => 'The %s must contain numbers and letters.'
					]
				],
				[
					'field' => 'confirm_password',
					'label' => 'Confirm password',
					'rules' => 'trim|required|min_length[8]|matches[password]',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				]
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('register', $data);
			}
			else
			{
				$username = $this->input->post('username', TRUE);
				$email = $this->input->post('email', TRUE);
				$password = $this->input->post('password');
				$emulator = $this->config->item('emulator');


				if (!$this->wowauth->account_unique($username, 'username'))
				{
					$data['msg_notification_account_already_exist'] = lang('notification_account_already_exist');
					$this->template->build('register', $data);
					return false;
				}

				if (!$this->wowauth->account_unique($email, 'email'))
				{
					$data['msg_notification_used_email'] = lang('notification_used_email');
					$this->template->build('register', $data);
					return false;
				}

				if ($this->wowmodule->getStatusModule('reCaptcha'))
				{
					$score = get_recapture_score($this->input->post('g-recaptcha-response'));

					if($score < RECAPTCHA_ACCEPTABLE_SPAM_SCORE){
						$data['msg_notification_used_email'] = 'A low score has been detected when registering an account on our site.';
						$this->template->build('register', $data);
						return false;
					}
				}

				$register = $this->user_model->insertRegister($username, $email, $password, $emulator);

				if ($register)
				{
					redirect(site_url('login'));
				}
				else
				{
					$data['msg_notification_account_not_created'] = lang('notification_account_not_created');
					$this->template->build('register', $data);
				}
			}
		}
		else
		{
			$this->template->build('register', $data);
		}
	}

	public function logout()
	{
		$this->wowauth->logout();
	}

	public function recovery()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url('maintenance'),'refresh');
		}

		if (!$this->wowmodule->getStatusModule('Recovery'))
		{
			redirect(base_url(),'refresh');
		}

		if ($this->wowauth->isLogged())
		{
			redirect(base_url(),'refresh');
		}

		$data = [
			'pagetitle' => $this->lang->line('tab_reset'),
			'recapKey' => $this->config->item('recaptcha_sitekey'),
			'lang' => $this->lang->lang(),
		];

		$this->template->build('recovery', $data);
	}

	public function forgotpassword()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		echo $this->user_model->sendpassword($username, $email);
	}

	public function activate($key)
	{
		echo $this->user_model->activateAccount($key);
	}

	public function panel()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url(),'refresh');
		}

		if (!$this->wowmodule->getStatusModule('User Panel'))
		{
			redirect(base_url(),'refresh');
		}

		if (!$this->wowauth->isLogged())
		{
			redirect(base_url(),'refresh');
		}

		$data = [
			'pagetitle' => $this->lang->line('tab_account'),
			'lang' => $this->lang->lang(),
		];

		$this->template->build('panel', $data);
	}

	public function settings()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url(),'refresh');
		}

		if (!$this->wowmodule->getStatusModule('User Panel'))
		{
			redirect(base_url(),'refresh');
		}

		if (!$this->wowauth->isLogged())
		{
			redirect(base_url(),'refresh');
		}

		$data = [
			'pagetitle' => $this->lang->line('tab_account'),
			'lang' => $this->lang->lang(),
		];

		$this->template->build('settings', $data);
	}

	public function newusername()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url('maintenance'),'refresh');
		}

		if ($this->input->method() == 'post')
		{
			$rules = [
				[
					'field' => 'newusername',
					'label' => 'New username',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'confirmusername',
					'label' => 'Confirm Username',
					'rules' => 'trim|required|matches[newusername]',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				]
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == FALSE)
			{
				redirect(base_url('settings'), 'refresh');
			}
			else
			{
				$username   = $this->wowauth->getSiteUsernameID($this->session->userdata('wow_sess_id'));
				$newusername = $this->input->post('newusername', TRUE);
				$password   = $this->input->post('password');
				$change = $this->user_model->changeUsername($username, $newusername, $password);

				if ($change)
				{
					redirect(site_url('logout'), 'refresh');
				}
				else
				{
					redirect(site_url('settings'), 'refresh');
				}
			}
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}

	public function newpass()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url('maintenance'),'refresh');
		}

		if ($this->input->method() == 'post')
		{
			$rules = [
				[
					'field' => 'change_oldpass',
					'label' => 'Old password',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'change_password',
					'label' => 'New password',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'change_renewchange_password',
					'label' => 'Confirm password',
					'rules' => 'trim|required|matches[change_password]',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				]
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == false)
			{
				redirect(base_url('settings'), 'refresh');
			}
			else
			{
				$oldpass = $this->input->post('change_oldpass');
				$newpass = $this->input->post('change_password');
				$renewpass   = $this->input->post('change_renewchange_password');

				if (! $this->wowauth->valid_password($this->session->userdata('wow_sess_username'), $oldpass))
				{
					redirect(site_url('settings'));
				}

				$change = $this->user_model->changePassword($newpass);

				if ($change)
				{
					redirect(site_url('logout'), 'refresh');
				}
				else
				{
					redirect(site_url('settings'), 'refresh');
				}
			}
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}

	public function newemail()
	{
		if (!$this->wowgeneral->getMaintenance())
		{
			redirect(base_url('maintenance'),'refresh');
		}

		if ($this->input->method() == 'post')
		{
			$rules = [
				[
					'field' => 'change_newemail',
					'label' => 'New email',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				],
				[
					'field' => 'change_renewemail',
					'label' => 'Confirm email',
					'rules' => 'trim|required|matches[change_newemail]',
					'errors' => [
						'required' => 'You must provide a %s.'
						]
				],
				[
					'field' => 'change_password',
					'label' => 'Password',
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'You must provide a %s.'
					]
				]
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == FALSE)
			{
				redirect(base_url('settings'), 'refresh');
			}
			else
			{
				$email = $this->wowauth->getEmailID($this->session->userdata('wow_sess_id'));
				$newemail = $this->input->post('change_newemail', TRUE);
				$password   = $this->input->post('change_password');
				$change = $this->user_model->changeEmail($email, $newemail, $password);

				if ($change)
				{
					redirect(site_url('logout'), 'refresh');
				}
				else
				{
					redirect(site_url('settings'), 'refresh');
				}
			}
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}

	public function newavatar()
	{
		$avatar = $this->input->post('change_avatar');
		$change = $this->user_model->changeAvatar($avatar);

		if ($change)
		{
			redirect(site_url('panel'), 'refresh');
		}
		else
		{
			redirect(site_url('settings'), 'refresh');
		}
	}
}
