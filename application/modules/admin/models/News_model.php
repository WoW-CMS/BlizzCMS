<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model
{
	protected $news = 'news';

	/**
	 * Count all news
	 *
	 * @return int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->news);
	}

	/**
	 * Get all news
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all($limit, $start)
	{
		return $this->db->limit($limit, $start)->order_by('id', 'DESC')->get($this->news)->result();
	}

	/**
	 * Get news
	 *
	 * @param int $id
	 * @return array
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->news)->row();
	}

	/**
	 * Check if news exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_id($id)
	{
		$result = $this->db->where('id', $id)->get($this->news)->num_rows();

		return ($result == 1);
	}
}