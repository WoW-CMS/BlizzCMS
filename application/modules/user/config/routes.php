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

$route['user']['get'] = 'user/index';
$route['user/settings']['get'] = 'user/settings';
$route['user/settings/email']['post'] = 'user/change_email';
$route['user/settings/password']['post'] = 'user/change_password';
$route['user/settings/avatar']['post'] = 'user/change_avatar';
$route['user/settings/nickname']['post'] = 'user/change_nickname';