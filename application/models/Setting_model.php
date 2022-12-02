<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends BS_Model
{
    protected $table = 'settings';

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all settings rows
     *
     * @return mixed
     */
    public function get_all()
    {
        if (! $this->db->table_exists($this->table)) {
            return [];
        }

        $cache = $this->cache->get('settings');

        if ($cache !== false) {
            return $cache;
        }

        $findAll = $this->find_all();

        $this->cache->save('settings', $findAll, 604800);

        return $findAll;
    }

    /**
     * Get the value of a key setting
     *
     * @param string $key
     * @return mixed
     */
    public function get_value($key)
    {
        if (! $this->db->table_exists($this->table)) {
            return null;
        }

        $cache = $this->cache->get('settings');

        // If the configuration has a valid cache file it will return the value if a key exists
        if ($cache !== false) {
            $filtered = current(array_filter($cache, fn($item) => $item->key === $key));

            if ($filtered !== false) {
                switch ($filtered->type) {
                    case 'bool':
                        return filter_var($filtered->value, FILTER_VALIDATE_BOOLEAN);

                    case 'float':
                        return (float) $filtered->value;

                    case 'int':
                        return (int) $filtered->value;

                    default:
                        return $filtered->value;
                }
            }
        }

        // Find the key if the cache is not valid
        $find = $this->find(['key' => $key]);

        if (empty($find)) {
            return null;
        }

        switch ($find->type) {
            case 'bool':
                return filter_var($find->value, FILTER_VALIDATE_BOOLEAN);

            case 'float':
                return (float) $find->value;

            case 'int':
                return (int) $find->value;

            default:
                return $find->value;
        }
    }
}
