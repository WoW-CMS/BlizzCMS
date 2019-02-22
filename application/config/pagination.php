<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pagination Config
 *
 * Applying codeigniter's standard pagination config with twitter 
 * bootstrap stylings
 *
 * @author      TechArise Team
 * @link        http://codeigniter.com/user_guide/libraries/pagination.html
 * @email       info@techarise.com
 *
 * @file        pagination.php
 * @version     1.0.0.1
 * @date        24/09/2017
 *
 * Copyright (c) 2017
 */

$config['per_page'] = 10;
$config['num_links'] = 2;

$config['use_page_numbers'] = TRUE;
$config['page_query_string'] = FALSE;

$config['query_string_segment'] = '';
$config['full_tag_open'] = '<ul class="pagination uk-pagination uk-flex-right uk-margin">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = '&laquo; First';
$config['first_tag_open'] = '<li class="prev page">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last &raquo;';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next &rarr;';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&larr; Previous';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="uk-active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';

$config['anchor_class'] = 'follow_link';
