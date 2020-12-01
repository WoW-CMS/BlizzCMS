<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugtracker_model extends CI_Model
{
	protected $bugtracker = 'bugtracker';

	/**
	 * Get all reports
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all($limit, $start)
	{
		return $this->db->where('close', 0)->order_by('id', 'DESC')->limit($limit, $start)->get($this->bugtracker)->result();
	}

	/**
	 * Count all reports
	 *
	 * @return int
	 */
	public function count_reports()
	{
		return $this->db->count_all($this->bugtracker);
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

	public function change_priority($id, $priority)
	{
		return $this->db->set('priority', $priority)->where('id', $id)->update($this->bugtracker);
	}

	public function change_type($id, $type)
	{
		return $this->db->set('type', $type)->where('id', $id)->update($this->bugtracker);
	}

	public function change_status($id, $status)
	{
		return $this->db->set('status', $status)->where('id', $id)->update($this->bugtracker);
	}

	public function close_report($id)
	{
		return $this->db->set('close', 1)->where('id', $id)->update($this->bugtracker);
	}

	public function insertIssue($title, $description, $type, $priority)
	{
		$this->db->insert($this->bugtracker, [
			'title'       => $title,
			'description' => $description,
			'status'      => '1',
			'type'        => $type,
			'priority'    => $priority,
			'date'        => now(),
			'author'      => $this->session->userdata('id'),
			'close'       => '0'
		]);

		return true;
	}

	public function all_priorities()
	{
		return $this->db->get('bugtracker_priority')->result();
	}

	public function all_status()
	{
		return $this->db->get('bugtracker_status')->result();
	}

	public function all_types()
	{
		return $this->db->get('bugtracker_type')->result();
	}

	public function getType($id)
	{
		return $this->db->select('title')->where('id', $id)->get('bugtracker_type')->row('title');
	}

	public function getStatus($id)
	{
		return $this->db->select('title')->where('id', $id)->get('bugtracker_status')->row('title');
	}

	public function getPriority($id)
	{
		return $this->db->select('title')->where('id', $id)->get('bugtracker_priority')->row('title');
	}
}
