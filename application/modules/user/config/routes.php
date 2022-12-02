<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['user']['get'] = 'user/index';
$route['user/profile'] = 'user/profile';
$route['user/security']['get'] = 'security/index';
$route['user/security/email'] = 'security/change_email';
$route['user/security/password'] = 'security/change_password';
