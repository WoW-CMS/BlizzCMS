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

$route['store'] = 'store/index';
$route['store/(:any)'] = 'store/category/$1';
$route['cart'] = 'store/cart';
$route['cart/checkout'] = 'store/checkout';
$route['cart/add'] = 'store/addtocart';
$route['cart/delete'] = 'store/removeitem';
$route['cart/updatequantity'] = 'store/updatequantity';
$route['cart/updatecharacter'] = 'store/updatecharacter';