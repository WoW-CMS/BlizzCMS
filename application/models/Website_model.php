<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_model extends CI_Model
{
	protected $auth;

	/**
	 * Auth_model constructor.
	 */
	public function __construct()
	{
		$this->auth = $this->load->database('auth', TRUE);

		if ($this->isLogged() && $this->checkAccountExist() == 0)
		{
			$this->synchronizeAccount();
		}
	}

	public function arraySession($id)
	{
		$this->session->set_userdata([
			'id'        => $id,
			'username'  => $this->getUsernameID($id),
			'nickname'  => $this->getSiteUsernameID($id),
			'email'     => $this->getEmailID($id),
			'gmlevel'   => $this->getRank($id),
			'logged_in' => TRUE
		]);

		return true;
	}

	public function isLogged()
	{
		if ($this->session->userdata('username'))
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
		return $this->auth->where('id', $id)->get('account')->row('joindate');
	}

	public function getRank($id)
	{
		$query = $this->auth->where('id', $id)->get('account_access')->row('gmlevel');

		return ! empty($query) ? $query : 0;
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
		return $this->db->where('id', $this->session->userdata('id'))->get('users')->num_rows();
	}

	public function synchronizeAccount()
	{
		if ($this->checkAccountExist() == 0)
		{
			$joindate = strtotime($this->getJoinDateID($this->session->userdata('id')));

			$data = array(
				'id' => $this->session->userdata('id'),
				'username' => $this->session->userdata('username'),
				'email' => $this->session->userdata('email'),
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
		$config = config_item('admin_access_level');
		$query  = $this->auth->where('id', $this->session->userdata('id'))->get('account_access')->row('gmlevel');

		if (empty($query))
		{
			return false;
		}

		return ($query >= (int) $config);
	}

	public function getIsModerator()
	{
		$config = config_item('mod_access_level');
		$query  = $this->auth->where('id', $this->session->userdata('id'))->get('account_access')->row('gmlevel');

		if (empty($query))
		{
			return false;
		}

		return ($query >= (int) $config);
	}
}
