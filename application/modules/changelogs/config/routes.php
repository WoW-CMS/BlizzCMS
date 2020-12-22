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

$route['changelogs']['get'] = 'changelogs/index';

$route['changelogs/admin']['get'] = 'admin/index';
$route['changelogs/admin/create'] = 'admin/create';
$route['changelogs/admin/edit/(:num)'] = 'admin/edit/$1';
$route['changelogs/admin/delete/(:num)']['get'] = 'admin/delete/$1';