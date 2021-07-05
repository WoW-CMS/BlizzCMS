<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_items_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'store_items';

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
     * Set record
     *
     * @param array $keys
     * @param array $where
     * @param bool $escape
     * @return bool
     */
    public function set(array $keys, array $where, $escape = null)
    {
        return $this->db->set($keys, '', $escape)
                    ->where($where)
                    ->update($this->table);
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
     * @param int $store
     * @param int $limit
     * @param int $start
     * @return array
     */
    public function find_all($store, $limit, $start)
    {
        return $this->db->where('store_id', $store)
                    ->limit($limit, $start)
                    ->get($this->table)
                    ->result();
    }

    /**
     * Count all records
     *
     * @param int|null $store
     * @return int
     */
    public function count_all($store = null)
    {
        if (is_null($store)) {
            return $this->db->count_all($this->table);
        }

        return $this->db->where('store_id', $store)->count_all_results($this->table);
    }

    /**
     * Get top items queries
     *
     * @return array
     */
    public function top()
    {
        return $this->db->where('top', 1)->get($this->table)->result();
    }
}
