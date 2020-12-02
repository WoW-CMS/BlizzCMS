<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	protected $auth_db;

	public function __construct()
	{
		$this->auth_db = $this->load->database('auth', TRUE);
	}

	/**
	 * Return connection to auth DB
	 *
	 * @return object
	 */
	public function connect()
	{
		return $this->auth_db;
	}

	/**
	 * Validate password
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function valid_password($username, $password)
	{
		$account  = $this->auth_db->where('username', $username)->or_where('email', $username)->get('account')->row();
		$emulator = config_item('emulator');

		if (empty($account))
		{
			return false;
		}

		switch ($emulator)
		{
			case 'trinity':
				$validate = ($account->verifier === game_hash($account->username, $password, 'srp6', $account->salt));
				break;
			case 'azeroth':
			case 'old_trinity':
				$validate = hash_equals(strtoupper($account->sha_pass_hash), game_hash($account->username, $password));
				break;
			default:
				$validate = false;
				break;
		}

		return $validate;
	}

	/**
	 * Get gmlevel of account
	 *
	 * @param int $id
	 * @return int
	 */
	public function get_gmlevel($id)
	{
		$query = $this->auth_db->where('id', $id)->get('account_access')->row('gmlevel');

		return ! empty($query) ? $query : 0;
	}

	/**
	 * Get auth account
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_account($id)
	{
		return $this->auth_db->where('id', $id)->get('account')->row();
	}

	/**
	 * Check if username and email is unique in auth
	 *
	 * @param string $data
	 * @param string $column
	 * @return bool
	 */
	public function account_unique($data, $column = 'username')
	{
		$query = $this->auth_db->where($column, $data)->get('account')->num_rows();

		return ($query == 0);
	}

	/**
	 * Check if account is banned
	 *
	 * @param int $id
	 * @return bool
	 */
	public function is_banned($id)
	{
		$query = $this->auth_db->where(['id' => $id, 'active' => 1])->get('account_banned')->num_rows();

		return ($query >= 1);
	}

	/**
	 * Check if account has admin access
	 *
	 * @return bool
	 */
	public function is_admin()
	{
		$config = config_item('admin_access_level');
		$query  = $this->auth_db->where('id', $this->session->userdata('id'))->get('account_access')->row('gmlevel');

		if (empty($query))
		{
			return false;
		}

		return ($query >= (int) $config);
	}

	/**
	 * Check if account has moderator access
	 *
	 * @return bool
	 */
	public function is_moderator()
	{
		$config = config_item('mod_access_level');
		$query  = $this->auth_db->where('id', $this->session->userdata('id'))->get('account_access')->row('gmlevel');

		if (empty($query))
		{
			return false;
		}

		return ($query >= (int) $config);
	}
}