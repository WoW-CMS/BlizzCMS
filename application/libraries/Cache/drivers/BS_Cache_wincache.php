<?php
/**
 * @author WitER
 * @copyright Copyright (c) 2018, WitER (https://github.com/WitER)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BS_Cache_wincache extends CI_Cache_wincache
{
    /**
     * Get all cache keys
     *
     * @return array
     */
    public function get_keys()
    {
        $cacheInfo = $this->cache_info();

        return $cacheInfo ? array_column($cacheInfo['ucache_entries'], 'key_name') : [];
    }
}
