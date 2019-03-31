<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2019, WoW-CMS
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2019, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

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
        if ($this->m_modules->getInstallationStatus())
        {
            $this->load->model('admin/admin_model');
            $this->load->view('installation');
        }
        else
        {
            $discord = $this->home_model->getDiscordInfo();

            $data = array(
                'pagetitle' => $this->lang->line('tab_home'),
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
