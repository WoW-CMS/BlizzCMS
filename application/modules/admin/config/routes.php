<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin'] = 'admin/index';

$route['admin/tools/cache']['get'] = 'tools/cache';
$route['admin/tools/sessions']['get'] = 'tools/sessions';

$route['admin/update']['get'] = 'update/index';
$route['admin/update/run']['get'] = 'update/run';
$route['admin/update/force']['get'] = 'update/force';

$route['admin/settings'] = 'settings/index';
$route['admin/settings/avatar'] = 'settings/avatar';
$route['admin/settings/discussion'] = 'settings/discussion';
$route['admin/settings/mailer'] = 'settings/mailer';
$route['admin/settings/mailer/test'] = 'settings/mailer_test';
$route['admin/settings/seo'] = 'settings/seo';
$route['admin/settings/captcha'] = 'settings/captcha';
$route['admin/settings/login'] = 'settings/login';
$route['admin/settings/logs'] = 'settings/logs';
$route['admin/settings/logs/purge']['get'] = 'settings/purge_logs';

$route['admin/appearance']['get'] = 'appearance/index';
$route['admin/appearance/activate/(:any)']['get'] = 'appearance/activate/$1';
$route['admin/appearance/deactivate']['get'] = 'appearance/deactivate';
$route['admin/appearance/delete/(:any)']['get'] = 'appearance/delete/$1';
$route['admin/appearance/upload'] = 'appearance/upload';

$route['admin/languages']['get'] = 'languages/index';
$route['admin/languages/add/(:any)']['get'] = 'languages/add/$1';
$route['admin/languages/delete/(:any)']['get'] = 'languages/delete/$1';
$route['admin/languages/set/(:any)']['get'] = 'languages/set/$1';

$route['admin/menus']['get'] = 'menus/index';
$route['admin/menus/add'] = 'menus/add';
$route['admin/menus/edit/(:num)'] = 'menus/edit/$1';
$route['admin/menus/delete/(:num)']['get'] = 'menus/delete/$1';
$route['admin/menus/(:num)']['get'] = 'menus/items/$1';
$route['admin/menus/(:num)/add'] = 'menus/add_item/$1';
$route['admin/menus/(:num)/edit/(:num)'] = 'menus/edit_item/$1/$2';
$route['admin/menus/(:num)/delete/(:num)']['get'] = 'menus/delete_item/$1/$2';
$route['admin/menus/(:num)/move/(:num)/(:any)']['get'] = 'menus/move_item/$1/$2/$3';

$route['admin/slides']['get'] = 'slides/index';
$route['admin/slides/add'] = 'slides/add';
$route['admin/slides/edit/(:num)'] = 'slides/edit/$1';
$route['admin/slides/delete/(:num)']['get'] = 'slides/delete/$1';
$route['admin/slides/move/(:num)/(:any)']['get'] = 'slides/move/$1/$2';

$route['admin/modules']['get'] = 'modules/index';
$route['admin/modules/install/(:any)']['get'] = 'modules/install/$1';
$route['admin/modules/uninstall/(:any)']['get'] = 'modules/uninstall/$1';
$route['admin/modules/delete/(:any)']['get'] = 'modules/delete/$1';
$route['admin/modules/force/(:any)']['get'] = 'modules/force/$1';
$route['admin/modules/upload'] = 'modules/upload';

$route['admin/logs']['get'] = 'logs/index';

$route['admin/realms']['get'] = 'realms/index';
$route['admin/realms/add'] = 'realms/add';
$route['admin/realms/edit/(:num)'] = 'realms/edit/$1';
$route['admin/realms/delete/(:num)']['get'] = 'realms/delete/$1';
$route['admin/realms/soap/(:num)']['get'] = 'realms/check_soap/$1';

$route['admin/users']['get'] = 'users/index';
$route['admin/users/view/(:num)']['get'] = 'users/view/$1';
$route['admin/users/view/(:num)/characters']['get'] = 'users/view_characters/$1';
$route['admin/users/view/(:num)/logs']['get'] = 'users/view_logs/$1';
$route['admin/users/update/(:num)']['post'] = 'users/update/$1';

$route['admin/roles']['get'] = 'roles/index';
$route['admin/roles/add'] = 'roles/add';
$route['admin/roles/edit/(:num)'] = 'roles/edit/$1';
$route['admin/roles/delete/(:num)']['get'] = 'roles/delete/$1';

$route['admin/bans']['get'] = 'bans/index';
$route['admin/bans/add'] = 'bans/add_user';
$route['admin/bans/delete'] = 'bans/delete_user';
$route['admin/bans/view/(:num)']['get'] = 'bans/view_user/$1';
$route['admin/bans/ips']['get'] = 'bans/ips';
$route['admin/bans/ips/add'] = 'bans/add_ip';
$route['admin/bans/ips/delete/(:num)']['get'] = 'bans/delete_ip/$1';
$route['admin/bans/ips/view/(:num)']['get'] = 'bans/view_ip/$1';
$route['admin/bans/emails']['get'] = 'bans/emails';
$route['admin/bans/emails/add'] = 'bans/add_email';
$route['admin/bans/emails/delete/(:num)']['get'] = 'bans/delete_email/$1';
$route['admin/bans/emails/view/(:num)']['get'] = 'bans/view_email/$1';

$route['admin/news']['get'] = 'news/index';
$route['admin/news/add'] = 'news/add';
$route['admin/news/edit/(:num)'] = 'news/edit/$1';
$route['admin/news/delete/(:num)']['get'] = 'news/delete/$1';
$route['admin/news/clear/(:num)']['get'] = 'news/delete_comments/$1';

$route['admin/pages']['get'] = 'pages/index';
$route['admin/pages/add'] = 'pages/add';
$route['admin/pages/edit/(:num)'] = 'pages/edit/$1';
$route['admin/pages/delete/(:num)']['get'] = 'pages/delete/$1';
