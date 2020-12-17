<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	protected $menu = 'menu';

	/**
	 * Count all menu rows
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->menu);
	}

	/**
	 * Get all menu rows
	 *
	 * @return array
	 */
	public function get_all()
	{
		return $this->db->get($this->menu)->result();
	}

	/**
	 * Get menu
	 *
	 * @param int $id
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->menu)->row();
	}

	/**
	 * Check if menu exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->menu)->num_rows();

		return ($result == 1);
	}

	/**
	 * Find all parents menu (dropdown)
	 *
	 * @return array
	 */
	public function find_parents()
	{
		return $this->db->where('type', 2)->get($this->menu)->result();
	}
}