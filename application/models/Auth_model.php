<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	/**
	 * Return connection to auth DB
	 *
	 * @return object
	 */
	public function connect()
	{
		$auth_db = $this->load->database('auth', TRUE);

		if ($auth_db->conn_id === FALSE)
		{
			show_error(lang('error_auth_connection'));
		}

		return $auth_db;
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
		$account  = $this->connect()->where('username', $username)->or_where('email', $username)->get('account')->row();
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
	 * Get auth account
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_account($id)
	{
		return $this->connect()->where('id', $id)->get('account')->row();
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
		$query = $this->connect()->where($column, $data)->get('account')->num_rows();

		return ($query == 0);
	}

	/**
	 * Get gmlevel of account
	 *
	 * @param int|null $id
	 * @return int
	 */
	public function get_gmlevel($id = null)
	{
		$id       = $id ?? $this->session->userdata('id');
		$emulator = config_item('emulator');

		if (in_array($emulator, ['trinity'], true))
		{
			$query = $this->connect()->where('AccountID', $id)->get('account_access')->row('SecurityLevel');		
		}
		elseif (in_array($emulator, ['azeroth', 'old_trinity'], true))
		{
			$query = $this->connect()->where('id', $id)->get('account_access')->row('gmlevel');
		}

		return ! empty($query) ? $query : 0;
	}

	/**
	 * Check if account is banned
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function is_banned($id = null)
	{
		$id = $id ?? $this->session->userdata('id');

		$query = $this->connect()->where(['id' => $id, 'active' => 1])->get('account_banned')->num_rows();

		return ($query >= 1);
	}

	/**
	 * Check if account has admin access
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function is_admin($id = null)
	{
		$config = config_item('admin_access_level');
		$access = $this->get_gmlevel($id);

		return ($access >= (int) $config);
	}

	/**
	 * Check if account has moderator access
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function is_moderator($id = null)
	{
		$config = config_item('mod_access_level');
		$access = $this->get_gmlevel($id);

		return ($access >= (int) $config);
	}
}