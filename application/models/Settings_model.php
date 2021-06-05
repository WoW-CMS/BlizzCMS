<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    protected $settings_table = 'settings';

    /**
     * Get all rows of settings
     *
     * @return mixed
     */
    public function get_all()
    {
        if (! $this->db->table_exists($this->settings_table))
        {
            return false;
        }

        $data = $this->cache->file->get('settings');

        if ($data !== false)
        {
            return $data;
        }

        $result = $this->db->get($this->settings_table)->result();

        $this->cache->file->save('settings', $result, 604800);

        return $result;
    }

    /**
     * Get value from a key
     *
     * @param string $key
     * @return mixed
     */
    public function get_value($key)
    {
        if (! $this->db->table_exists($this->settings_table))
        {
            return null;
        }

        $data = $this->cache->file->get('settings');

        if ($data !== false)
        {
            $filtered = current(array_filter($data, function($item) use ($key) {
                return $item->key == $key;
            }));

            if ($filtered !== false)
            {
                return $filtered->value;
            }
        }

        return null;
    }
}