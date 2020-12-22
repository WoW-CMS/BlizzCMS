<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model
{
	protected $topsites = 'topsites';
	protected $topsites_logs = 'topsites_logs';

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
		return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->topsites)->result();
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

	/**
	 * Check if the time to vote again is over
	 *
	 * @param int $topsite
	 * @param int|null $user
	 * @return int
	 */
	public function get_expiration($topsite, $user = null)
	{
		$user  = $user ?? $this->session->userdata('id');
		$query = $this->db->where(['topsite_id' => $topsite, 'user_id' => $user])->limit(1)->order_by('id', 'DESC')->get($this->topsites_logs)->row('expired_at');

		return ! empty($query) ? $query : 0;
	}
}
