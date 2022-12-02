<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show page
     *
     * @param string $slug
     * @return string
     */
    public function index($slug = null)
    {
        $page = $this->page_model->find(['slug' => $slug]);

        if (empty($page)) {
            show_404();
        }

        require_permission($page->id, ':page:');

        $data = [
            'page' => $page
        ];

        if ($this->pageviews_model->is_first_viewed()) {
            $this->page_model->set([
                'views' => 'views+1'
            ], ['id' => $page->id], false);
        }

        $this->template->title($page->title, config_item('app_name'));
        $this->template->set_meta_tags([
            'description' => $page->meta_description,
            'robots'      => $page->meta_robots,
            'title'       => $page->title,
            'type'        => 'article',
            'url'         => current_url()
        ]);

        $this->template->build('page', $data);
    }
}
