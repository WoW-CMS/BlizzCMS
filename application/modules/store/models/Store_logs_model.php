<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_logs_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'store_logs';

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
     * @param int $limit
     * @param int $start
     * @param string $search
     * @return array
     */
    public function find_all($limit, $start, $search = '')
    {
        $query = $this->db->select('store_logs.*, store.name AS category, store_items.name AS item, users.username')
                    ->from($this->table)
                    ->join('store', 'store_logs.store_id = store.id')
                    ->join('store_items', 'store_logs.item_id = store_items.id')
                    ->join('users', 'store_logs.user_id = users.id');

        if ($search !== '') {
            $query = $query->like('store.name', $search)
                        ->or_like('store_items.name', $search)
                        ->or_like('users.username', $search)
                        ->or_like('store_logs.price_type', $search)
                        ->or_like('store_logs.character', $search);
        }

        return $query->order_by('store_logs.id', 'DESC')
                    ->limit($limit, $start)
                    ->get()
                    ->result();
    }

    /**
     * Count all records
     *
     * @param string $search
     * @return int
     */
    public function count_all($search = '')
    {
        if ($search === '') {
            return $this->db->count_all($this->table);
        }

        return $this->db->select('store_logs.*, store.name AS category, store_items.name AS item, users.username')
                    ->from($this->table)
                    ->join('store', 'store_logs.store_id = store.id')
                    ->join('store_items', 'store_logs.item_id = store_items.id')
                    ->join('users', 'store_logs.user_id = users.id')
                    ->like('store.name', $search)
                    ->or_like('store_items.name', $search)
                    ->or_like('users.username', $search)
                    ->or_like('store_logs.price_type', $search)
                    ->or_like('store_logs.character', $search)
                    ->count_all_results();
    }
}
