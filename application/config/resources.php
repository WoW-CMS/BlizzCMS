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

/*
|--------------------------------------------------------------------------
| Emulator URN
|--------------------------------------------------------------------------
| WARNING!
| The following variables are directly related to realms.
| only edit if you know what you're doing!
|
| 'emulator_urn' = list of URNs
*/
$config['emulator_urn'] = [
    'azeroth'     => 'AC',
    'cmangos'     => 'MaNGOS',
    'mangos'      => 'MaNGOS',
    'old_trinity' => 'TC',
    'trinity'     => 'TC'
];