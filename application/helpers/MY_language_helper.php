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

if (! function_exists('lang_vars'))
{
    /**
     * Replace variables inside lang line
     * 
     * @param string $line
     * @param array $vars
     * @return string
     */
    function lang_vars($line, $vars = [])
    {
        $line = get_instance()->lang->line($line);

        if (! empty($vars) && is_array($vars))
        {
            $line = vsprintf(strip_tags($line, '<b><sub><sup><small>'), $vars);
        }

        return $line;
    }
}