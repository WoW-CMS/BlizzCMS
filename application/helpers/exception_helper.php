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

if (! function_exists('require_login'))
{
    /**
     * Require user to be already logged in to continue
     *
     * @return void
     */
    function require_login()
    {
        $CI =& get_instance();
        $CI->load->model('cms_model');

        if (! $CI->cms_model->isLogged())
        {
            return show_loggedin();
        }
    }
}

if (! function_exists('require_guest'))
{
    /**
     * Require user not to be logged in yet to continue
     *
     * @return void
     */
    function require_guest()
    {
        $CI =& get_instance();
        $CI->load->model('cms_model');

        if ($CI->cms_model->isLogged())
        {
            return show_guest();
        }
    }
}