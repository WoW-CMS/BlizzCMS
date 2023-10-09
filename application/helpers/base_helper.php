<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('is_logged_in'))
{
    /**
     * Check if the user has logged in
     *
     * @return bool
     */
    function is_logged_in()
    {
        $CI =& get_instance();
        $CI->load->model('auth_model');

        return $CI->auth_model->is_logged_in();
    }
}

if (! function_exists('user'))
{
    /**
     * Get all user data or a specific one
     *
     * @param string|null $column
     * @param int|null $id
     * @return mixed
     */
    function user($column = null, $id = null)
    {
        $CI =& get_instance();
        $CI->load->model('user_model');

        return $CI->user_model->user($column, $id);
    }
}

if (! function_exists('user_id'))
{
    /**
     * Get the user id by searching a value in a column
     *
     * @param string $value
     * @param string $column
     * @return int
     */
    function user_id($value, $column = 'username')
    {
        $CI =& get_instance();
        $CI->load->model('user_model');

        return $CI->user_model->user_id($value, $column);
    }
}

if (! function_exists('user_avatar'))
{
    /**
     * Get the avatar image of a user
     *
     * @param int|null $id
     * @return string
     */
    function user_avatar($id = null)
    {
        $CI =& get_instance();
        $CI->load->model('user_model');

        return $CI->user_model->user_avatar($id);
    }
}

if (! function_exists('require_login'))
{
    /**
     * Require user to be logged in
     *
     * @return void
     */
    function require_login()
    {
        $CI =& get_instance();
        $CI->load->model('auth_model');

        if (! $CI->auth_model->is_logged_in()) {
            return show_loggedin();
        }
    }
}

if (! function_exists('require_guest'))
{
    /**
     * Require that the user is not logged in
     *
     * @return void
     */
    function require_guest()
    {
        $CI =& get_instance();
        $CI->load->model('auth_model');

        if ($CI->auth_model->is_logged_in()) {
            return show_guest();
        }
    }
}

if (! function_exists('has_permission'))
{
    /**
     * Check if the user has specific permission from the module
     *
     * @param string $key
     * @param string $module
     * @param int|null $id
     * @return bool
     */
    function has_permission($key, $module, $id = null)
    {
        $CI =& get_instance();
        $CI->load->model('permission_model');

        return $CI->permission_model->has_permission($key, $module, $id);
    }
}

if (! function_exists('require_permission'))
{
    /**
     * Require a user a permission
     *
     * @param string $key
     * @param string|null $module
     * @param int|null $id
     * @return void
     */
    function require_permission($key, $module = null, $id = null)
    {
        $CI =& get_instance();
        $CI->load->model('permission_model');

        $module ??= $CI->router->fetch_module();

        if ($module === null) {
            return show_404();
        }

        if (! $CI->permission_model->has_permission($key, $module, $id)) {
            return show_permission_rejected();
        }
    }
}
