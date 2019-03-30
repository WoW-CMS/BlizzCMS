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
|	https://codeigniter.com/user_guide/general/routing.html
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
$lang = '^(en|es|bl|fr|de|ru)';


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
 * Website ROUTES
 *
*/

$route[$lang.'$'] = $route['default_controller'];
//user
$route[$lang.'/login'] = 'user/login';
$route[$lang.'/panel'] = 'user/panel';
$route[$lang.'/register'] = 'user/register';
$route[$lang.'/newacc'] = 'user/newaccount';
$route[$lang.'/settings'] = 'user/settings';
$route[$lang.'/recovery'] = 'user/recovery';
$route[$lang.'/changemail'] = 'user/newemail';
$route[$lang.'/changepass'] = 'user/newpass';
$route[$lang.'/classicverify'] = 'user/verify1';
$route[$lang.'/bnetverify'] = 'user/verify2';
$route[$lang.'/forgotpassword'] = 'user/forgotpassword';
$route[$lang.'/logout'] = 'user/logout';
$route[$lang.'/activate/(:any)'] = 'user/activate/$2';
// Vote
$route[$lang.'/vote'] = 'vote/index';
$route[$lang.'/vote/votenow/(:num)'] = 'vote/votenow/$2';
// DONATE
$route[$lang.'/donate'] = 'donate/index';
// Changelog
$route[$lang.'/changelogs'] = 'changelogs/index';
// Bugtracker
$route[$lang.'/bugtracker'] = 'bugtracker/index';
//forum
$route[$lang.'/forum/category/(:num)'] = 'forum/category/$2';
$route[$lang.'/forum/topic/(:num)'] = 'forum/topic/$2';
$route[$lang.'/forum/newTopic/(:num)'] = 'forum/newTopic/$2';
$route[$lang.'/forum'] = 'forum/index';
//news
$route[$lang.'/news/(:num)'] = 'news/article/$2';
$route[$lang.'/news'] = 'news/index';
//store
$route[$lang.'/store'] = 'store/index';
$route[$lang.'/store/(:num)'] = 'store/index/$2';
$route[$lang.'/cart/(:num)'] = 'store/cart/$2';
//pages
$route[$lang.'/page/(:any)'] = 'page/index/$2/';
//pvp
$route[$lang.'/faq'] = 'faq/index';
//faq
$route[$lang.'/pvp'] = 'pvp/index';

/*
 * Admin ROUTES
 *
*/

// General
$route[$lang.'/admin'] = 'admin/index';
$route[$lang.'/admin/settings'] = 'admin/settings';
$route[$lang.'/admin/modules'] = 'admin/managemodules';
$route[$lang.'/admin/slides'] = 'admin/manageslides';
$route[$lang.'/admin/realms'] = 'admin/managerealms';

// Manage Accounts
$route[$lang.'/admin/accounts'] = 'admin/accounts';
$route[$lang.'/admin/manageaccount/(:num)'] = 'admin/manageaccount/$2';

// Manage character
$route[$lang.'/admin/characters'] = 'admin/characters';
$route[$lang.'/admin/managecharacter/(:num)/(:num)'] = 'admin/managecharacter/$1/$2';

// News
$route[$lang.'/admin/news'] = 'admin/managenews';
$route[$lang.'/admin/editnews/(:num)'] = 'admin/editnews/$2';

// Changelog
$route[$lang.'/admin/changelogs'] = 'admin/managechangelogs';
$route[$lang.'/admin/editchangelogs/(:num)'] = 'admin/editchangelogs/$2';

// Pages
$route[$lang.'/admin/pages'] = 'admin/managepages';
$route[$lang.'/admin/editpages/(:num)'] = 'admin/editpages/$2';

// FAQ
$route[$lang.'/admin/donate'] = 'admin/donate';

// FAQ
$route[$lang.'/admin/faq'] = 'admin/managefaq';
$route[$lang.'/admin/editfaq/(:num)'] = 'admin/editfaq/$2';

// Topsites
$route[$lang.'/admin/topsites'] = 'admin/managetopsites';
$route[$lang.'/admin/edittopsite/(:num)'] = 'admin/edittopsite/$2';

// Forum
$route[$lang.'/admin/forums'] = 'admin/manageforums';
$route[$lang.'/admin/editforum/(:num)'] = 'admin/editforum/$2';
$route[$lang.'/admin/categories'] = 'admin/managecategories';

// Store
$route[$lang.'/admin/groups'] = 'admin/managegroups';
$route[$lang.'/admin/editgroups/(:num)'] = 'admin/editgroups/$2';
$route[$lang.'/admin/items'] = 'admin/manageitems';
$route[$lang.'/admin/edititems/(:num)'] = 'admin/edititems/$2';
