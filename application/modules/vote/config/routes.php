<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$route['vote']['get'] = 'vote/index';
$route['vote/site/(:num)']['get'] = 'vote/site/$1';

$route['vote/admin']['get'] = 'admin/index';
$route['vote/admin/create'] = 'admin/create';
$route['vote/admin/edit/(:num)'] = 'admin/edit/$1';
$route['vote/admin/delete/(:num)']['get'] = 'admin/delete/$1';