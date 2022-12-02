<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = [
    'class' => 'Base_hook',
    'function' => 'installation',
    'filename' => 'Base_hook.php',
    'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
    'class' => 'Base_hook',
    'function' => 'load_settings',
    'filename' => 'Base_hook.php',
    'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
    'class' => 'Base_hook',
    'function' => 'remember',
    'filename' => 'Base_hook.php',
    'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
    'class' => 'Base_hook',
    'function' => 'logout_banned_ip',
    'filename' => 'Base_hook.php',
    'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
    'class' => 'Tasks_hook',
    'function' => 'auto_purge_logs',
    'filename' => 'Tasks_hook.php',
    'filepath' => 'hooks'
];

$hook['display_override'][] = [
    'class' => 'Compress_hook',
    'function' => 'initialize',
    'filename' => 'Compress_hook.php',
    'filepath' => 'hooks'
];
