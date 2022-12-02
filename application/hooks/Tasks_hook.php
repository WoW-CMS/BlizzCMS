<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_hook
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Purge logs on the defined date
     */
    public function auto_purge_logs()
    {
        if ($this->CI->load->database() !== false) {
            return;
        }

        $date = $this->CI->setting_model->get_value('logs_purge_date');

        if (empty($date)) {
            return;
        }

        if (remaining_minutes('now', $date) >= 0) {
            return;
        }

        $interval = $this->CI->setting_model->get_value('logs_keep_interval') ?? '6M';

        $this->CI->setting_model->update([
            'value' => add_timespan('now', 'P' . $interval)
        ], ['key' => 'logs_purge_date']);

        $this->CI->db->truncate('logs');

        $this->CI->cache->delete('settings');
    }
}
