<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'forum';

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
     * @param int|null $parent
     * @param string|null $type
     * @return array
     */
    public function find_all($parent = 0, $type = null)
    {
        $query = $this->db->from($this->table);

        if (! is_null($parent))
        {
            $query = $query->where('parent', $parent);
        }

        if (in_array($type, ['category', 'forum'], true))
        {
            $query = $query->where('type', $type);
        }

        return $query->get()->result();
    }
}
