<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model
{
	protected $pages = 'pages';

	/**
	 * Count all pages
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->pages);
	}

	/**
	 * Get all pages
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all($limit, $start)
	{
		return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->pages)->result();
	}

	/**
	 * Get page
	 *
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->pages)->row();
	}

	/**
	 * Check if page exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->pages)->num_rows();

		return ($result == 1);
	}
}