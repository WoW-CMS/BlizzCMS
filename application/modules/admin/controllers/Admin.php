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

    private $fxlocadm = '';
    private $fxlocdef = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if(!$this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            redirect(base_url(),'refresh');

        if($this->admin_model->getBanSpecify($this->session->userdata('wow_sess_id'))->num_rows())
            redirect(base_url(),'refresh');

        $this->template->set_theme('admin');

        $this->fxlocadm = base_url('application/themes/'.$this->template->get_theme().'/');
        $this->fxlocdef = base_url('application/themes/'.config_item('theme_name').'/');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('index', $data);
    }

    /**
     * System functions
     */
    public function settings()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('settings/general_settings', $data);
    }

    public function updatesettings()
    {
        $project = $this->input->post('project');
        $timezone = $this->input->post('timezone');
        $discord = $this->input->post('discord');
        $realmlist = $this->input->post('realmlist');
        $staffcolor = $_POST['staffcolor'];
        $theme = $this->input->post('theme');
        echo $this->admin_model->updateGeneralSettings($project, $timezone, $discord, $realmlist, $staffcolor, $theme);
    }

    public function optionalsettings()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

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

    public function managemodules()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('settings/manage_modules', $data);
    }

    public function managerealms()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('realm/manage_realms', $data);
    }

    public function createrealm()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('realm/create_realm', $data);
    }

    public function editrealm($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

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
        echo $this->m_modules->insertRealm($char_host, $char_user, $char_pass, $char_db, $realmid, $soap_host, $soap_user, $soap_pass, $soap_port, '1');
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
        echo $this->admin_model->updateSpecifyRealm($id, $char_host, $char_user, $char_pass, $char_db, $realmid, $soap_host, $soap_user, $soap_pass, $soap_port);
    }

    public function manageslides()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('slide/manage_slides', $data);
    }

    public function createslide()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('slide/create_slide', $data);
    }

    public function editslide($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->template->build('slide/edit_slide', $data);
    }

    public function addslide()
    {
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $type = $this->input->post('type');
        $route = $this->input->post('route');
        echo $this->m_modules->insertSlide($title, $description, $type, $route);
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

    /**
     * Users functions
     */
    public function accounts()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('account/accounts', $data);
    }

    public function manageaccount($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->m_data->getAccountExist($id)->num_rows() < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
        );

        $this->template->build('account/manageaccount', $data);
    }

    public function characters()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('characters/characters', $data);
    }

    public function managecharacter($id = '', $realm = '')
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if (is_null($realm) || empty($realm))
            redirect(base_url(),'refresh');

        foreach ($this->m_data->getRealm($realm)->result() as $charsMultiRealm) {
            $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
        }

        if (!$this->m_characters->getGeneralCharactersSpecifyGuid($id, $multiRealm)->num_rows())
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'idrealm' => $realm,
            'multiRealm' => $multiRealm,
        );

        $this->template->build('characters/managecharacter', $data);
    }

    /**
     * Website functions
     */
    public function managenews()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('news/manage_news', $data);
    }

    public function createnews()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('news/create_news', $data);
    }

    public function editnews($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getNewsSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('news/edit_news', $data);
    }

    public function managechangelogs()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('changelogs/manage_changelogs', $data);
    }

    public function createchangelog()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('changelogs/create_changelog', $data);
    }

    public function editchangelog($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getChangelogSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

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

    public function managepages()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('page/manage_pages', $data);
    }

    public function createpage()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('page/create_page', $data);
    }

    public function editpage($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getPagesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

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

    public function managefaqs()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('faq/manage_faqs', $data);
    }

    public function createfaq()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('faq/create_faq', $data);
    }

    public function editfaq($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getFaqSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('Admin');
        else
            $tiny = $this->m_general->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->template->build('faq/edit_faq', $data);
    }

    public function addfaq()
    {
        $title = $this->input->post('title');
        $type = $this->input->post('type');
        $description = $_POST['description'];
        echo $this->admin_model->insertFaq($title, $type, $description);
    }

    public function updatefaq()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $type = $this->input->post('type');
        $description = $_POST['description'];
        echo $this->admin_model->updateSpecifyFaq($id, $title, $type, $description);
    }

    public function managetopsites()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('vote/manage_topsites', $data);
    }

    public function createtopsite()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('vote/create_topsite', $data);
    }

    public function edittopsite($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getTopsitesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

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

    /**
     * Store functions
     */
    public function managegroups()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('store/manage_groups', $data);
    }

    public function creategroup()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('store/create_group', $data);
    }

    public function editgroup($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getGroupSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->template->build('store/edit_group', $data);
    }

    public function addgroup()
    {
        $category = $this->input->post('category');
        echo $this->admin_model->insertGroup($category);
    }

    public function updategroup()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        echo $this->admin_model->updateSpecifyGroup($id, $category);
    }

    public function manageitems()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('store/manage_items', $data);
    }

    public function createitem()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('store/create_item', $data);
    }

    public function edititem($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getItemSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->template->build('store/edit_item', $data);
    }

    public function additem()
    {
        $name = $this->input->post('name');
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $dp_price = $this->input->post('dp_price');
        $vp_price = $this->input->post('vp_price');
        $itemid = $this->input->post('itemid');
        $icon = $this->input->post('icon');
        $image = $this->input->post('image');
        echo $this->admin_model->insertItem($name, $category, $type, $dp_price, $vp_price, $itemid, $icon, $image);
    }

    public function updateitem()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $dp_price = $this->input->post('dp_price');
        $vp_price = $this->input->post('vp_price');
        $itemid = $this->input->post('itemid');
        $icon = $this->input->post('icon');
        $image = $this->input->post('image');
        echo $this->admin_model->updateSpecifyItem($id, $name, $category, $type, $dp_price, $vp_price, $itemid, $icon, $image);
    }

    public function donate()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('donate/index', $data);
    }

    public function insertCategory()
    {
        $name = $_POST['categoryname'];
        return $this->admin_model->insertCategoryAjax($name);
    }

    public function insertDonation()
    {
        $name = $_POST['donationname'];
        $price = $_POST['donationprice'];
        $tax = $_POST['donationtax'];
        $points = $_POST['donationpoints'];
        return $this->admin_model->insertDonationAjax($name, $price, $tax, $points);
    }

    public function updateCategory()
    {
        $id = $_POST['id'];
        $name = $_POST['text'];
        $column = $_POST['colum_name'];
        return $this->admin_model->updateCategoryAjax($id, $name, $column);
    }

    public function updateDonation()
    {
        $id = $_POST['id'];
        $name = $_POST['text'];
        $column = $_POST['colum_name'];
        return $this->admin_model->updateDonationAjax($id, $name, $column);
    }

    public function deleteCategory()
    {
        $id = $_POST['id'];
        return $this->admin_model->deleteCategoryAjax($id);
    }

    public function deleteDonation()
    {
        $id = $_POST['id'];
        return $this->admin_model->deleteDonationAjax($id);
    }

    public function getDonateList()
    {
        $output = '';
        $output .= '
        <div class="uk-overflow-auto">
        <table class="uk-table uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th class="uk-width-medium">'.$this->lang->line('placeholder_title').'</th>
                    <th class="uk-width-small">'.$this->lang->line('store_item_price').'</th>
                    <th class="uk-width-small">'.$this->lang->line('table_header_tax').'</th>
                    <th class="uk-width-small">'.$this->lang->line('table_header_points').'</th>
                    <th class="uk-table-shrink">'.$this->lang->line('table_header_action').'</th>
                </tr>
            </thead>
            <tbody>';
        if($this->admin_model->getDonateListAjax()->num_rows()){
            foreach($this->admin_model->getDonateListAjax()->result() as $list) {
                $output .= '<tr>
                    <td>
                        <input type="text" class="uk-input" id="donateName" value="'.$list->name.'" data-id1="'.$list->id.'">
                    </td>
                    <td>
                        <input type="text" class="uk-input" id="donatePrice" value="'.$list->price.'" data-id4="'.$list->id.'">
                    </td>
                    <td>
                        <input type="text" class="uk-input" id="donateTax" value="'.$list->tax.'" data-id5="'.$list->id.'">
                    </td>
                    <td>
                        <input type="text" class="uk-input" id="donatePoints" value="'.$list->points.'" data-id6="'.$list->id.'">
                    </td>
                    <td class="uk-table-shrink">
                        <button class="uk-button uk-button-danger" name="button_deleteDonate" id="button_deleteDonate" data-id3="'.$list->id.'"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>';
            }
        }

        $output .= '
                <td>
                    <input type="text" class="uk-input" placeholder="Insert title" id="newdonatename" value="Classic">
                </td>
                <td>
                    <input type="text" class="uk-input" placeholder="Insert Price" id="newdonateprice" value="1.00">
                </td>
                <td>
                    <input type="text" class="uk-input" placeholder="Insert Tax" id="newonateTax" value="0.00">
                </td>
                <td>
                    <input type="text" class="uk-input" placeholder="Insert Points" id="newdonatepoints" value="1">
                </td>
                <td>
                    <button class="uk-button uk-button-primary" name="button_adddonation" id="button_adddonation"><i class="fa fa-plus-circle"></i></button>
                </td>
            ';
        if(!$this->admin_model->getDonateListAjax()->num_rows()){
            $output .= '
            <tr>
                <td><div class="uk-alert-warning" uk-alert><p class="uk-text-center"><span uk-icon="warning"></span> Data not found</p></div></td>
            </tr>';
        }
        $output .= '</tbody>
                        </table></div>';

        echo $output;
    }

    public function getCategoryList()
    {
        $output = '';
        $output .= '
        <div class="uk-overflow-auto">
        <table class="uk-table uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th class="uk-table-expand">'.$this->lang->line('placeholder_title').'</th>
                    <th class="uk-table-shrink">'.$this->lang->line('table_header_action').'</th>
                </tr>
            </thead>
            <tbody>';
        if($this->admin_model->getForumCategoryListAjax()->num_rows()){
            foreach($this->admin_model->getForumCategoryListAjax()->result() as $list) {
                $output .= '<tr>
                    <td>
                        <input type="text" class="uk-input" id="categoryName" value="'.$list->categoryName.'" data-id1="'.$list->id.'">
                    </td>
                    <td>
                        <button class="uk-button uk-button-danger" name="button_deleteCategory" id="button_deleteCategory" data-id3="'.$list->id.'"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>';
            }

            $output .= '
                <td>
                    <input type="text" class="uk-input" placeholder="Insert title" id="newcategoryname">
                </td>
                <td>
                    <button class="uk-button uk-button-primary" name="button_addCategory" id="button_addCategory"><i class="fa fa-plus-circle"></i></button>
                </td>
            ';
        }
        else{
            $output .= '
            <td>
                <input type="text" class="uk-input" placeholder="Insert title" id="newcategoryname">
            </td>
            <td>
                <button class="uk-button uk-button-primary" name="button_addCategory" id="button_addCategory"><i class="fa fa-plus-circle"></i></button>
            </td>

            <tr>
                <td><div class="uk-alert-warning" uk-alert><p class="uk-text-center"><span uk-icon="warning"></span> Data not found</p></div></td>
            </tr>';
        }
        $output .= '</tbody>
                        </table></div>';

        echo $output;
    }

    /**
     * Forum functions
     */
    public function managecategories()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('forum/manage_categories', $data);
    }

    public function manageforums()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
        );

        $this->template->build('forum/manage_forums', $data);
    }

    public function createforum()
    {
        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'lang' => $this->lang->lang()
        );

        $this->template->build('forum/create_forum', $data);
    }

    public function editforum($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getSpecifyForumRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('button_admin_panel'),
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->template->build('forum/edit_forum', $data);
    }

    public function checkSoap()
    {
        foreach ($this->m_data->getRealms()->result() as $charsMultiRealm) {

            echo $this->m_soap->commandSoap('.server info', $charsMultiRealm->console_username, $charsMultiRealm->console_password, $charsMultiRealm->console_hostname, $charsMultiRealm->console_port, $charsMultiRealm->emulator).'<br>';
        }
    }
}
