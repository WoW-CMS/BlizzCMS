<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Alliance races
|--------------------------------------------------------------------------
|
| List of IDs of the races that have the alliance as the faction
|
*/
$config['alliance_races'] = [1, 3, 4, 7, 11, 22, 25, 29, 30, 32, 34, 37];

/*
|--------------------------------------------------------------------------
| Horde races
|--------------------------------------------------------------------------
|
| List of IDs of the races that have the horde as the faction
|
*/
$config['horde_races'] = [2, 5, 6, 8, 9, 10, 26, 27, 28, 31, 35, 36];

/*
|--------------------------------------------------------------------------
| Supported Expansions
|--------------------------------------------------------------------------
|
| List of supported expansions for use with functions in the CMS.
|
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
| Supported Emulators
|--------------------------------------------------------------------------
|
| List of supported emulators for use with functions in the CMS.
|
*/
$config['supported_emulators'] = [
    'azeroth'     => 'AzerothCore',
    'cmangos'     => 'CMaNGOS',
    'mangos'      => 'MaNGOS',
    'trinity'     => 'TrinityCore',
    'trinity_sha' => 'TrinityCore (SHA Hash)'
];

/*
|--------------------------------------------------------------------------
| Emulator URN
|--------------------------------------------------------------------------
|
| List of URNs related to emulators supported in the CMS.
|
*/
$config['emulator_urn'] = [
    'azeroth'     => 'AC',
    'cmangos'     => 'MaNGOS',
    'mangos'      => 'MaNGOS',
    'trinity'     => 'TC',
    'trinity_sha' => 'TC'
];
