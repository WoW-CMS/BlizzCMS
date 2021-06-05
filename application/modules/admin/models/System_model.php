<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_model extends CI_Model
{
    protected $logs = 'logs';

    /**
     * Count all logs
     *
     * @param string $search
     * @return int
     */
    public function count_all($search = '')
    {
        if ($search === '')
        {
            return $this->db->count_all($this->logs);
        }

        return $this->db->select('logs.*, users.username')->from($this->logs)->join('users', 'logs.user_id = users.id')->like('logs.type', $search)->or_like('logs.message', $search)->or_like('users.username', $search)->count_all_results();
    }

    /**
     * Get all logs
     *
     * @param int $limit
     * @param int $start
     * @param string $search
     * @return array
     */
    public function get_all($limit, $start, $search = '')
    {
        if ($search === '')
        {
            return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->logs)->result();
        }

        return $this->db->select('logs.*, users.username')->from($this->logs)->join('users', 'logs.user_id = users.id')->like('logs.type', $search)->or_like('logs.message', $search)->or_like('users.username', $search)->order_by('logs.id', 'DESC')->limit($limit, $start)->get()->result();
    }
}