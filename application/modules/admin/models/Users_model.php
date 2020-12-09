<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	protected $users = 'users';

	/**
	 * Count all users
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->users);
	}

	/**
	 * Get all users
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all($limit, $start)
	{
		return $this->db->limit($limit, $start)->order_by('id', 'DESC')->get($this->users)->result();
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