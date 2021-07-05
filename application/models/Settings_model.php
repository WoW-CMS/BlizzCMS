<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'settings';

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
     * Update multiple records
     *
     * @param array $set
     * @param string $where
     * @return bool
     */
    public function update_batch(array $set, $where)
    {
        return $this->db->update_batch($this->table, $set, $where);
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
     * Get all records saved on cache
     *
     * @return mixed
     */
    public function saved()
    {
        if (! $this->db->table_exists($this->table)) {
            return false;
        }

        $cache = $this->cache->file->get('settings');

        if ($cache !== false) {
            return $cache;
        }

        $rows = $this->find_all();

        $this->cache->file->save('settings', $rows, 604800);

        return $rows;
    }

    /**
     * Get the saved value from a cached record of settings
     *
     * @param string $key
     * @return mixed
     */
    public function saved_value($key)
    {
        if (! $this->db->table_exists($this->table)) {
            return null;
        }

        $cache = $this->cache->file->get('settings');

        if ($cache !== false) {
            $filtered = current(array_filter($cache, static function($item) use ($key) {
                return $item->key == $key;
            }));

            if ($filtered !== false) {
                return $filtered->value;
            }
        }

        return null;
    }
}