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

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'pages_model' => 'pages'
        ]);
    }

    /**
     * Show page
     *
     * @param string $slug
     * @return string
     */
    public function index($slug = null)
    {
        $page = $this->pages->find(['slug' => $slug]);

        if (empty($page))
        {
            show_404();
        }

        $data = [
            'page' => $page
        ];

        $this->template->title(config_item('app_name'), $page->title);

        $this->template->build('page', $data);
    }
}