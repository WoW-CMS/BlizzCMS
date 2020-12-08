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

$route['panel']['get'] = 'user/index';
$route['settings']['get'] = 'user/settings';
$route['settings/email']['post'] = 'user/change_email';
$route['settings/password']['post'] = 'user/change_password';
$route['settings/avatar']['post'] = 'user/change_avatar';
$route['settings/nickname']['post'] = 'user/change_nickname';