<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_topics_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'forum_topics';

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
     * @param int $forum
     * @param int $limit
     * @param int $start
     * @return array
     */
    public function find_all($forum, $limit, $start)
    {
        return $this->db->where('forum_id', $forum)
                    ->order_by('stick', 'DESC')
                    ->order_by('created_at', 'ASC')
                    ->limit($limit, $start)
                    ->get($this->table)
                    ->result();
    }

    /**
     * Count all records
     *
     * @param int|null $forum
     * @return int
     */
    public function count_all($forum = null)
    {
        if (is_null($forum)) {
            return $this->db->count_all($this->table);
        }

        return $this->db->where('forum_id', $forum)->count_all_results($this->table);
    }

    /**
     * Get the latest topic queries
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

    /**
     * Get the last topic query
     *
     * @param int $forum
     * @return array
     */
    public function last($forum)
    {
        return $this->db->where('forum_id', $forum)
                    ->order_by('created_at', 'DESC')
                    ->limit(1)
                    ->get($this->table)
                    ->result();
    }
}
