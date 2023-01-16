<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Alliance races
|--------------------------------------------------------------------------
|
| Array of race ids belonging to the alliance faction.
|
*/
$config['alliance_races'] = [1, 3, 4, 7, 11, 22, 25, 29, 30, 32, 34, 37, 52];

/*
|--------------------------------------------------------------------------
| Horde races
|--------------------------------------------------------------------------
|
| Array of race ids belonging to the horde faction.
|
*/
$config['horde_races'] = [2, 5, 6, 8, 9, 10, 26, 27, 28, 31, 35, 36, 70];

/*
|--------------------------------------------------------------------------
| Expansions
|--------------------------------------------------------------------------
|
| Array of expansion ids associated with its data.
|
*/
$config['expansions'] = [
    0 => [
        'name'      => 'Vanilla Classic',
        'max_money' => 2_147_483_647 // 214,748g 36s 47c
    ],
    1 => [
        'name'      => 'The Burning Crusade',
        'max_money' => 2_147_483_647
    ],
    2 => [
        'name'      => 'Wrath of the Lich King',
        'max_money' => 2_147_483_647
    ],
    3 => [
        'name'      => 'Cataclysm',
        'max_money' => 9_999_999_999 // 999,999g 99s 99c
    ],
    4 => [
        'name'      => 'Mist of Pandaria',
        'max_money' => 9_999_999_999
    ],
    5 => [
        'name'      => 'Warlords of Draenor',
        'max_money' => 9_999_999_999
    ],
    6 => [
        'name'      => 'Legion',
        'max_money' => 99_999_999_999 // 9,999,999g 99s 99c
    ],
    7 => [
        'name'      => 'Battle for Azeroth',
        'max_money' => 99_999_999_999
    ],
    8 => [
        'name'      => 'Shadowlands',
        'max_money' => 99_999_999_999
    ],
    9 => [
        'name'      => 'DragonFlight',
        'max_money' => 99_999_999_999
    ]
];

/*
|--------------------------------------------------------------------------
| Emulators
|--------------------------------------------------------------------------
|
| Array of emulator keys associated with its data.
|
*/
$config['emulators'] = [
    'azeroth'     => [
        'name' => 'AzerothCore',
        'urn'  => 'AC'
    ],
    'cmangos'     => [
        'name' => 'CMaNGOS',
        'urn'  => 'MaNGOS'
    ],
    'mangos'     => [
        'name' => 'MaNGOS',
        'urn'  => 'MaNGOS'
    ],
    'trinity'     => [
        'name' => 'TrinityCore',
        'urn'  => 'TC'
    ],
    'trinity_sha' => [
        'name' => 'TrinityCore (SHA Hash)',
        'urn'  => 'TC'
    ]
];
