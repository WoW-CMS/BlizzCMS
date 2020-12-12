<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model
{
	protected $topsites = 'topsites';
	protected $topsites_logs = 'topsites_logs';

	/**
	 * Get all topsites
	 *
	 * @return array
	 */
	public function get_all()
	{
		return $this->db->get($this->topsites)->result();
	}

	/**
	 * Get topsite
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_topsite($id)
	{
		return $this->db->where('id', $id)->get($this->topsites)->row();
	}

	/**
	 * Find if the topsite exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_topsite($id)
	{
		$query = $this->db->where('id', $id)->get($this->topsites)->num_rows();

		return ($query == 1);
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
