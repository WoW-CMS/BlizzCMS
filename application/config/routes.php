<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

$route['login'] = 'auth/login';
$route['logout']['get'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['confirm-register/(:any)']['get'] = 'auth/confirm_register/$1';
$route['forgot-password'] = 'auth/forgot_password';
$route['reset-password'] = 'auth/reset_password';

$route['lang/(:any)']['get'] = 'home/lang/$1';

/**
 * Install Routes
*/
$route['install']['get'] = 'install/index';
$route['install/database'] = 'install/database_step';
$route['install/settings'] = 'install/settings_step';
$route['install/last'] = 'install/last_step';

/**
 * News Routes
*/
$route['news']['get'] = 'news/index';
$route['news/(:num)/(:any)']['get'] = 'news/view/$1/$2';
$route['news/comment/add/(:num)']['post'] = 'news/add_comment/$1';
$route['news/comment/edit/(:num)'] = 'news/edit_comment/$1';
$route['news/comment/delete/(:num)']['get'] = 'news/delete_comment/$1';

/**
 * Page Routes
*/
$route['page/(:any)']['get'] = 'page/index/$1';
