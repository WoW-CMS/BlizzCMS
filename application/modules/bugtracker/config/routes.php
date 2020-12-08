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

$route['bugtracker']['get'] = 'bugtracker/index';
$route['bugtracker/new']['get'] = 'bugtracker/newreport';
$route['bugtracker/create']['post'] = 'bugtracker/create';
$route['bugtracker/type']['post'] = 'bugtracker/update_type';
$route['bugtracker/status']['post'] = 'bugtracker/update_status';
$route['bugtracker/priority']['post'] = 'bugtracker/update_priority';
$route['bugtracker/close']['post'] = 'bugtracker/close_report';
$route['bugtracker/report/(:num)']['get'] = 'bugtracker/report/$1';