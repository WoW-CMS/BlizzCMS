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
    }

    public function index()
    {
        $this->load->view('general/header');
        $this->load->view('index');
        $this->load->view('general/footer');
    }

    /**
     * System functions
     */
    public function settings()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('settings/general_settings', $data);
        $this->load->view('general/footer');
    }

    public function databasesettings()
    {
        $this->load->view('general/header');
        $this->load->view('settings/database_settings');
        $this->load->view('general/footer');
    }

    public function optionalsettings()
    {
        $this->load->view('general/header');
        $this->load->view('settings/optional_settings');
        $this->load->view('general/footer');
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

    public function managemodules()
    {
        $this->load->view('general/header');
        $this->load->view('settings/manage_modules');
        $this->load->view('general/footer');
    }

    public function managerealms()
    {
        $this->load->view('general/header');
        $this->load->view('settings/manage_realms');
        $this->load->view('general/footer');
    }

    public function createrealm()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('settings/create_realm', $data);
        $this->load->view('general/footer');
    }

    public function manageslides()
    {
        $this->load->view('general/header');
        $this->load->view('settings/manage_slides');
        $this->load->view('general/footer');
    }

    public function createslide()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('settings/create_slide', $data);
        $this->load->view('general/footer');
    }

    /**
     * Users functions
     */
    public function accounts()
    {
        $this->load->view('general/header');
        $this->load->view('account/accounts');
        $this->load->view('general/footer');
    }

    public function manageaccount($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->m_data->getAccountExist($id)->num_rows() < 1)
            redirect(base_url(),'refresh');

        $data['idlink'] = $id;

        $this->load->view('general/header');
        $this->load->view('account/manageaccount', $data);
        $this->load->view('general/footer');
    }

    public function characters()
    {
        $this->load->view('general/header');
        $this->load->view('characters/characters');
        $this->load->view('general/footer');
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

        $data['idlink'] = $id;
        $data['idrealm'] = $realm;
        $data['multiRealm'] = $multiRealm;

        $this->load->view('general/header');
        $this->load->view('characters/managecharacter', $data);
        $this->load->view('general/footer');
    }

    /**
     * Website functions
     */
    public function managenews()
    {
        $this->load->view('general/header');
        $this->load->view('news/manage_news');
        $this->load->view('general/footer');
    }

    public function createnews()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('news/create_news', $data);
        $this->load->view('general/footer');
    }

    public function editnews($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getNewsSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('news/edit_news', $data);
        $this->load->view('general/footer');
    }

    public function managechangelogs()
    {
        $this->load->view('general/header');
        $this->load->view('changelogs/manage_changelogs');
        $this->load->view('general/footer');
    }

    public function createchangelog()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('changelogs/create_changelog', $data);
        $this->load->view('general/footer');
    }

    public function editchangelog($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getChangelogSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('changelogs/edit_changelog', $data);
        $this->load->view('general/footer');
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
        $this->load->view('general/header');
        $this->load->view('page/manage_pages');
        $this->load->view('general/footer');
    }

    public function createpage()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('page/create_page', $data);
        $this->load->view('general/footer');
    }

    public function editpage($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getPagesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('page/edit_page', $data);
        $this->load->view('general/footer');
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
        $this->load->view('general/header');
        $this->load->view('faq/manage_faqs');
        $this->load->view('general/footer');
    }

    public function createfaq()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('faq/create_faq', $data);
        $this->load->view('general/footer');
    }

    public function editfaq($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getFaqSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('faq/edit_faq', $data);
        $this->load->view('general/footer');
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
        $this->load->view('general/header');
        $this->load->view('vote/manage_topsites');
        $this->load->view('general/footer');
    }

    public function createtopsite()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('vote/create_topsite', $data);
        $this->load->view('general/footer');
    }

    public function edittopsite($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getTopsitesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('vote/edit_topsite', $data);
        $this->load->view('general/footer');
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
        $this->load->view('general/header');
        $this->load->view('store/manage_groups');
        $this->load->view('general/footer');
    }

    public function creategroup()
    {
        $this->load->view('general/header');
        $this->load->view('store/create_group');
        $this->load->view('general/footer');
    }

    public function editgroup($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getGroupSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('store/edit_group', $data);
        $this->load->view('general/footer');
    }

    public function manageitems()
    {
        $this->load->view('general/header');
        $this->load->view('store/manage_items');
        $this->load->view('general/footer');
    }

    public function createitem()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('store/create_item', $data);
        $this->load->view('general/footer');
    }

    public function edititem($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getItemSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('store/edit_item', $data);
        $this->load->view('general/footer');
    }

    public function donate()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('donate/index', $data);
        $this->load->view('general/footer');
    }

    /**
     * Forum functions
     */
    public function managecategories()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('forum/manage_categories', $data);
        $this->load->view('general/footer');
    }

    public function manageforums()
    {
        $this->load->view('general/header');
        $this->load->view('forum/manage_forums');
        $this->load->view('general/footer');
    }

    public function createforum()
    {
        $data = array(
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('forum/create_forum', $data);
        $this->load->view('general/footer');
    }

    public function editforum($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getSpecifyForumRows($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'idlink' => $id,
            'lang' => $this->lang->lang()
        );

        $this->load->view('general/header');
        $this->load->view('forum/edit_forum', $data);
        $this->load->view('general/footer');
    }

    public function checkSoap()
    {
        foreach ($this->m_data->getRealms()->result() as $charsMultiRealm) {

            echo $this->m_soap->commandSoap('.server info', $charsMultiRealm->console_username, $charsMultiRealm->console_password, $charsMultiRealm->console_hostname, $charsMultiRealm->console_port, $charsMultiRealm->emulator).'<br>';
        }
    }
}
