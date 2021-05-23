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

$route['store']['get'] = 'store/index';
$route['store/category/(:any)']['get'] = 'store/category/$1';
$route['store/item/(:num)'] = 'store/item/$1';
$route['store/cart']['get'] = 'store/cart';
$route['store/cart/checkout']['get'] = 'store/checkout';
$route['store/cart/delete/(:any)']['get'] = 'store/remove_item/$1';
$route['store/cart/quantity']['post'] = 'store/update_quantity';

$route['store/admin']['get'] = 'admin/index';
$route['store/admin/create'] = 'admin/create';
$route['store/admin/edit/(:num)'] = 'admin/edit/$1';
$route['store/admin/delete/(:num)']['get'] = 'admin/delete/$1';
$route['store/admin/(:num)']['get'] = 'admin/category/$1';
$route['store/admin/(:num)/create'] = 'admin/create_item/$1';
$route['store/admin/(:num)/edit/(:num)'] = 'admin/edit_item/$1/$2';
$route['store/admin/(:num)/delete/(:num)']['get'] = 'admin/delete_item/$1/$2';
$route['store/admin/logs']['get'] = 'admin/logs';