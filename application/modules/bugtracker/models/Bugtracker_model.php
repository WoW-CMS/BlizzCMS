<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugtracker_model extends CI_Model
{
	protected $bugtracker = 'bugtracker';
	protected $bugtracker_comments = 'bugtracker_comments';
	protected $bugtracker_categories = 'bugtracker_categories';

	/**
	 * Get all reports
	 *
	 * @param int $limit
	 * @param int $start
	 * @param string $search
	 * @param string $category
	 * @return array
	 */
	public function get_all($limit, $start, $search = '', $category = '')
	{
		if ($search === '' && empty($category))
		{
			return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->bugtracker)->result();
		}

		$query = $this->db->group_start()->like('title', $search)->or_like('description', $search)->group_end();

		if ($category !== '')
		{
			$query = $query->where('category_id', $category);
		}

		return $query->order_by('id', 'DESC')->limit($limit, $start)->get($this->bugtracker)->result();
	}

	/**
	 * Count all reports
	 *
	 * @param string $search
	 * @param string $category
	 * @return int
	 */
	public function count_reports($search = '', $category = '')
	{
		if ($search === '' && empty($category))
		{
			return $this->db->count_all($this->bugtracker);
		}

		$query = $this->db->from($this->bugtracker);

		if ($category !== '')
		{
			$query = $query->where('category_id', $category);
		}

		return $query->like('title', $search)->or_like('description', $search)->count_all_results();
	}

	/**
	 * Get report
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_report($id)
	{
		return $this->db->where('id', $id)->get($this->bugtracker)->row();
	}

	/**
	 * Find if the report exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_report($id)
	{
		$query = $this->db->where('id', $id)->get($this->bugtracker)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get all comments of a report
	 *
	 * @param int $id
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all_comments($id, $limit, $start)
	{
		return $this->db->where('report_id', $id)->order_by('created_at', 'ASC')->limit($limit, $start)->get($this->bugtracker_comments)->result();
	}

	/**
	 * Count all comments of a report
	 *
	 * @param int $id
	 * @return int
	 */
	public function count_comments($id)
	{
		return $this->db->where('report_id', $id)->count_all_results($this->bugtracker_comments);
	}

	/**
	 * Get report comment
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_comment($id)
	{
		return $this->db->where('id', $id)->get($this->bugtracker_comments)->row();
	}

	/**
	 * Get latest comments
	 *
	 * @param int $limit
	 * @return array
	 */
	public function latest_comments($limit = 5)
	{
		return $this->db->order_by('created_at', 'ASC')->limit($limit)->get($this->bugtracker_comments)->result();
	}

	/**
	 * Get all categories
	 *
	 * @return array
	 */
	public function get_categories()
	{
		return $this->db->get($this->bugtracker_categories)->result();
	}

	/**
	 * Get category name
	 *
	 * @param int $id
	 * @return string
	 */
	public function category_name($id)
	{
		return $this->db->where('id', $id)->get($this->bugtracker_categories)->row('name');
	}
}
