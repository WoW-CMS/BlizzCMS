<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Supported Languages
  |--------------------------------------------------------------------------
  |
  | Contains all languages your site will store data in. Other languages can
  | still be displayed via language files, thats totally different.
  |
  | Check for HTML equivilents for characters such as � with the URL below:
  |    http://htmlhelp.com/reference/html40/entities/latin1.html
  |
  |
  |    array('en'=> 'English', 'fr'=> 'French', 'de'=> 'German')
  |
 */
$config['supported_languages'] = array(
  'es' => array(
	'name' => 'Español',
	'folder' => 'spanish',
	'direction' => 'ltr',
	'codes' => array('es', 'spanish', 'es_ES'),
  ),
  'en' => array(
	'name' => 'English',
	'folder' => 'english',
	'direction' => 'ltr',
	'codes' => array('en', 'english', 'en_US'),
  ),
  'fr' => array(
	'name' => 'French',
	'folder' => 'french',
	'direction' => 'ltr',
	'codes' => array('fr', 'French', 'fr_FR'),
  ),
  'de' => array(
	'name' => 'Deutsch',
	'folder' => 'german',
	'direction' => 'ltr',
	'codes' => array('de', 'german', 'de_DE'),
 )
);

/*
  |--------------------------------------------------------------------------
  | Default Language
  |--------------------------------------------------------------------------
  |
  | If no language is specified, which one to use? Must be in the array above.
  |
  |    en
  |
 */
$config['default_language'] = 'en';

/*
  |--------------------------------------------------------------------------
  | Detect Browser Language
  |--------------------------------------------------------------------------
  |
  | If enabled detecting browser language and disable default language
  |
  |    FALSE
  |
 */
$config['detect_language'] = FALSE;

/*
  |--------------------------------------------------------------------------
  | Default URI
  |--------------------------------------------------------------------------
  |
  | Where to redirect if no language in URI.
  | Example if default_uri 'welcome' => /en/weclome
  |
  |    welcome
  |
 */
$config['default_uri'] = '/';

/*
  |--------------------------------------------------------------------------
  | Special URIs
  |--------------------------------------------------------------------------
  |
  | This URIs is not be localized
  |
  |    array('admin', 'auth', 'api')
  |
 */
$config['special_uris'] = array(

);
