<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Discord URL
|--------------------------------------------------------------------------
|
| Default URL for Discord invitations.
|
*/
$config['discordUrl'] = 'https://discord.gg/';

/*
|--------------------------------------------------------------------------
| Discord CDN
|--------------------------------------------------------------------------
|
| CDN used by Discord to take the group image.
|
*/
$config['discordCdn'] = 'https://cdn.discordapp.com/icons/';

/*
|--------------------------------------------------------------------------
| Discord Widget URL
|--------------------------------------------------------------------------
|
| Default Widget URL.
|
*/
$config['discordWidget'] = 'https://discordapp.com/widget?id=';

/*
|--------------------------------------------------------------------------
| Discord Theme
|--------------------------------------------------------------------------
|
| Default theme provided by Discord.
|
*/
$config['discordtheme'] = 'dark';

/*
|--------------------------------------------------------------------------
| Discord Extras
|--------------------------------------------------------------------------
|
| Alternative parameters for the widget.
|
*/
$config['discordextras'] = 'allowtransparency="true" frameborder="0"';

/*
|--------------------------------------------------------------------------
| Discord Size Adjustments
|--------------------------------------------------------------------------
|
| Size of the "Classic" discord widget used in the CMS.
|
*/
$config['discord_width_classic'] = '300';
$config['discord_height_classic'] = '300';

/*
|--------------------------------------------------------------------------
| Discord (Experimental) Size Adjustments
|--------------------------------------------------------------------------
|
| Size of the "Experimental" discord widget used in the CMS.
|
*/
$config['discord_width_experimental'] = '70';
$config['discord_height_experimental'] = '70';