<?php
/**
 * @author WitER
 * @copyright Copyright (c) 2018, WitER (https://github.com/WitER)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BS_Cache extends CI_Cache
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * Delete cache by key or wildcard
     *
     * @param string $id
     * @return int|bool
     */
    public function delete($id)
    {
        if (strpos($id, '*') !== false) {
            $id = str_replace('*', '', $id);

            return $this->delete_wildcard($id);
        }

        return parent::delete($id);
    }

    /**
     * Get all cache keys
     *
     * @return array
     */
    public function get_keys()
    {
        $keys = $this->{$this->_adapter}->get_keys();
        $keys = array_map(fn($key) => str_replace($this->key_prefix, '', (string) $key), $keys);

        return $keys;
    }

    /**
     * Get all cache keys with meta-data
     *
     * @return array
     */
    public function get_keysmeta()
    {
        $result = [];

        foreach ($this->get_keys() as $key) {
            $result[$key] = $this->get_metadata($key);
        }

        return $result;
    }

    /**
     * Delete cache keys by wildcard
     *
     * Example: ->delete_wildcard('my_cache_')
     *
     * @param string $id
     * @return int
     */
    public function delete_wildcard($id)
    {
        $deleted = 0;

        foreach ($this->get_keys() as $key) {
            if (strpos($key, $id) !== false) {
                $this->delete($key);
                $deleted++;
            }
        }

        return $deleted;
    }
}
