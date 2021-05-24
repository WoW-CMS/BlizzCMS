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
	 * @return string
	 */
	public function get_expiration($topsite, $user = null)
	{
		$user  = $user ?? $this->session->userdata('id');
		$query = $this->db->where(['topsite_id' => $topsite, 'user_id' => $user])->order_by('id', 'DESC')->limit(1)->get($this->topsites_logs)->row('expired_at');

		return ! empty($query) ? $query : '2021-01-01 12:00:00';
	}

	/**
	 * Count all logs
	 *
	 * @param string $search
	 * @return int
	 */
	public function count_logs($search = '')
	{
		if ($search === '')
		{
			return $this->db->count_all($this->topsites_logs);
		}

		return $this->db->select('topsites_logs.*, users.username')->from($this->topsites_logs)->join('users', 'topsites_logs.user_id = users.id')->like('users.username', $search)->count_all_results();
	}

	/**
	 * Get all logs
	 *
	 * @param int $limit
	 * @param int $start
	 * @param string $search
	 * @return array
	 */
	public function get_all_logs($limit, $start, $search = '')
	{
		if ($search === '')
		{
			return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->topsites_logs)->result();
		}

		return $this->db->select('topsites_logs.*, users.username')->from($this->topsites_logs)->join('users', 'topsites_logs.user_id = users.id')->like('users.username', $search)->order_by('topsites_logs.id', 'DESC')->limit($limit, $start)->get()->result();
	}
}
