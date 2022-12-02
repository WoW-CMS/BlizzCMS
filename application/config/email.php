<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['useragent'] = 'Mailer';
$config['protocol'] = 'mail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = '';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_port'] = 25;
$config['smtp_timeout'] = 5;
$config['smtp_keepalive'] = false;
$config['smtp_crypto'] = '';
$config['wordwrap'] = true;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['validate'] = false;
$config['priority'] = 3;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = false;
$config['bcc_batch_size'] = 200;
