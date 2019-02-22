<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url('maintenance'),'refresh');

        $this->load->model('home_model');
        $this->load->model('news/news_model');
        $this->load->model('events/events_model');

        $this->load->config('home');
    }

    public function index()
    {
        if ($this->m_modules->getInstallation())
        {
            $this->load->model('admin/admin_model');
            $this->load->view('installation');
        }
        else
        {
            $discord = $this->home_model->getDiscordInfo();

            $data = array(
                'pagetitle' => $this->lang->line('nav_home'),
                'slides' => $this->home_model->getSlides()->result(),
                'principalNew' => $this->news_model->getNewSpecifyID($this->news_model->getPrincipalNew())->result(),
                'threeNews' => $this->news_model->getNewsTree()->result(),
                'realmsList' => $this->m_data->getRealms()->result(),
                //route
                'slide_url' => base_url('includes/images/slides/'),
                'news_url' => base_url('includes/images/news/'),
                'store_url' => base_url('includes/images/store/'),
                //lang
                'home_latest_news' => $this->lang->line('home_latest_news'),
                'button_read_more' => $this->lang->line('button_read_more'),
                'home_server_status' => $this->lang->line('home_server_status'),
                'users_on' => $this->lang->line('users_on'),
                'home_store_top' => $this->lang->line('home_store_top'),
                'button_buy' => $this->lang->line('button_buy'),
                //configs
                'conf_realmlist' => $this->config->item('realmlist'),
                'conf_discordurl' => $this->config->item('discordUrl'),
                'conf_discordcdn' => $this->config->item('discordCdn'),
                'conf_discordwidget' => $this->config->item('discordWidget'),
                'conf_discordtheme' => $this->config->item('discordtheme'),
                'discord_width_exp' => $this->config->item('discord_width_experimental'),
                'discord_height_exp' => $this->config->item('discord_height_experimental'),
                'discord_width_class' => $this->config->item('discord_width_classic'),
                'discord_height_class' => $this->config->item('discord_height_classic'),
                'discord_extras' => $this->config->item('discordextras'),
                //discord
                'discord_code' => $discord['code'],
                'discord_id' => $discord['guild']['id'],
                'discord_icon' => $discord['guild']['icon'],
                'discord_name' => $discord['guild']['name'],
                'discord_counts' => $discord['approximate_presence_count'],
            );
        
            $this->load->view('header', $data);
            $this->parser->parse('home', $data);
            $this->load->view('footer');
        }
    }
}
