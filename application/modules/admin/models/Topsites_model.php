<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topsites_model extends CI_Model
{
	protected $topsites = 'topsites';

	/**
	 * Count all topsites
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->topsites);
	}

	/**
	 * Get all topsites
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all($limit, $start)
	{
		return $this->db->limit($limit, $start)->order_by('id', 'DESC')->get($this->topsites)->result();
	}

	/**
	 * Get topsite
	 *
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->topsites)->row();
	}

	/**
	 * Check if topsite exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->topsites)->num_rows();

		return ($result == 1);
	}
}