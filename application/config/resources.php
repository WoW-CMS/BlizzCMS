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
| Supported Languages
|--------------------------------------------------------------------------
| WARNING!
| The following variables are directly related to languages.
| only edit if you know what you're doing!
|
| 'supported_languages' = list of supported languages
*/
$config['supported_languages'] = [
	//'bulgarian',
	//'dutch',
	'english',
	//'french',
	//'german',
	//'norwegian',
	//'portuguese',
	//'portuguese-brazilian',
	//'russian',
	'spanish',
	//'swedish'
];

/*
|--------------------------------------------------------------------------
| Supported Expansions
|--------------------------------------------------------------------------
| WARNING!
| The following variables are directly related to realms.
| only edit if you know what you're doing!
|
| 'supported_expansions' = list of supported expansions
*/
$config['supported_expansions'] = [
	0 => 'Vanilla Classic',
	1 => 'The Burning Crusade',
	2 => 'Wrath of the Lich King',
	3 => 'Cataclysm',
	4 => 'Mist of Pandaria',
	5 => 'Warlords of Draenor',
	6 => 'Legion',
	7 => 'Battle for Azeroth',
	8 => 'Shadowlands'
];