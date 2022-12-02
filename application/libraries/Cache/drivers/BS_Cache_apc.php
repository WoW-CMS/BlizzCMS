<?php
/**
 * @author WitER
 * @copyright Copyright (c) 2018, WitER (https://github.com/WitER)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BS_Cache_apc extends CI_Cache_apc
{
    /**
     * Get all cache keys
     *
     * @return array
     */
    public function get_keys()
    {
        $keys = apc_cache_info('user');

        if (! $keys) {
            return [];
        }

        $keys = array_column($keys['cache_list'], 'info');

        return $keys;
    }
}
