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

class Langs_hook
{
    public function initialize()
    {
        $CI =& get_instance();

        $CI->load->helper('language');

        $lang  = $CI->language->current();
        $files = ['general', 'alerts'];

        foreach ($files as $value) {
            $CI->lang->load($value, $lang);
        }

        $CI->config->set_item('language', $lang);
    }
}