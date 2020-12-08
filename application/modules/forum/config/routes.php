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

$route['forum'] = 'forum/index';
$route['forum/category/(:num)'] = 'forum/category/$1';
$route['forum/topic/(:num)'] = 'forum/topic/$1';
$route['forum/topic/new/(:num)'] = 'forum/newtopic/$1';
$route['forum/topic/create'] = 'forum/addtopic';
$route['forum/topic/reply'] = 'forum/reply';
$route['forum/topic/reply/delete'] = 'forum/deletereply';