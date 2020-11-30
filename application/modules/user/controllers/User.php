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

class User extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function login()
	{
		if ($this->website->isLogged())
		{
			redirect('panel');
		}

		$this->template->title(config_item('app_name'), lang('tab_login'));

		if ($this->base->getExpansionAction() == 1)
		{
			if ($this->base->getEmulatorAction() == 1)
			{
				$this->template->build('login2');
			}
			else
			{
				$this->template->build('login1');
			}
		}
		else
		{
			$this->template->build('login2');
		}
	}

	public function verify1()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		echo $this->user_model->checklogin($username, $password);
	}

	public function verify2()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		echo $this->user_model->checkloginbattle($email, $password);
	}

	public function register()
	{
		if ($this->website->isLogged())
		{
			redirect('panel');
		}

		$this->template->title(config_item('app_name'), lang('tab_register'));

		$this->template->build('register');
	}

	public function newaccount()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		echo $this->user_model->insertRegister($username, $email, $password, $repassword);
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

	public function recovery()
	{
		if ($this->website->isLogged())
		{
			redirect('panel');
		}

		$this->template->title(config_item('app_name'), lang('tab_reset'));

		$this->template->build('recovery');
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
		if (! $this->website->isLogged())
		{
			redirect('login');
		}

		$this->template->title(config_item('app_name'), lang('tab_account'));

		$this->template->build('panel');
	}

	public function settings()
	{
		if (! $this->website->isLogged())
		{
			redirect('login');
		}

		$this->template->title(config_item('app_name'), lang('tab_account'));

		$this->template->build('settings');
	}

	public function newusername()
	{
		$username = $this->input->post('newusername');
		$renewusername = $this->input->post('renewusername');
		$password = $this->input->post('password');

		echo $this->user_model->changeUsername($username, $renewusername, $password);
	}

	public function newpass()
	{
		$oldpass = $this->input->post('oldpass');
		$newpass = $this->input->post('newpass');
		$renewpass = $this->input->post('renewpass');
		echo $this->user_model->changePassword($oldpass, $newpass, $renewpass);
	}

	public function newemail()
	{
		$newemail = $this->input->post('newemail');
		$renewemail = $this->input->post('renewemail');
		$password = $this->input->post('password');
		echo $this->user_model->changeEmail($newemail, $renewemail, $password);
	}

	public function newavatar()
	{
		$avatar = $this->input->post('avatar');
		echo $this->user_model->changeAvatar($avatar);
	}
}
