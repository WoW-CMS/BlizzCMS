<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('run.tools');
    }

    public function cache()
    {
        if (! $this->cache->clean()) {
            $this->session->set_flashdata('error', lang('alert_cache_failed'));
        } else {
            $this->session->set_flashdata('success', lang('alert_cache_deleted'));
        }

        $this->log_model->create('cache', 'purge', 'Purged the cache');

        redirect(site_url('admin'));
    }

    public function sessions()
    {
        $this->log_model->create('sessions', 'purge', 'Purged all sessions');

        $this->user_token_model->delete(['type' => User_token_model::TOKEN_REMEMBER]);
        $this->db->truncate('sessions');

        redirect(site_url());
    }
}
