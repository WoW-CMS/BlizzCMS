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

$route['forum']['get'] = 'forum/index';
$route['forum/view/(:num)']['get'] = 'forum/forum/$1';
$route['forum/view/(:num)/create'] = 'forum/create_topic/$1';
$route['forum/topic/(:num)'] = 'forum/topic/$1';
$route['forum/topic/(:num)/edit'] = 'forum/edit_topic/$1';
$route['forum/post']['post'] = 'forum/create_post';
$route['forum/post/delete/(:num)']['get'] = 'forum/delete_post/$1';

$route['forum/admin']['get'] = 'admin/index';
$route['forum/admin/create'] = 'admin/create';
$route['forum/admin/edit/(:num)'] = 'admin/edit/$1';
$route['forum/admin/delete/(:num)']['get'] = 'admin/delete/$1';
$route['forum/admin/(:num)']['get'] = 'admin/forum/$1';

$route['forum/mod'] = 'moderator/index';
$route['forum/mod/queue'] = 'moderator/queue';
$route['forum/mod/reports'] = 'moderator/reports';
$route['forum/mod/logs'] = 'moderator/logs';
$route['forum/mod/bannings'] = 'moderator/bannings';
$route['forum/mod/warnings'] = 'moderator/warnings';