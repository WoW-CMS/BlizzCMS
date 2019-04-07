<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');

if(!function_exists('cms_helper'))
{
    function cms_helper()
    {
        $CI =& get_instance();

        if(!$CI->m_modules->getInstallationStatus())
        {
            if(file_exists("install/index.php")):
                header("Location: install");
                die();
            endif;
        }
    }
}
