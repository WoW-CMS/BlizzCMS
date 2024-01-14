<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
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

        if (! empty($vars) && is_array($vars)) {
            $line = vsprintf(strip_tags($line, '<em><s><sub><sup><small><strong><u>'), $vars);
        }

        return $line;
    }
}
