<?php
/**
 * @author Michel Roca
 * @author WoW-CMS
 * @copyright Copyright (c) 2013 - 2015, Michel Roca (https://github.com/mRoca)
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('modules_list'))
{
    /**
     * Get the list of modules in the directory
     *
     * @param bool $withLocation
     * @return array
     */
    function modules_list($withLocation = true)
    {
        $modules = [];

        foreach (MX_Modules::$locations as $location => $offset) {
            $files = directory_map($location, 1);

            if (! is_array($files)) {
                continue;
            }

            foreach ($files as $file) {
                if (! is_dir($location . $file)) {
                    continue;
                }

                $name      = trim(str_replace('/', '', stripslashes($file)));
                $modules[] = $withLocation ? [$location, $name] : $name;
            }
        }

        return $modules;
    }
}

if (! function_exists('is_module_installed'))
{
    /**
     * Check if the module is actively installed
     *
     * @param string $name
     * @param bool $showError
     * @return mixed
     */
    function is_module_installed($name, $showError = false)
    {
        $CI =& get_instance();
        $CI->load->model('module_model');

        $result = $CI->module_model->exists($name);

        if (! $result && $showError) {
            show_404();
        }

        return $result;
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

        foreach ($segments as $segment) {
            if ($segment !== '.') {
                $test = array_pop($parts);

                if (is_null($test)) {
                    $parts[] = $segment;
                } elseif ($segment === '..') {
                    if ($test === '..') {
                        $parts[] = $test;
                    }

                    if ($test === '..' || $test === '') {
                        $parts[] = $segment;
                    }
                } else {
                    $parts[] = $test;
                    $parts[] = $segment;
                }
            }
        }

        return implode('/', $parts);
    }
}
