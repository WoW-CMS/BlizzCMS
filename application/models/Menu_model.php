<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'menu';

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
     * @param array $where
     * @return array
     */
    public function find_all(array $where = [])
    {
        $query = $this->db->from($this->table);

        if (! empty($where)) {
            $query = $query->where($where); 
        }

        return $query->get()->result();
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
     * Get menu in a cached records
     *
     * @param int $parent
     * @return array
     */
    public function saved($parent = 0)
    {
        if (! $this->db->table_exists($this->table)) {
            return [];
        }

        $cache = $this->cache->file->get('menu_' . $parent);

        if ($cache !== false) {
            return $cache;
        }

        $rows = $this->find_all(['parent' => $parent]);
        $data = [];

        foreach ($rows as $item) {
            $data[] = (object) [
                'id'     => $item->id,
                'name'   => $item->name,
                'url'    => filter_var($item->url, FILTER_VALIDATE_URL) ? $item->url : site_url($item->url),
                'icon'   => $item->icon,
                'target' => $item->target,
                'type'   => $item->type,
                'parent' => $item->parent
            ];
        }

        $this->cache->file->save('menu_' . $parent, $data, 604800);

        return $data;
    }
}