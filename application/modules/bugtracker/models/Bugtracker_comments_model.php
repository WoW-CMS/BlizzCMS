<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugtracker_comments_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'bugtracker_comments';

    /**
     * Insert new record
     *
     * @param array $set
     * @return bool
     */
    public function create(array $set)
    {
        return $this->db->insert($this->table, $set);
    }

    /**
     * Update record
     *
     * @param array $set
     * @param array $where
     * @return bool
     */
    public function update(array $set, array $where)
    {
        return $this->db->update($this->table, $set, $where);
    }

    /**
     * Delete record
     *
     * @param array $where
     * @return mixed
     */
    public function delete(array $where)
    {
        return $this->db->delete($this->table, $where);
    }

    /**
     * Find record
     *
     * @param array $where
     * @return mixed
     */
    public function find(array $where)
    {
        return $this->db->where($where)->get($this->table)->row();
    }

    /**
     * Find all records
     *
     * @param int $id
     * @param int $limit
     * @param int $start
     * @return array
     */
    public function find_all($report, $limit, $start)
    {
        return $this->db->where('report_id', $report)
                    ->order_by('created_at', 'ASC')
                    ->limit($limit, $start)
                    ->get($this->table)
                    ->result();
    }

    /**
     * Count all records
     *
     * @param int $id
     * @return int
     */
    public function count_all($report)
    {
        return $this->db->where('report_id', $report)->count_all_results($this->table);
    }

    /**
     * Get the latest comments records
     *
     * @param int $limit
     * @return array
     */
    public function latest($limit = 5)
    {
        return $this->db->order_by('created_at', 'ASC')
                    ->limit($limit)
                    ->get($this->table)
                    ->result();
    }
}
