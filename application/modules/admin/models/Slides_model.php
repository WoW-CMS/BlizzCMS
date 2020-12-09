<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slides_model extends CI_Model
{
	protected $slides = 'slides';

	/**
	 * Count all slides
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->slides);
	}

	/**
	 * Get all slides
	 *
	 * @return array
	 */
	public function get_all()
	{
		return $this->db->get($this->slides)->result();
	}

	/**
	 * Get slide
	 *
	 * @param int $id
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->slides)->row();
	}

	/**
	 * Check if slide exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->slides)->num_rows();

		return ($result == 1);
	}
}