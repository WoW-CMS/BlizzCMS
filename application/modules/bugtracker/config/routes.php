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

$route['bugtracker']['get'] = 'bugtracker/index';
$route['bugtracker/create'] = 'bugtracker/create';
$route['bugtracker/edit/(:num)'] = 'bugtracker/edit/$1';
$route['bugtracker/report/(:num)']['get'] = 'bugtracker/report/$1';
$route['bugtracker/comment']['post'] = 'bugtracker/comment';
$route['bugtracker/comment/delete/(:num)']['get'] = 'bugtracker/comment_delete/$1';