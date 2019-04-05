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
$route['404_override'] = 'general/error404';
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
$route[$lang.'/bugtracker/report/(:num)'] = 'bugtracker/report/$2';
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
$route[$lang.'/admin/settings/database'] = 'admin/databasesettings';
$route[$lang.'/admin/settings/optional'] = 'admin/optionalsettings';
$route[$lang.'/admin/modules'] = 'admin/managemodules';
$route[$lang.'/admin/slides'] = 'admin/manageslides';
$route[$lang.'/admin/slides/create'] = 'admin/createslide';
$route[$lang.'/admin/realms'] = 'admin/managerealms';
$route[$lang.'/admin/realms/create'] = 'admin/createrealm';

// Manage Accounts
$route[$lang.'/admin/accounts'] = 'admin/accounts';
$route[$lang.'/admin/manageaccount/(:num)'] = 'admin/manageaccount/$2';

// Manage character
$route[$lang.'/admin/characters'] = 'admin/characters';
$route[$lang.'/admin/managecharacter/(:num)/(:num)'] = 'admin/managecharacter/$2/$3';

// News
$route[$lang.'/admin/news'] = 'admin/managenews';
$route[$lang.'/admin/news/create'] = 'admin/createnews';
$route[$lang.'/admin/news/edit/(:num)'] = 'admin/editnews/$2';

// Changelog
$route[$lang.'/admin/changelogs'] = 'admin/managechangelogs';
$route[$lang.'/admin/changelogs/create'] = 'admin/createchangelog';
$route[$lang.'/admin/changelogs/edit/(:num)'] = 'admin/editchangelog/$2';

// Pages
$route[$lang.'/admin/pages'] = 'admin/managepages';
$route[$lang.'/admin/pages/create'] = 'admin/createpage';
$route[$lang.'/admin/pages/edit/(:num)'] = 'admin/editpage/$2';

// Donate
$route[$lang.'/admin/donate'] = 'admin/donate';
$route[$lang.'/admin/donatelist'] = 'admin/getDonateList';
$route[$lang.'/admin/editdonation'] = 'admin/updateDonation';
$route[$lang.'/admin/adddonation'] = 'admin/insertDonation';
$route[$lang.'/admin/deletedonation'] = 'admin/deleteDonation';

// FAQ
$route[$lang.'/admin/faq'] = 'admin/managefaqs';
$route[$lang.'/admin/faq/create'] = 'admin/createfaq';
$route[$lang.'/admin/faq/edit/(:num)'] = 'admin/editfaq/$2';

// Topsites
$route[$lang.'/admin/topsites'] = 'admin/managetopsites';
$route[$lang.'/admin/topsites/create'] = 'admin/createtopsite';
$route[$lang.'/admin/topsites/edit/(:num)'] = 'admin/edittopsite/$2';

// Forum
$route[$lang.'/admin/forums'] = 'admin/manageforums';
$route[$lang.'/admin/forums/create'] = 'admin/createforum';
$route[$lang.'/admin/forums/edit/(:num)'] = 'admin/editforum/$2';
$route[$lang.'/admin/categories'] = 'admin/managecategories';
$route[$lang.'/admin/categorylist'] = 'admin/getCategoryList';
$route[$lang.'/admin/editcategory'] = 'admin/updateCategory';
$route[$lang.'/admin/addcategory'] = 'admin/insertCategory';
$route[$lang.'/admin/deletecategory'] = 'admin/deleteCategory';

// Store
$route[$lang.'/admin/groups'] = 'admin/managegroups';
$route[$lang.'/admin/groups/create'] = 'admin/creategroup';
$route[$lang.'/admin/groups/edit/(:num)'] = 'admin/editgroup/$2';
$route[$lang.'/admin/items'] = 'admin/manageitems';
$route[$lang.'/admin/items/create'] = 'admin/createitem';
$route[$lang.'/admin/items/edit/(:num)'] = 'admin/edititem/$2';
