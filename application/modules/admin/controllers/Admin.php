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

class Admin extends MX_Controller {

    private $wowlocadm = '',
            $wowlocdef = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->config->load('donate/donate');
        $this->config->load('bugtracker/bugtracker');
		$this->load->library('pagination');
		$this->load->library('updater');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) < config_item('admin_access_level'))
            redirect(base_url(),'refresh');

        if($this->admin_model->getBanSpecify($this->session->userdata('wow_sess_id'))->num_rows())
            redirect(base_url(),'refresh');

        $this->template->set_theme('admin');

        $this->wowlocadm = base_url('application/themes/'.$this->template->get_theme().'/');
        $this->wowlocdef = base_url('application/themes/'.config_item('theme_name').'/');
    }

    public function index()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
        ];

        $this->template->build('index', $data);
    }

    /**
     * System functions
     */
    public function settings()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('settings/general_settings', $data);
    }

    public function updatesettings()
    {
        $project = $this->input->post('project');
        $timezone = $this->input->post('timezone');
        $maintenance = $this->input->post('maintenance');
        $discord = $this->input->post('discord');
        $realmlist = $this->input->post('realmlist');
        $theme = $this->input->post('theme');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $youtube = $this->input->post('youtube');
        echo $this->admin_model->updateGeneralSettings($project, $timezone, $maintenance, $discord, $realmlist, $theme, $facebook, $twitter, $youtube);
    }

    public function optionalsettings()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('settings/optional_settings', $data);
    }

    public function updateoptionalsettings()
    {
        $adminlvl = $this->input->post('adminlvl');
        $modlvl = $this->input->post('modlvl');
        $recaptcha = $this->input->post('recaptcha');
        $register = $this->input->post('register');
        $smtphost = $this->input->post('smtphost');
        $smtpport = $this->input->post('smtpport');
        $smtpcrypto = $this->input->post('smtpcrypto');
        $smtpuser = $this->input->post('smtpuser');
        $smtppass = $this->input->post('smtppass');
        $sender = $this->input->post('sender');
        $sendername = $this->input->post('sendername');
        echo $this->admin_model->updateOptionalSettings($adminlvl, $modlvl, $recaptcha, $register, $smtphost, $smtpport, $smtpcrypto, $smtpuser, $smtppass, $sender, $sendername);
    }

    public function seosettings()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('settings/seo_settings', $data);
    }

    public function updateseosettings()
    {
        $meta = $this->input->post('meta');
        $description = $this->input->post('description');
        $keywords = $this->input->post('keywords');
        $twitter = $this->input->post('twitter');
        $graph = $this->input->post('graph');
        echo $this->admin_model->updateSeoSettings($meta, $description, $keywords, $twitter, $graph);
    }

    public function modulesettings()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' =>  $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('settings/module_settings', $data);
    }

    public function updatedonatesettings()
    {
        $currency = $this->input->post('currency');
        $mode = $this->input->post('mode');
        $client = $this->input->post('client');
        $password = $this->input->post('password');
        $currencySymbol = $this->input->post('symbol');
        echo $this->admin_model->updateDonateSettings($currency, $mode, $client, $password, $currencySymbol);
    }

    public function updatebugtrackersettings()
    {
        $description = $this->input->post('description');
        echo $this->admin_model->updateBugtrackerSettings($description);
    }

    public function managemodules()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('settings/manage_modules', $data);
    }

    public function enablemodule()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->enableSpecifyModule($id);
    }

    public function disablemodule()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->disableSpecifyModule($id);
    }

    public function cmsmanage()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
			'latest_version' => $this->updater->latest_version(),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('update/manage_updates', $data);
    }

    public function updatecms()
	{
		$lang = $this->lang->lang();
		$update = $this->updater->update();

		if (in_array($update['alert'], ['error', 'info', 'warning'], true)) {
			$this->session->set_flashdata($update['alert'], $update['message']);
			redirect(base_url($lang . '/admin/cms/'));
		}

		if ($this->migration->current() === false) {
			show_error($this->migration->error_string());
		}

		$this->session->set_flashdata('success', $update['message']);
		redirect(base_url($lang . '/admin/cms/'));
    }

    /**
     * Users functions
     */
    public function accounts()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
        ];

        $config['total_rows'] = $this->admin_model->countAccounts();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/accounts/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['accountsList'] = $this->admin_model->accountsList();
        }

        $this->template->build('account/accounts', $data);
    }

    public function accountmanage($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getAccountExist($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('account/manage_account', $data);
    }

    public function accountdonatelogs($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getAccountExist($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id
        ];

        $this->template->build('account/manage_donate_logs', $data);
    }

    public function updateaccount()
    {
        $id = $this->input->post('id');
        $dp = $this->input->post('dp');
        $vp = $this->input->post('vp');
        echo $this->admin_model->updateAccountData($id, $dp, $vp);
    }

    public function banaccount()
    {
        $id = $this->input->post('id');
        $reason = $this->input->post('reason');
        echo $this->admin_model->insertBanAccount($id, $reason);
    }

    public function unbanaccount()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delBanAccount($id);
    }

    public function grantrankaccount()
    {
        $id = $this->input->post('id');
        $rank = $this->input->post('rank');
        echo $this->admin_model->insertRankAccount($id, $rank);
    }

    public function delrankaccount()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delRankAccount($id);
    }

    /**
     * Website functions
     */
    public function managemenu()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('menu/manage_menu', $data);
    }

    public function createmenu()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('menu/create_menu', $data);
    }

    public function editmenu($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getMenuSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('menu/edit_menu', $data);
    }

    public function addmenu()
    {
        $name = $this->input->post('name');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $main = $this->input->post('main');
        $child = $this->input->post('child');
        $type = $this->input->post('type');
        echo $this->admin_model->insertMenu($name, $url, $icon, $main, $child, $type);
    }

    public function updatemenu()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $main = $this->input->post('main');
        $child = $this->input->post('child');
        $type = $this->input->post('type');
        echo $this->admin_model->updateSpecifyMenu($id, $name, $url, $icon, $main, $child, $type);
    }

    public function deletemenu()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delSpecifyMenu($id);
    }

    public function managerealms()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countRealms();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/realms/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['realmsList'] = $this->admin_model->realmsList();
        }

        $this->template->build('realm/manage_realms', $data);
    }

    public function createrealm()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('realm/create_realm', $data);
    }

    public function editrealm($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getRealmsSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('realm/edit_realm', $data);
    }

    public function addrealm()
    {
        $realmid = $this->input->post('realmid');
        $soap_host = $this->input->post('soaphost');
        $soap_port = $this->input->post('soapport');
        $soap_user = $this->input->post('soapuser');
        $soap_pass = $this->input->post('soappass');
        $char_host = $this->input->post('charhost');
        $char_db = $this->input->post('chardb');
        $char_user = $this->input->post('charuser');
        $char_pass = $this->input->post('charpass');
        $emulator = $this->input->post('emulator');
        echo $this->admin_model->insertRealm($char_host, $char_user, $char_pass, $char_db, $realmid, $soap_host, $soap_user, $soap_pass, $soap_port, $emulator);
    }

    public function updaterealm()
    {
        $id = $this->input->post('id');
        $realmid = $this->input->post('realmid');
        $soap_host = $this->input->post('soaphost');
        $soap_port = $this->input->post('soapport');
        $soap_user = $this->input->post('soapuser');
        $soap_pass = $this->input->post('soappass');
        $char_host = $this->input->post('charhost');
        $char_db = $this->input->post('chardb');
        $char_user = $this->input->post('charuser');
        $char_pass = $this->input->post('charpass');
        $emulator = $this->input->post('emulator');
        echo $this->admin_model->updateSpecifyRealm($id, $char_host, $char_user, $char_pass, $char_db, $realmid, $soap_host, $soap_user, $soap_pass, $soap_port, $emulator);
    }

    public function deleterealm()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delSpecifyRealm($id);
    }

    public function manageslides()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countSlides();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/slides/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['slidesList'] = $this->admin_model->slidesList();
        }

        $this->template->build('slide/manage_slides', $data);
    }

    public function createslide()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('slide/create_slide', $data);
    }

    public function editslide($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getSlidesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('slide/edit_slide', $data);
    }

    public function addslide()
    {
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $type = $this->input->post('type');
        $route = $this->input->post('route');
        echo $this->admin_model->insertSlide($title, $description, $type, $route);
    }

    public function updateslide()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $type = $this->input->post('type');
        $route = $this->input->post('route');
        echo $this->admin_model->updateSpecifySlide($id, $title, $description, $type, $route);
    }

    public function deleteslide()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delSpecifySlide($id);
    }

    public function managenews()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countNews();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/news/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['newsList'] = $this->admin_model->newsList();
        }

        $this->template->build('news/manage_news', $data);
    }

    public function createnews()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('news/create_news', $data);
    }

    public function editnews($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getNewsSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('news/edit_news', $data);
    }

    public function deletenews()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delSpecifyNew($id);
    }

    public function managechangelogs()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countChangelogs();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/changelogs/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['changelogsList'] = $this->admin_model->changelogsList();
        }

        $this->template->build('changelogs/manage_changelogs', $data);
    }

    public function createchangelog()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('changelogs/create_changelog', $data);
    }

    public function editchangelog($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getChangelogSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('changelogs/edit_changelog', $data);
    }

    public function addchangelog()
    {
        $title = $this->input->post('title');
        $description = $_POST['description'];
        echo $this->admin_model->insertChangelog($title, $description);
    }

    public function updatechangelog()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $_POST['description'];
        echo $this->admin_model->updateSpecifyChangelog($id, $title, $description);
    }

    public function deletechangelog()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delChangelog($id);
    }

    public function managepages()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countPages();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/pages/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['pagesList'] = $this->admin_model->pagesList();
        }

        $this->template->build('page/manage_pages', $data);
    }

    public function createpage()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('page/create_page', $data);
    }

    public function editpage($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getPagesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $this->wowgeneral->tinyEditor('Admin'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('page/edit_page', $data);
    }

    public function addpage()
    {
        $title = $this->input->post('title');
        $uri = $this->input->post('uri');
        $description = $_POST['description'];
        echo $this->admin_model->insertPage($title, $uri, $description);
    }

    public function updatepage()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $uri = $this->input->post('uri');
        $description = $_POST['description'];
        echo $this->admin_model->updateSpecifyPage($id, $title, $uri, $description);
    }

    public function deletepage()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delPage($id);
    }

    public function managetopsites()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countTopsites();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/topsites/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['topsitesList'] = $this->admin_model->topsitesList();
        }

        $this->template->build('vote/manage_topsites', $data);
    }

    public function createtopsite()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('vote/create_topsite', $data);
    }

    public function edittopsite($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getTopsitesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('vote/edit_topsite', $data);
    }

    public function addtopsite()
    {
        $name = $this->input->post('name');
        $url = $this->input->post('url');
        $time = $this->input->post('time');
        $points = $this->input->post('points');
        $image = $this->input->post('image');
        echo $this->admin_model->insertTopsite($name, $url, $time, $points, $image);
    }

    public function updatetopsite()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $url = $this->input->post('url');
        $time = $this->input->post('time');
        $points = $this->input->post('points');
        $image = $this->input->post('image');
        echo $this->admin_model->updateSpecifyTopsite($id, $name, $url, $time, $points, $image);
    }

    public function deletetopsite()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delTopsite($id);
    }

    /**
     * Store functions
     */
    public function managestore()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang(),
        ];

        $config['total_rows'] = $this->admin_model->countStoreCategories();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/store/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['storecategoryList'] = $this->admin_model->storeCategoryList();
        }

        $this->template->build('store/manage_store', $data);
    }

    public function managestoreitems()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang(),
        ];

        $config['total_rows'] = $this->admin_model->countStoreItems();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(5);
            $config['base_url'] = base_url().'admin/store/items/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['storeitemList'] = $this->admin_model->storeItemList();
        }

        $this->template->build('store/manage_items', $data);
    }

    public function managestoretop()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang(),
        ];

        $config['total_rows'] = $this->admin_model->countStoreTop();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(5);
            $config['base_url'] = base_url().'admin/store/top/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['storetopList'] = $this->admin_model->storeTopList();
        }

        $this->template->build('store/manage_top', $data);
    }

    public function createstorecategory()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('store/create_category', $data);
    }

    public function editstorecategory($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getStoreCategorySpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('store/edit_category', $data);
    }

    public function addstorecategory()
    {
        $name = $this->input->post('name');
        $route = $this->input->post('route');
        $realm = $this->input->post('realm');
        $main = $this->input->post('main');
        $father = $this->input->post('father');

        echo $this->admin_model->insertStoreCategory($name, $route, $realm, $main, $father);
    }

    public function updatestorecategory()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $route = $this->input->post('route');
        $realm = $this->input->post('realm');
        echo $this->admin_model->updateSpecifyStoreCategory($id, $name, $route, $realm);
    }

    public function deletestorecategory()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->deleteStoreCategory($id);
    }

    public function createstoreitem()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('store/create_item', $data);
    }

    public function editstoreitem($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getItemSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('store/edit_item', $data);
    }

    public function addstoreitem()
    {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $icon = $this->input->post('icon');
        $price_type = $this->input->post('price_type');
        $dp_price = $this->input->post('dp_price');
        $vp_price = $this->input->post('vp_price');
        $command = $this->input->post('command');
        echo $this->admin_model->insertItem($name, $description, $category, $type, $price_type, $dp_price, $vp_price, $icon, $command);
    }

    public function updatestoreitem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $icon = $this->input->post('icon');
        $price_type = $this->input->post('price_type');
        $dp_price = $this->input->post('dp_price');
        $vp_price = $this->input->post('vp_price');
        $command = $this->input->post('command');
        echo $this->admin_model->updateSpecifyItem($id, $name, $description, $category, $type, $price_type, $dp_price, $vp_price, $icon, $command);
    }

    public function deletestoreitem()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delStoreItem($id);
    }

    public function createstoretop()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('store/create_top', $data);
    }

    public function editstoretop($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getStoreTopSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('store/edit_top', $data);
    }

    public function addstoretop()
    {
        $item = $this->input->post('item');
        echo $this->admin_model->insertStoreTop($item);
    }

    public function updatestoretop()
    {
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        echo $this->admin_model->updateSpecifyStoreTop($id, $item);
    }

    public function deletestoretop()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->deleteStoreTop($id);
    }

    public function donate()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('donate/manage_methods', $data);
    }

    public function createdonateplan()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('donate/create_plan', $data);
    }

    public function editdonateplan($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('donate/edit_plan', $data);
    }

    public function adddonateplan()
    {
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $tax = $this->input->post('tax');
        $points = $this->input->post('points');
        echo $this->admin_model->insertDonation($name, $price, $tax, $points);
    }

    public function updatedonateplan()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $tax = $this->input->post('tax');
        $points = $this->input->post('points');
        echo $this->admin_model->updateDonation($id, $name, $price, $tax, $points);
    }

    public function deletedonateplan()
    {
        $value = $this->input->post('value');
        echo $this->admin_model->delSpecifyDonation($value);
    }

    public function donatelogs()
    {
        $data = [
            'pagetitle' => 'Donate Logs',
            'lang' => $this->lang->lang(),
            'donations' => $this->admin_model->getDonateLogs()
        ];

        $this->template->build('donate/donate_logs', $data);
    }

    public function votelogs()
    {
        $data = [
            'pagetitle' => 'Vote Logs',
            'lang' => $this->lang->lang(),
            'votes' => $this->admin_model->getVoteLogs()
        ];

        $this->template->build('vote/vote_logs', $data);
    }

    /**
     * Forum functions
     */
    public function manageforum()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countForumCategories();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/forum/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['forumcategoryList'] = $this->admin_model->forumCategoryList();
        }

        $this->template->build('forum/manage_forum', $data);
    }

    public function manageforumelements()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $config['total_rows'] = $this->admin_model->countForumElements();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(5);
            $config['base_url'] = base_url().'admin/forum/elements/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['forumelementList'] = $this->admin_model->forumElementList();
        }

        $this->template->build('forum/manage_elements', $data);
    }

    public function createforumcategory()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('forum/create_category', $data);
    }

    public function editforumcategory($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getSpecifyForumCategoryRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('forum/edit_category', $data);
    }

    public function addforumcategory()
    {
        $category = $this->input->post('category');
        echo $this->admin_model->insertForumCategory($category);
    }

    public function updateforumcategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        echo $this->admin_model->updateForumCategory($id, $category);
    }

    public function deleteforumcategory()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->deleteForumCategory($id);
    }

    public function createforum()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('forum/create_forum', $data);
    }

    public function editforum($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getSpecifyForumRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('forum/edit_forum', $data);
    }

    public function addforum()
    {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $icon = $this->input->post('icon');
        $type = $this->input->post('type');
        $category = $this->input->post('category');
        echo $this->admin_model->insertForum($name, $description, $icon, $type, $category);
    }

    public function updateforum()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $icon = $this->input->post('icon');
        $type = $this->input->post('type');
        $category = $this->input->post('category');
        echo $this->admin_model->updateSpecifyForum($id, $name, $description, $icon, $type, $category);
    }

    public function deleteforum()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->deleteForum($id);
    }

    public function checkSoap()
    {
        foreach ($this->wowrealm->getRealms()->result() as $charsMultiRealm) {

            echo $this->wowrealm->commandSoap('.server info', $charsMultiRealm->console_username, $charsMultiRealm->console_password, $charsMultiRealm->console_hostname, $charsMultiRealm->console_port, $charsMultiRealm->emulator).'<br>';
        }
    }
	
	/**
	* Download
	**/
	
	public function managedownload()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('download/managedownload', $data);
    }
	
	public function createdownload()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        ];

        $this->template->build('download/create_download', $data);
    }

    public function editdownload($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getDownloadSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        ];

        $this->template->build('download/edit_download', $data);
    }

    public function adddownload()
    {
        $fileName = $this->input->post('fileName');
        $url = $this->input->post('url');
        $image = $this->input->post('image');
        $category = $this->input->post('category');
        $weight = $this->input->post('weight');
        $type = $this->input->post('type');
        echo $this->admin_model->insertDownload($fileName, $url, $image, $category, $weight, $type);
    }

    public function updatedownload()
    {
        $id = $this->input->post('id');
        $fileName = $this->input->post('fileName');
        $url = $this->input->post('url');
        $image = $this->input->post('image');
        $category = $this->input->post('category');
        $weight = $this->input->post('weight');
        $type = $this->input->post('type');
        echo $this->admin_model->updateSpecifyDownload($id, $fileName, $url, $image, $category, $weight, $type);
    }

    public function deletedownload()
    {
        $id = $this->input->post('value');
        echo $this->admin_model->delSpecifyDownload($id);
    }

    /**
     * Tickets
     */

    public function managetickets()
    {
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang(),
        ];

        $config['total_rows'] = $this->admin_model->countStoreCategories();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(4);
            $config['base_url'] = base_url().'admin/store/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['realmsList'] = $this->admin_model->realmsList();
        }

        $this->template->build('tickets/manage_tickets', $data);
    }

    public function ticketrealm($id)
    {
        $multirealm = $this->wowrealm->getRealmConnectionData($id);
        $data = [
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang(),
            'multirealm' => $multirealm
        ];

        $config['total_rows'] = $this->admin_model->countTickets($multirealm);
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(6);
            $config['base_url'] = base_url().'admin/tickets/realm/'.$id.'/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->admin_model->setPageNumber($this->pagination->per_page);
            $this->admin_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['ticketsList'] = $this->admin_model->ticketsList($multirealm);
        }

        $this->template->build('tickets/tickets', $data);
    }
}
