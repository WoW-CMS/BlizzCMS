<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('news/news_model');
        $this->load->config('home');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowgeneral->getMaintenance())
            redirect(base_url('maintenance'),'refresh');
    }

    public function index()
    {
        if ($this->config->item('migrate_status') == '1')
        {
            $data = array(
                'lang' => $this->lang->lang()
            );
            $this->load->view('migrate', $data);
        }
        else
        {
            $discord = $this->home_model->getDiscordInfo();

            $data = array(
                'pagetitle' => lang('tab_home'),
                'slides' => $this->home_model->getSlides()->result(),
                'NewsList' => $this->news_model->getNewsList()->result(),
                'realmsList' => $this->wowrealm->getRealms()->result(),
                // Discord
                'discord_code' => $discord['code'],
                'discord_id' => $discord['guild']['id'],
                'discord_icon' => $discord['guild']['icon'],
                'discord_name' => $discord['guild']['name'],
                'discord_counts' => $discord['approximate_presence_count'],
            );

            $this->template->build('home', $data);
        }
    }

    public function migrateNow()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        } else {
            redirect(base_url());
        }
    }

    public function setconfig()
    {
        $name = $this->input->post('name');
        $invitation = $this->input->post('invitation');
        $realmlist = $this->input->post('realmlist');
        $expansion = $this->input->post('expansion');
        $license = $this->input->post('license');
        echo $this->home_model->updateconfigs($name, $invitation, $realmlist, $expansion, $license);
    }
}
