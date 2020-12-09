<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_model extends CI_Model
{
	/**
	 * Authentication
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function authentication($username, $password)
	{
		$accgame  = $this->auth->connect()->where('username', $username)->or_where('email', $username)->get('account')->row();
		$emulator = config_item('emulator');

		if (empty($accgame))
		{
			return false;
		}

		switch ($emulator)
		{
			case 'trinity':
				$validate = ($accgame->verifier === game_hash($accgame->username, $password, 'srp6', $accgame->salt));
				break;
			case 'azeroth':
			case 'old_trinity':
				$validate = hash_equals(strtoupper($accgame->sha_pass_hash), game_hash($accgame->username, $password));
				break;
			default:
				$validate = false;
				break;
		}

		if (! $validate)
		{
			return false;
		}

		// if account on website don't exist sync values from game account
		if (! $this->find_user($accgame->id))
		{
			$this->db->insert('users', [
				'id'        => $accgame->id,
				'nickname'  => $accgame->username,
				'username'  => $accgame->username,
				'email'     => $accgame->email,
				'joined_at' => strtotime($accgame->joindate)
			]);
		}

		$data = $this->get_user($accgame->id);
		// Set session
		$this->session->set_userdata([
			'id'        => $data->id,
			'nickname'  => $data->nickname,
			'username'  => $data->username,
			'email'     => $data->email,
			'gmlevel'   => $this->auth->get_gmlevel($data->id),
			'logged_in' => TRUE
		]);

		return true;	
	}

	/**
	 * Check if user is logged
	 *
	 * @return boolean
	 */
	public function isLogged()
	{
		if ($this->session->userdata('id') && $this->session->logged_in)
		{
			return true;
		}

		return false;
	}

	/**
	 * Get avatar name of specific user
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function user_avatar($id = null)
	{
		$avatar = $this->get_user($id, 'avatar');

		return $this->db->where('id', $avatar)->get('avatars')->row('name');
	}

	/**
	 * Check if user exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_user($id)
	{
		$query = $this->db->where('id', $id)->get('users')->num_rows();

		return ($query == 1);
	}

	/**
	 * Get user information
	 *
	 * @param int $id
	 * @param string $column
	 * @return mixed
	 */
	public function get_user($id = null, $column = null)
	{
		$id = $id ?? $this->session->userdata('id');

		$query = $this->db->where('id', $id)->get('users')->row();

		if (empty($query))
		{
			return null;
		}

		if (property_exists($query, $column))
		{
			return $query->$column;
		}

		return $query;
	}
}
