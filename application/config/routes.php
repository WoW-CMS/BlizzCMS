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
$route[$lang.'/dbmigrate'] = 'home/migrateNow';
$route[$lang.'/maintenance'] = 'general/maintenance';

// User
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
// Donate
$route[$lang.'/donate'] = 'donate/index';
// Changelog
$route[$lang.'/changelogs'] = 'changelogs/index';
// Bugtracker
$route[$lang.'/bugtracker'] = 'bugtracker/index';
$route[$lang.'/bugtracker/(:num)'] = 'bugtracker/index/$2';
$route[$lang.'/bugtracker/new'] = 'bugtracker/newreport';
$route[$lang.'/bugtracker/create'] = 'bugtracker/create';
$route[$lang.'/bugtracker/report/(:num)'] = 'bugtracker/report/$2';
// Forum
$route[$lang.'/forum'] = 'forum/index';
$route[$lang.'/forum/category/(:num)'] = 'forum/category/$2';
$route[$lang.'/forum/topic/(:num)'] = 'forum/topic/$2';
$route[$lang.'/forum/topic/new/(:num)'] = 'forum/newtopic/$2';
$route[$lang.'/forum/topic/create'] = 'forum/addtopic';
$route[$lang.'/forum/topic/reply'] = 'forum/reply';
$route[$lang.'/forum/topic/reply/delete'] = 'forum/deletereply';
// News
$route[$lang.'/news/(:num)'] = 'news/article/$2';
$route[$lang.'/news'] = 'news/index';
$route[$lang.'/news/reply'] = 'news/reply';
$route[$lang.'/news/reply/delete'] = 'news/deletereply';
// Store
$route[$lang.'/store'] = 'store/index';
$route[$lang.'/store/(:num)'] = 'store/index/$2';
$route[$lang.'/cart/(:num)'] = 'store/cart/$2';
// Pages
$route[$lang.'/page/(:any)'] = 'page/index/$2/';
// PvP
$route[$lang.'/pvp'] = 'pvp/index';

/*
 * Admin ROUTES
 *
*/

// General
$route[$lang.'/admin'] = 'admin/index';
$route[$lang.'/admin/settings'] = 'admin/settings';
$route[$lang.'/admin/settings/update'] = 'admin/updatesettings';
$route[$lang.'/admin/settings/module'] = 'admin/modulesettings';
$route[$lang.'/admin/settings/module/updonate'] = 'admin/updatedonatesettings';
$route[$lang.'/admin/settings/module/upbugtracker'] = 'admin/updatebugtrackersettings';
$route[$lang.'/admin/settings/optional'] = 'admin/optionalsettings';
$route[$lang.'/admin/settings/optional/update'] = 'admin/updateoptionalsettings';
$route[$lang.'/admin/modules'] = 'admin/managemodules';
$route[$lang.'/admin/modules/enable'] = 'admin/enablemodule';
$route[$lang.'/admin/modules/disable'] = 'admin/disablemodule';

// Manage Accounts
$route[$lang.'/admin/accounts'] = 'admin/accounts';
$route[$lang.'/admin/manageaccount/(:num)'] = 'admin/manageaccount/$2';

// Manage character
$route[$lang.'/admin/characters'] = 'admin/characters';
$route[$lang.'/admin/managecharacter/(:num)/(:num)'] = 'admin/managecharacter/$2/$3';

// Menu
$route[$lang.'/admin/menu'] = 'admin/managemenu';
$route[$lang.'/admin/menu/create'] = 'admin/createmenu';
$route[$lang.'/admin/menu/edit/(:num)'] = 'admin/editmenu/$2';
$route[$lang.'/admin/menu/add'] = 'admin/addmenu';
$route[$lang.'/admin/menu/update'] = 'admin/updatemenu';
$route[$lang.'/admin/menu/delete'] = 'admin/deletemenu';

// Realms
$route[$lang.'/admin/realms'] = 'admin/managerealms';
$route[$lang.'/admin/realms/create'] = 'admin/createrealm';
$route[$lang.'/admin/realms/edit/(:num)'] = 'admin/editrealm/$2';
$route[$lang.'/admin/realms/add'] = 'admin/addrealm';
$route[$lang.'/admin/realms/update'] = 'admin/updaterealm';
$route[$lang.'/admin/realms/delete'] = 'admin/deleterealm';

// Slides
$route[$lang.'/admin/slides'] = 'admin/manageslides';
$route[$lang.'/admin/slides/create'] = 'admin/createslide';
$route[$lang.'/admin/slides/edit/(:num)'] = 'admin/editslide/$2';
$route[$lang.'/admin/slides/add'] = 'admin/addslide';
$route[$lang.'/admin/slides/update'] = 'admin/updateslide';
$route[$lang.'/admin/slides/delete'] = 'admin/deleteslide';

// News
$route[$lang.'/admin/news'] = 'admin/managenews';
$route[$lang.'/admin/news/create'] = 'admin/createnews';
$route[$lang.'/admin/news/edit/(:num)'] = 'admin/editnews/$2';
$route[$lang.'/admin/news/delete'] = 'admin/deletenews';

// Changelog
$route[$lang.'/admin/changelogs'] = 'admin/managechangelogs';
$route[$lang.'/admin/changelogs/create'] = 'admin/createchangelog';
$route[$lang.'/admin/changelogs/edit/(:num)'] = 'admin/editchangelog/$2';
$route[$lang.'/admin/changelogs/add'] = 'admin/addchangelog';
$route[$lang.'/admin/changelogs/update'] = 'admin/updatechangelog';
$route[$lang.'/admin/changelogs/delete'] = 'admin/deletechangelog';

// Pages
$route[$lang.'/admin/pages'] = 'admin/managepages';
$route[$lang.'/admin/pages/create'] = 'admin/createpage';
$route[$lang.'/admin/pages/edit/(:num)'] = 'admin/editpage/$2';
$route[$lang.'/admin/pages/add'] = 'admin/addpage';
$route[$lang.'/admin/pages/update'] = 'admin/updatepage';
$route[$lang.'/admin/pages/delete'] = 'admin/deletepage';

// Store
$route[$lang.'/admin/store'] = 'admin/managestore';
$route[$lang.'/admin/store/items'] = 'admin/managestoreitems';
$route[$lang.'/admin/store/category/create'] = 'admin/createstorecategory';
$route[$lang.'/admin/store/category/edit/(:num)'] = 'admin/editstorecategory/$2';
$route[$lang.'/admin/store/category/add'] = 'admin/addstorecategory';
$route[$lang.'/admin/store/category/update'] = 'admin/updatestorecategory';
$route[$lang.'/admin/store/category/delete'] = 'admin/deletestorecategory';
$route[$lang.'/admin/store/item/create'] = 'admin/createstoreitem';
$route[$lang.'/admin/store/item/edit/(:num)'] = 'admin/editstoreitem/$2';
$route[$lang.'/admin/store/item/add'] = 'admin/addstoreitem';
$route[$lang.'/admin/store/item/update'] = 'admin/updatestoreitem';
$route[$lang.'/admin/store/item/delete'] = 'admin/deletestoreitem';

// Donate
$route[$lang.'/admin/donate'] = 'admin/donate';
$route[$lang.'/admin/donatelist'] = 'admin/getDonateList';
$route[$lang.'/admin/editdonation'] = 'admin/updateDonation';
$route[$lang.'/admin/adddonation'] = 'admin/insertDonation';
$route[$lang.'/admin/deletedonation'] = 'admin/deleteDonation';

// Topsites
$route[$lang.'/admin/topsites'] = 'admin/managetopsites';
$route[$lang.'/admin/topsites/create'] = 'admin/createtopsite';
$route[$lang.'/admin/topsites/edit/(:num)'] = 'admin/edittopsite/$2';
$route[$lang.'/admin/topsites/add'] = 'admin/addtopsite';
$route[$lang.'/admin/topsites/update'] = 'admin/updatetopsite';
$route[$lang.'/admin/topsites/delete'] = 'admin/deletetopsite';

// Forum
$route[$lang.'/admin/forum'] = 'admin/manageforum';
$route[$lang.'/admin/forum/elements'] = 'admin/manageforumelements';
$route[$lang.'/admin/forum/create'] = 'admin/createforum';
$route[$lang.'/admin/forum/edit/(:num)'] = 'admin/editforum/$2';
$route[$lang.'/admin/forum/add'] = 'admin/addforum';
$route[$lang.'/admin/forum/update'] = 'admin/updateforum';
$route[$lang.'/admin/forum/delete'] = 'admin/deleteforum';
$route[$lang.'/admin/forum/category/create'] = 'admin/createforumcategory';
$route[$lang.'/admin/forum/category/edit/(:num)'] = 'admin/editforumcategory/$2';
$route[$lang.'/admin/forum/category/add'] = 'admin/addforumcategory';
$route[$lang.'/admin/forum/category/update'] = 'admin/updateforumcategory';
$route[$lang.'/admin/forum/category/delete'] = 'admin/deleteforumcategory';
