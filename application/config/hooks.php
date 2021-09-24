<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = [
    'class' => 'Settings_hook',
    'function' => 'initialize',
    'filename' => 'Settings_hook.php',
    'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
    'class' => 'Installer_hook',
    'function' => 'initialize',
    'filename' => 'Installer_hook.php',
    'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
    'class' => 'Langs_hook',
    'function' => 'initialize',
    'filename' => 'Langs_hook.php',
    'filepath' => 'hooks'
];