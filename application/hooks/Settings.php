<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings
{
    public function initialize()
    {
        $CI =& get_instance();

        $data = ($CI->load->database() === FALSE) ? $CI->settings_model->saved() : FALSE;

        if ($data) {
            foreach ($data as $row) {
                $CI->config->set_item($row->key, $row->value);
            }
        }
    }
}