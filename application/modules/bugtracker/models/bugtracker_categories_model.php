<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugtracker_categories_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'bugtracker_categories';

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
     * Get all categories
     *
     * @return array
     */
    public function get_categories()
    {
        return $this->db->get($this->table)->result();
    }

    /**
     * Get category name
     *
     * @param int $category
     * @return string
     */
    public function name($category)
    {
        $row = $this->find(['id' => $category]);
        return $row->name;
    }
}
