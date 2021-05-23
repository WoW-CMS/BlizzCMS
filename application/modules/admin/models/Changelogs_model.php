<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs_model extends CI_Model
{
	protected $changelogs = 'changelogs';

	/**
	 * Count all changelogs
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->changelogs);
	}

	/**
	 * Get all changelogs
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all($limit, $start)
	{
		return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->changelogs)->result();
	}

	/**
	 * Get changelog
	 *
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->changelogs)->row();
	}

	/**
	 * Check if changelog exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->changelogs)->num_rows();

		return ($result == 1);
	}
}