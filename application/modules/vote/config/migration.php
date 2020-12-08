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

/*
|--------------------------------------------------------------------------
| Enable/Disable Migrations
|--------------------------------------------------------------------------
| Warning!
| Module migrations are disabled by default for security reasons.
|
*/
$config['migration_enabled'] = TRUE;

/*
|--------------------------------------------------------------------------
| Migrations version
|--------------------------------------------------------------------------
| Warning!
| This is used to set migration version that the file system should be on.
|
*/
$config['migration_version'] = 2;

/*
|--------------------------------------------------------------------------
| Migrations Path
|--------------------------------------------------------------------------
| Warning!
| Path to your module migrations folder.
| edit it only if you know what you are doing
|
*/
$config['migration_path'] = '../migrations/';