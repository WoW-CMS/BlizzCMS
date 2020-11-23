<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	/**
	 * Auth_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->load->database('auth', TRUE);

		if ($this->isLogged() && $this->checkAccountExist() == 0)
		{
			$this->synchronizeAccount();
		}
	}

	public function arraySession($id)
	{
		$this->session->set_userdata([
			'wow_sess_id'         => $id,
			'wow_sess_username'   => $this->getUsernameID($id),
			'blizz_sess_username' => $this->getSiteUsernameID($id),
			'wow_sess_email'      => $this->getEmailID($id),
			'wow_sess_gmlevel'    => $this->getRank($id),
			'logged_in'           => TRUE
		]);

		return true;
	}

	public function isLogged()
	{
		if ($this->session->userdata('wow_sess_username'))
			return true;
		else
			return false;
	}

	public function getGmSpecify($id)
	{
		return $this->auth->select('id')->where('id', $id)->get('account_access');
	}

	public function randomUTF()
	{
		return rand(0, 999999999);
	}

	public function getUsernameID($id)
	{
		return $this->auth->select('username')->where('id', $id)->get('account')->row('username');
	}

	public function getSiteUsernameID($id)
	{
		return $this->db->select('username')->where('id', $id)->get('users')->row('username');
	}

	public function getEmailID($id)
	{
		return $this->auth->select('email')->where('id', $id)->get('account')->row('email');
	}

	public function getPasswordAccountID($id)
	{
		return $this->auth->select('sha_pass_hash')->where('id', $id)->get('account')->row('sha_pass_hash');
	}

	public function getPasswordBnetID($id)
	{
		return $this->auth->select('sha_pass_hash')->where('id', $id)->get('battlenet_accounts')->row('sha_pass_hash');
	}

	public function getSpecifyAccount($account)
	{
		$account = strtoupper($account);

		return $this->auth->select('id')->where('username', $account)->get('account');
	}

	public function getIDAccount($account)
	{
		$account = strtoupper($account);

		$qq = $this->auth->select('id')->where('username', $account)->get('account');
		
		if($qq->num_rows())
			return $qq->row('id');
		else
			return '0';
	}

	public function getImageProfile($id)
	{
		return $this->db->select('profile')->where('id', $id)->get('users')->row('profile');
	}

	public function getNameAvatar($id)
	{
		return $this->db->select('name')->where('id', $id)->get('avatars')->row('name');
	}

	public function getIDEmail($email)
	{
		$email = strtoupper($email);

		$qq = $this->auth->select('id')->where('email', $email)->get('account');

		if($qq->num_rows())
			return $qq->row('id');
		else
			return '0';
	}

	public function getJoinDateID($id)
	{
		return $this->auth->select('joindate')->where('id', $id)->get('account')->row('joindate');
	}

	public function getRank($id)
	{
		$qq = $this->auth->select('gmlevel')->where('id', $id)->get('account_access');

		if($qq->num_rows())
			return $qq->row('gmlevel');
		else
			return '0';
	}

	public function getBanStatus($id)
	{
		$qq = $this->auth->where('id', $id)->where('active', '1')->get('account_banned');

		if ($qq->num_rows())
			return true;
		else
			return false;
	}

	public function Battlenet($email, $password)
	{
		return strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($email)).":".strtoupper($password))))))));
	}

	public function Account($username, $password)
	{
		if (!is_string($username))
			$username = "";

		if (!is_string($password))
			$password = "";

		$sha_pass_hash = sha1(strtoupper($username).':'.strtoupper($password));

		return strtoupper($sha_pass_hash);
	}

	public function checkAccountExist()
	{
		return $this->db->select('id')->where('id', $this->session->userdata('wow_sess_id'))->get('users')->num_rows();
	}

	public function synchronizeAccount()
	{
		if ($this->checkAccountExist() == 0)
		{
			$joindate = strtotime($this->getJoinDateID($this->session->userdata('wow_sess_id')));

			$data = array(
				'id' => $this->session->userdata('wow_sess_id'),
				'username' => $this->session->userdata('wow_sess_username'),
				'email' => $this->session->userdata('wow_sess_email'),
				'joindate' => $joindate
			);

			$this->db->insert('users', $data);
			return true;
		}
		else
			return false;
	}

	public function getIsAdmin()
	{
		$config = $this->config->item('admin_access_level');

		$qq = $this->auth->select('gmlevel')->where('id', $this->session->userdata('wow_sess_id'))->get('account_access');

		if(!$qq->row('gmlevel'))
			return false;
		else
		{
			if($qq->row('gmlevel') >= $config)
				return true;
			else
			{
				return false;
			}
		}
	}

	public function getIsModerator()
	{
		$config = $this->config->item('mod_access_level');

		$qq = $this->auth->select('gmlevel')->where('id', $this->session->userdata('wow_sess_id'))->get('account_access');

		if(!$qq->row('gmlevel'))
			return false;
		else
		{
			if($qq->row('gmlevel') >= $config)
				return true;
			else
			{
				return false;
			}
		}
	}
}
