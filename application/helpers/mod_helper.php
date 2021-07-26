<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @copyright  Copyright (c) 2013-2015, Michel Roca (https://github.com/mRoca)
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('get_mods_list'))
{
    /**
     * Get the modules list
     *
     * @param bool $with_location
     * @param bool $strip
     * @return array
     */
    function get_mods_list($with_location = true, $strip = false)
    {
        $modules = [];

        foreach (Modules::$locations as $location => $offset)
        {
            $files = directory_map($location, 1);

            if (is_array($files))
            {
                foreach ($files as $name)
                {
                    if (is_dir($location.$name))
                    {
                        $modules[] = $with_location ? [$location, $name] : ($strip ? stripslashes(trim($name, " /\t\n\r\0\x0B")) : $name);
                    }
                }
            }
        }

        return $modules;
    }
}

if (! function_exists('mod_exists'))
{
    /**
     * Check if a module with the given name exists
     *
     * @param string $name
     * @return bool
     */
    function mod_exists($name)
    {
        return in_array($name, get_mods_list(false, true));
    }
}

if (! function_exists('mod_located'))
{
    /**
     * Check if a module is installed
     *
     * @param string $module
     * @param bool $error
     * @return mixed
     */
    function mod_located($module, $error = false)
    {
        $CI =& get_instance();
        $CI->load->model('modules_model');

        $row = $CI->modules_model->saved($module);

        if (! $row && $error)
        {
            show_404();
        }

        return $row;
    }
}

if (! function_exists('normalize_path'))
{
    /**
     * Remove the ".." from the middle of a path string
     * 
     * @param string $path
     * @return string
     */
    function normalize_path($path)
    {
        $parts = []; // Array to build a new path from the good parts
        $path = str_replace('\\', '/', $path); // Replace backslashes with forwardslashes
        $path = preg_replace('/\/+/', '/', $path); // Combine multiple slashes into a single slash
        $segments = explode('/', $path); // Collect path segments

        foreach ($segments as $segment)
        {
            if ($segment != '.')
            {
                $test = array_pop($parts);

                if (is_null($test))
                {
                    $parts[] = $segment;
                }
                elseif ($segment == '..')
                {
                    if ($test == '..')
                    {
                        $parts[] = $test;
                    }

                    if ($test == '..' || $test == '')
                    {
                        $parts[] = $segment;
                    }
                }
                else
                {
                    $parts[] = $test;
                    $parts[] = $segment;
                }
            }
        }

        return implode('/', $parts);
    }
}