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
 * SMTP
 *
 * Write the necessary information for use SMTP to use in recovery password
 * and account activation.
 *
*/
$config['smtp_host'] = '';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_port'] = '465';
$config['smtp_crypto'] = 'ssl';

/**
 *
 * Email Settings
 *
 * Write the necessary information to use in sending emails.
 *
*/
$config['email_settings_sender'] = '';
$config['email_settings_sender_name'] = '';

/**
 *
 * Account Activation
 *
 * Enable or Disable the option to activate accounts by email.
 *
 * TRUE  = Enable
 * FALSE = Disable
 *
*/
$config['account_activation_required'] = FALSE;

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
