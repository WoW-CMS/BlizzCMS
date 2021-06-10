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

$route['donate']['get'] = 'donate/index';
$route['donate/paypal']['post'] = 'donate/paypal_donate';
$route['donate/paypal/check']['get'] = 'donate/paypal_check';
$route['donate/paypal/cancel']['get'] = 'donate/paypal_cancel';

$route['donate/admin']['get'] = 'admin/index';
$route['donate/admin/settings'] = 'admin/settings';
$route['donate/admin/logs']['get'] = 'admin/logs';
$route['donate/admin/logs/view/(:num)']['get'] = 'admin/view_log/$1';
$route['donate/admin/logs/create'] = 'admin/create_payment';
$route['donate/admin/logs/update/(:num)']['get'] = 'admin/update_payment/$1';