<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	protected $users = 'users';

	/**
	 * Count all users
	 *
	 * @param string $search
	 * @return int
	 */
	public function count_all($search = '')
	{
		if ($search === '')
		{
			return $this->db->count_all($this->users);
		}

		return $this->db->from($this->users)->like('nickname', $search)->or_like('username', $search)->or_like('email', $search)->count_all_results();
	}

	/**
	 * Get all users
	 *
	 * @param int $limit
	 * @param int $start
	 * @param string $search
	 * @return array
	 */
	public function get_all($limit, $start, $search = '')
	{
		if ($search === '')
		{
			return $this->db->limit($limit, $start)->order_by('id', 'DESC')->get($this->users)->result();
		}

		return $this->db->group_start()->like('nickname', $search)->or_like('username', $search)->or_like('email', $search)->group_end()->limit($limit, $start)->order_by('id', 'DESC')->get($this->users)->result();
	}

	/**
	 * Get user
	 *
	 * @param int $id
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->users)->row();
	}

	/**
	 * Check if user exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->users)->num_rows();

		return ($result == 1);
	}
}