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

$route['admin'] = 'admin/index';

$route['admin/system']['get'] = 'system/index';
$route['admin/system/cache']['get'] = 'system/cache';
$route['admin/system/sessions']['get'] = 'system/sessions';
$route['admin/system/general'] = 'system/general';
$route['admin/system/captcha'] = 'system/captcha';
$route['admin/system/mail'] = 'system/mail';
$route['admin/system/logs']['get'] = 'system/logs';

$route['admin/mods']['get'] = 'mods/index';
$route['admin/mods/install/(:any)']['get'] = 'mods/install/$1';
$route['admin/mods/uninstall/(:any)']['get'] = 'mods/uninstall/$1';
$route['admin/mods/delete/(:any)']['get'] = 'mods/delete/$1';
$route['admin/mods/update/(:any)']['get'] = 'mods/update/$1';
$route['admin/mods/upload'] = 'mods/upload';

$route['admin/users']['get'] = 'users/index';
$route['admin/users/view/(:num)']['get'] = 'users/view/$1';
$route['admin/users/logs/(:num)']['get'] = 'users/logs/$1';
$route['admin/users/update']['post'] = 'users/update';
$route['admin/users/banned']['get'] = 'users/users_banned';
$route['admin/users/banned/(:num)']['get'] = 'users/view_ban/$1';
$route['admin/users/ban'] = 'users/user_ban';
$route['admin/users/unban/(:num)']['get'] = 'users/user_unban/$1';

$route['admin/menu']['get'] = 'menu/index';
$route['admin/menu/create'] = 'menu/create';
$route['admin/menu/edit/(:num)'] = 'menu/edit/$1';
$route['admin/menu/delete/(:num)']['get'] = 'menu/delete/$1';

$route['admin/realms']['get'] = 'realms/index';
$route['admin/realms/create'] = 'realms/create';
$route['admin/realms/edit/(:num)'] = 'realms/edit/$1';
$route['admin/realms/delete/(:num)']['get'] = 'realms/delete/$1';
$route['admin/realms/soap/(:num)']['get'] = 'realms/check_soap/$1';

$route['admin/slides']['get'] = 'slides/index';
$route['admin/slides/create'] = 'slides/create';
$route['admin/slides/edit/(:num)'] = 'slides/edit/$1';
$route['admin/slides/delete/(:num)']['get'] = 'slides/delete/$1';

$route['admin/news']['get'] = 'news/index';
$route['admin/news/create'] = 'news/create';
$route['admin/news/edit/(:num)'] = 'news/edit/$1';
$route['admin/news/delete/(:num)']['get'] = 'news/delete/$1';

$route['admin/pages']['get'] = 'pages/index';
$route['admin/pages/create'] = 'pages/create';
$route['admin/pages/edit/(:num)'] = 'pages/edit/$1';
$route['admin/pages/delete/(:num)']['get'] = 'pages/delete/$1';