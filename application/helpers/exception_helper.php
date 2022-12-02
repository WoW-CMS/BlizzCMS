<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('show_guest'))
{
    /**
     * Guest page handler
     *
     * @return void
     */
    function show_guest()
    {
        $_error =& load_class('Exceptions', 'core');
        $_error->show_guest();
        exit(0); // EXIT_SUCCESS
    }
}

if (! function_exists('show_loggedin'))
{
    /**
     * Logged in page handler
     *
     * @return void
     */
    function show_loggedin()
    {
        $_error =& load_class('Exceptions', 'core');
        $_error->show_loggedin();
        exit(0); // EXIT_SUCCESS
    }
}

if (! function_exists('show_permission_rejected'))
{
    /**
     * Deny permission page handler
     *
     * @return void
     */
    function show_permission_rejected()
    {
        $_error =& load_class('Exceptions', 'core');
        $_error->show_permission_rejected();
        exit(0); // EXIT_SUCCESS
    }
}
