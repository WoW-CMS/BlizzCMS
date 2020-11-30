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

/**
 *
 * Recaptcha (V2)
 *
 * Write the necessary keys to enable recaptcha in the register
 * Use the following page to create the necessary keys.
 * https://www.google.com/recaptcha/admin#list
 *
*/
$config['recaptcha_sitekey'] = '';

/**
 *
 * Administrator Access Level
 *
 * Minimum gmlevel to access to admin sections.
 *
*/
$config['admin_access_level'] = '3';

/**
 *
 * Moderator Access Level
 *
 * Minimum gmlevel to access to mod sections.
 *
*/
$config['mod_access_level'] = '2';
