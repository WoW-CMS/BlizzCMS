<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin'] = 'admin/index';
$route['admin/cms'] = 'admin/cmsmanage';
$route['admin/cms/update'] = 'admin/updatecms';
$route['admin/settings'] = 'admin/settings';
$route['admin/settings/update'] = 'admin/updatesettings';
$route['admin/settings/module'] = 'admin/modulesettings';
$route['admin/settings/module/updonate'] = 'admin/updatedonatesettings';
$route['admin/settings/module/upbugtracker'] = 'admin/updatebugtrackersettings';
$route['admin/settings/optional'] = 'admin/optionalsettings';
$route['admin/settings/optional/update'] = 'admin/updateoptionalsettings';
$route['admin/settings/seo'] = 'admin/seosettings';
$route['admin/settings/seo/update'] = 'admin/updateseosettings';
$route['admin/modules'] = 'admin/managemodules';
$route['admin/modules/enable'] = 'admin/enablemodule';
$route['admin/modules/disable'] = 'admin/disablemodule';

/*Manage Accounts*/
$route['admin/accounts'] = 'admin/accounts';
$route['admin/accounts/(:num)'] = 'admin/accounts/$1';
$route['admin/account/manage/(:num)'] = 'admin/accountmanage/$1';
$route['admin/account/dlogs/(:num)'] = 'admin/accountdonatelogs/$1';
$route['admin/account/update'] = 'admin/updateaccount';
$route['admin/account/ban'] = 'admin/banaccount';
$route['admin/account/unban'] = 'admin/unbanaccount';
$route['admin/account/grantrank'] = 'admin/grantrankaccount';
$route['admin/account/delrank'] = 'admin/delrankaccount';

/*Menu*/
$route['admin/menu'] = 'admin/managemenu';
$route['admin/menu/create'] = 'admin/createmenu';
$route['admin/menu/edit/(:num)'] = 'admin/editmenu/$1';
$route['admin/menu/add'] = 'admin/addmenu';
$route['admin/menu/update'] = 'admin/updatemenu';
$route['admin/menu/delete'] = 'admin/deletemenu';

/*Realms*/
$route['admin/realms'] = 'admin/managerealms';
$route['admin/realms/(:num)'] = 'admin/managerealms/$1';
$route['admin/realms/create'] = 'admin/createrealm';
$route['admin/realms/edit/(:num)'] = 'admin/editrealm/$1';
$route['admin/realms/add'] = 'admin/addrealm';
$route['admin/realms/update'] = 'admin/updaterealm';
$route['admin/realms/delete'] = 'admin/deleterealm';

/*Slides*/
$route['admin/slides'] = 'admin/manageslides';
$route['admin/slides/(:num)'] = 'admin/manageslides/$1';
$route['admin/slides/create'] = 'admin/createslide';
$route['admin/slides/edit/(:num)'] = 'admin/editslide/$1';
$route['admin/slides/add'] = 'admin/addslide';
$route['admin/slides/update'] = 'admin/updateslide';
$route['admin/slides/delete'] = 'admin/deleteslide';

/*News*/
$route['admin/news'] = 'admin/managenews';
$route['admin/news/(:num)'] = 'admin/managenews/$1';
$route['admin/news/create'] = 'admin/createnews';
$route['admin/news/edit/(:num)'] = 'admin/editnews/$1';
$route['admin/news/delete'] = 'admin/deletenews';

/*Changelog*/
$route['admin/changelogs'] = 'admin/managechangelogs';
$route['admin/changelogs/(:num)'] = 'admin/managechangelogs/$1';
$route['admin/changelogs/create'] = 'admin/createchangelog';
$route['admin/changelogs/edit/(:num)'] = 'admin/editchangelog/$1';
$route['admin/changelogs/add'] = 'admin/addchangelog';
$route['admin/changelogs/update'] = 'admin/updatechangelog';
$route['admin/changelogs/delete'] = 'admin/deletechangelog';

/*Pages*/
$route['admin/pages'] = 'admin/managepages';
$route['admin/pages/(:num)'] = 'admin/managepages/$1';
$route['admin/pages/create'] = 'admin/createpage';
$route['admin/pages/edit/(:num)'] = 'admin/editpage/$1';
$route['admin/pages/add'] = 'admin/addpage';
$route['admin/pages/update'] = 'admin/updatepage';
$route['admin/pages/delete'] = 'admin/deletepage';

/*Store*/
$route['admin/store'] = 'admin/managestore';
$route['admin/store/(:num)'] = 'admin/managestore/$1';
$route['admin/store/items'] = 'admin/managestoreitems';
$route['admin/store/items/(:num)'] = 'admin/managestoreitems/$1';
$route['admin/store/top'] = 'admin/managestoretop';
$route['admin/store/top/(:num)'] = 'admin/managestoretop/$1';
$route['admin/store/category/create'] = 'admin/createstorecategory';
$route['admin/store/category/edit/(:num)'] = 'admin/editstorecategory/$1';
$route['admin/store/category/add'] = 'admin/addstorecategory';
$route['admin/store/category/update'] = 'admin/updatestorecategory';
$route['admin/store/category/delete'] = 'admin/deletestorecategory';
$route['admin/store/item/create'] = 'admin/createstoreitem';
$route['admin/store/item/edit/(:num)'] = 'admin/editstoreitem/$1';
$route['admin/store/item/add'] = 'admin/addstoreitem';
$route['admin/store/item/update'] = 'admin/updatestoreitem';
$route['admin/store/item/delete'] = 'admin/deletestoreitem';
$route['admin/store/top/create'] = 'admin/createstoretop';
$route['admin/store/top/edit/(:num)'] = 'admin/editstoretop/$1';
$route['admin/store/top/add'] = 'admin/addstoretop';
$route['admin/store/top/update'] = 'admin/updatestoretop';
$route['admin/store/top/delete'] = 'admin/deletestoretop';

/*Donate*/
$route['admin/donate'] = 'admin/donate';
$route['admin/donate/create'] = 'admin/createdonateplan';
$route['admin/donate/edit/(:num)'] = 'admin/editdonateplan/$1';
$route['admin/donate/add'] = 'admin/adddonateplan';
$route['admin/donate/update'] = 'admin/updatedonateplan';
$route['admin/donate/delete'] = 'admin/deletedonateplan';

/*Topsites*/
$route['admin/topsites'] = 'admin/managetopsites';
$route['admin/topsites/(:num)'] = 'admin/managetopsites/$1';
$route['admin/topsites/create'] = 'admin/createtopsite';
$route['admin/topsites/edit/(:num)'] = 'admin/edittopsite/$1';
$route['admin/topsites/add'] = 'admin/addtopsite';
$route['admin/topsites/update'] = 'admin/updatetopsite';
$route['admin/topsites/delete'] = 'admin/deletetopsite';

/*Forum*/
$route['admin/forum'] = 'admin/manageforum';
$route['admin/forum/(:num)'] = 'admin/manageforum/$1';
$route['admin/forum/elements'] = 'admin/manageforumelements';
$route['admin/forum/elements/(:num)'] = 'admin/manageforumelements/$1';
$route['admin/forum/create'] = 'admin/createforum';
$route['admin/forum/edit/(:num)'] = 'admin/editforum/$1';
$route['admin/forum/add'] = 'admin/addforum';
$route['admin/forum/update'] = 'admin/updateforum';
$route['admin/forum/delete'] = 'admin/deleteforum';
$route['admin/forum/category/create'] = 'admin/createforumcategory';
$route['admin/forum/category/edit/(:num)'] = 'admin/editforumcategory/$1';
$route['admin/forum/category/add'] = 'admin/addforumcategory';
$route['admin/forum/category/update'] = 'admin/updateforumcategory';
$route['admin/forum/category/delete'] = 'admin/deleteforumcategory';

/*Check*/
$route['admin/checksoap'] = 'admin/checkSoap';