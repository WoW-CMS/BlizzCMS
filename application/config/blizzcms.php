<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Website Name
 *
 * Write the name of your website this will appear by default.
 *
*/
$config['website_name'] = '';

/**
 *
 * Timezone
 *
 * http://php.net/manual/en/timezones.php
 *
*/
$config['timezone'] = 'GMT';

/**
 *
 * Maintenance Mode
 *
 * 1 = Enable | 0 = Disable
 *
*/
$config['maintenance_mode'] = '0';

/**
 *
 * Invitation Discord
 *
 * Write the invitation of your discord channel.
 *
*/
$config['discord_invitation'] = '';

/**
 *
 * Realmlist
 *
 * Write the realmlist used on your server to publish it on the website.
 *
*/
$config['realmlist'] = '';

/**
 * Emulator Supported
 * 
 * true = Legacy Emulator (https://github.com/The-Cataclysm-Preservation-Project/TrinityCore)
 * false = Disabled this feature (BlizzCMS - Old)
 * 
 */

 $config['emulator_legacy'] = false;

/**
 *
 * Expansion Supported
 *
 * Select the expansion that your website will use among these options:
 *
 * 1 = Vanilla
 * 2 = The Burning Crusade
 * 3 = Wrath of the Lich King
 * 4 = Cataclysm
 * 5 = Mist of Pandaria
 * 6 = Warlords of Draenor
 * 7 = Legion
 * 8 = Battle for Azeroth
 *
*/
$config['expansion'] = '';

/**
 *
 * Theme Name
 *
 * Write the name of your theme
 * The name is the same as the main folder
 * The css must also have the same name
 * Default: default
 *
*/
$config['theme_name'] = 'default';

/**
 *
 * Social Links
 *
 * Write the links for redirect to your social networks.
 *
*/
$config['social_facebook'] = '';
$config['social_twitter'] = '';
$config['social_youtube'] = '';

/**
 *
 * Migrate Status
 *
 * Warning: Don't change this configuration.
 *
*/
$config['migrate_status'] = '1';


