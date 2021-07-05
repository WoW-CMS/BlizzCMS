<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_posts_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'forum_posts';

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
     * @param int $topic
     * @param int $limit
     * @param int $start
     * @return array
     */
    public function find_all($topic, $limit, $start)
    {
        return $this->db->where('topic_id', $topic)
                    ->order_by('created_at', 'ASC')
                    ->limit($limit, $start)
                    ->get($this->table)
                    ->result();
    }

    /**
     * Count all records
     *
     * @param int|null $topic
     * @return int
     */
    public function count_all($topic = null)
    {
        if (is_null($topic)) {
            return $this->db->count_all($this->table);
        }

        return $this->db->where('topic_id', $topic)->count_all_results($this->table);
    }

    /**
     * Get the last post query
     *
     * @param int $topic
     * @return array
     */
    public function last($topic)
    {
        return $this->db->where('topic_id', $topic)
                    ->order_by('created_at', 'DESC')
                    ->limit(1)
                    ->get($this->table)
                    ->result();
    }
}
