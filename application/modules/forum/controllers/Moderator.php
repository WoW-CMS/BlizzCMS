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

class Moderator extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('forum', true);

        if (! $this->website->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_moderator() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->language('admin/admin');
        $this->load->language('forum');

        $this->template->set_theme();
        $this->template->set_layout('moderator_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $this->template->title(config_item('app_name'), lang('mod_panel'));

        $this->template->build('moderator/index');
    }

    public function queue()
    {
        $this->template->title(config_item('app_name'), lang('mod_panel'));

        $this->template->build('moderator/queue/index');
    }

    public function reports()
    {
        $this->template->title(config_item('app_name'), lang('mod_panel'));

        $this->template->build('moderator/reports/index');
    }

    public function logs()
    {
        $this->template->title(config_item('app_name'), lang('mod_panel'));

        $this->template->build('moderator/logs/index');
    }

    public function bannings()
    {
        $this->template->title(config_item('app_name'), lang('mod_panel'));

        $this->template->build('moderator/bannings/index');
    }

    public function warnings()
    {
        $this->template->title(config_item('app_name'), lang('mod_panel'));

        $this->template->build('moderator/warnings/index');
    }
}
