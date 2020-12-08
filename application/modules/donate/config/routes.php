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

$route['donate']['get'] = 'donate/index';
$route['donate/check/(:any)'] = 'donate/check/$1';
$route['donate/canceled'] = 'donate/canceled';