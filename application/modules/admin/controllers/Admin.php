<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'total_users'    => $this->user_model->count_all(),
            'total_bans'     => $this->ban_model->count_all(['type' => Ban_model::TYPE_USER]),
            'total_articles' => $this->news_model->count_all(),
            'total_pages'    => $this->page_model->count_all(),
            'articles'       => $this->_get_wowcms_articles()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('index', $data);
    }

    private function _get_wowcms_articles()
    {
        $cache = $this->cache->get('wowcms_articles');

        if ($cache !== false) {
            return $cache;
        }

        $request = curl_request('https://wow-cms.com/api/articles', [
            CURLOPT_TIMEOUT       => 2,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $articles = is_json($request) ? json_decode($request) : [];

        $this->cache->save('wowcms_articles', $articles, 21600);

        return $articles;
    }
}
