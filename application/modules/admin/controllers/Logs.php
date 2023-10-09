<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.logs');

        $inputSearch = $this->input->get('search');
        $inputPage   = $this->input->get('page');
        $page        = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate
        $filters = ['search' => trim(xss_clean($inputSearch))];

        $this->pagination->initialize([
            'base_url'   => site_url('admin/logs'),
            'total_rows' => $this->log_model->total_paginate($filters),
            'per_page'   => $perPage
        ]);

        $data = [
            'logs'       => $this->log_model->paginate($perPage, $offset, $filters),
            'pagination' => $this->pagination->create_links(),
            'search'     => $inputSearch
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('logs/index', $data);
    }
}
