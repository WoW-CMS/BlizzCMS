<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('changelogs', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->load->model([
            'changelogs_model' => 'changelogs'
        ]);

        $this->load->language('changelogs', $this->language->current());
    }

    public function index()
    {
        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 15;

        $this->pagination->initialize([
            'base_url'    => site_url('changelogs'),
            'total_rows'  => $this->changelogs->count_all(),
            'per_page'    => $per_page,
            'uri_segment' => 2
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'changelogs' => $this->changelogs->find_all($per_page, $offset),
            'links'      => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('changelogs'));

        $this->template->build('index', $data);
    }
}
