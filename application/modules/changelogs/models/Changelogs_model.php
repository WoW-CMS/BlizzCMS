<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs_model extends CI_Model
{
	protected $changelogs = 'changelogs';

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
	 * Count all changelogs
	 *
	 * @return int
	 */
	public function count_changelogs()
	{
		return $this->db->count_all($this->changelogs);
	}
}
