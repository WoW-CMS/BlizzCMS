<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['per_page'] = 25;
$config['page_query_string'] = true;
$config['query_string_segment'] = 'page';
$config['reuse_query_string'] = true;
$config['num_links'] = 2;
$config['use_page_numbers'] = true;

$config['full_tag_open'] = '<ul class="pagination uk-pagination uk-margin">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = '<i class="fa-solid fa-angles-left"></i>';
$config['first_tag_open'] = '<li class="prev page">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = '<i class="fa-solid fa-angles-right"></i>';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '<i class="fa-solid fa-angle-right"></i>';
$config['next_tag_open'] = '<li class="next page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '<i class="fa-solid fa-angle-left"></i>';
$config['prev_tag_open'] = '<li class="prev page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="uk-active"><a>';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page">';
$config['num_tag_close'] = '</li>';

$config['anchor_class'] = 'follow_link';
