<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'articles' => $this->news_model->latest(),
            'realms'   => $this->realm_model->find_all()
        ];

        $this->template->title(config_item('app_name'));
        $this->template->set_meta_tags([
            'robots' => 'index, follow',
            'type'   => 'website',
            'url'    => current_url()
        ], true);

        $this->template->build('home', $data);
    }

    /**
     * Change site language
     *
     * @param string $locale
     * @return void
     */
    public function lang($locale = null)
    {
        $this->multilanguage->set_language($locale);

        redirect($this->agent->referrer());
    }
}
