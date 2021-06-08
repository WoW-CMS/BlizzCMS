<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topsites_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'topsites';

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
     * @param int $limit
     * @param int $start
     * @return array
     */
    public function find_all($limit, $start)
    {
        return $this->db->order_by('id', 'DESC')
                        ->limit($limit, $start)
                        ->get($this->table)
                        ->result();
    }

    /**
     * Count all records
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
}
