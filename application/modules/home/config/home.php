<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Discord Type
 *
 * 1 = Clasic Discord | 2 = Banner Discord
 *
*/
$config['discord_type'] = '1';

/**
 *
 * Discord invitation character length
 *
 * Default: 7
 * The new invitations have 10 characters so you should change from 7 to 10 for example.
*/
$config['discord_invitation_length'] = 7;

/**
 *
 * The api de discord offers 5 types of styles.
 *
 * Options: shield | banner1 | banner2 | banner3 | banner4
 * Default: banner3
*/
$config['discord_style'] = 'banner3';
