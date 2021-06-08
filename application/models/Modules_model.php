<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'modules';

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
     * @return array
     */
    public function find_all()
    {
        if (! $this->db->table_exists($this->table)) {
            return [];
        }

        return $this->db->get($this->table)->result();
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

    /**
     * Check if the module exist in a cached record
     *
     * @param string $module
     * @return bool
     */
    public function mod_saved($module)
    {
        $cache = $this->cache->file->get('modules');

        if ($cache !== false)
        {
            return in_array($module, $cache, true);
        }

        $rows = $this->db->get($this->table)->result_array();
        $list  = array_column($rows, 'module');

        $this->cache->file->save('modules', $list, 604800);

        return in_array($module, $list, true);
    }
}