<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if(!$this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            redirect(base_url(),'refresh');

        if($this->admin_model->getBanSpecify($this->session->userdata('fx_sess_id'))->num_rows())
            redirect(base_url(),'refresh');
    }

    public function index()
    {
        $this->load->view('general/header');
        $this->load->view('index');
        $this->load->view('general/footer');
    }

    public function settings()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('settings/index', $data);
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
        <div class="uk-overflow-auto uk-margin-small">
        <table class="uk-table uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th class="uk-width-medium">'.$this->lang->line('form_title').'</th>
                    <th class="uk-width-small">'.$this->lang->line('store_item_price').'</th>
                    <th class="uk-width-small">'.$this->lang->line('column_tax').'</th>
                    <th class="uk-width-small">'.$this->lang->line('column_points').'</th>
                    <th class="uk-table-shrink">'.$this->lang->line('column_action').'</th>
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
        <div class="uk-overflow-auto uk-margin-small">
        <table class="uk-table uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th class="uk-table-expand">'.$this->lang->line('form_title').'</th>
                    <th class="uk-table-shrink">'.$this->lang->line('column_action').'</th>
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

    public function managerealms()
    {
        $this->load->view('general/header');
        $this->load->view('settings/managerealms');
        $this->load->view('general/footer');
        $this->load->view('settings/modal');
    }

    public function manageslides()
    {
        $this->load->view('general/header');
        $this->load->view('settings/manageslides');
        $this->load->view('general/footer');
        $this->load->view('settings/modal');
    }

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

    public function managenews()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('news/managenews', $data);
        $this->load->view('general/footer');
        $this->load->view('news/modal');
    }

    public function editnews($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getNewsSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('news/editnews', $data);
        $this->load->view('general/footer');
    }

    public function managechangelogs()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('changelogs/managechangelogs', $data);
        $this->load->view('general/footer');
        $this->load->view('changelogs/modal');
    }

    public function editchangelogs($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getChangelogSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('changelogs/editchangelogs', $data);
        $this->load->view('general/footer');
    }

    public function managepages()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('page/managepages', $data);
        $this->load->view('general/footer');
        $this->load->view('page/modal');
    }

    public function editpages($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getPagesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('page/editpages', $data);
        $this->load->view('general/footer');
    }

    public function managefaq()
    {
        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('faq/managefaq', $data);
        $this->load->view('general/footer');
        $this->load->view('faq/modal');
    }

    public function editfaq($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getFaqSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'tiny' => $tiny,
        );

        $this->load->view('general/header');
        $this->load->view('faq/editfaq', $data);
        $this->load->view('general/footer');
    }

    public function managegroups()
    {
        $this->load->view('general/header');
        $this->load->view('store/managegroups');
        $this->load->view('general/footer');
        $this->load->view('store/modal');
    }

    public function manageitems()
    {
        $this->load->view('general/header');
        $this->load->view('store/manageitems');
        $this->load->view('general/footer');
        $this->load->view('store/modal');
    }

    public function edititems($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getItemSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data['idlink'] = $id;

        $this->load->view('general/header');
        $this->load->view('store/edititems', $data);
        $this->load->view('general/footer');
    }

    public function editgroups($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getItemSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data['idlink'] = $id;

        $this->load->view('general/header');
        $this->load->view('store/editgroups', $data);
        $this->load->view('general/footer');
    }

    public function donate()
    {
        $this->load->view('general/header');
        $this->load->view('donate/index');
        $this->load->view('general/footer');
    }

    public function managecategories()
    {
        $this->load->view('general/header');
        $this->load->view('forum/managecategories');
        $this->load->view('general/footer');
    }

    public function manageforums()
    {

        $this->load->view('general/header');
        $this->load->view('forum/manageforums');
        $this->load->view('general/footer');
        $this->load->view('forum/modal');
    }

    public function managetopsites()
    {
        $this->load->view('general/header');
        $this->load->view('vote/managetopsites');
        $this->load->view('general/footer');
        $this->load->view('vote/modal');
    }

    public function edittopsite($id)
    {
        if (is_null($id) || empty($id))
            redirect(base_url(),'refresh');

        if ($this->admin_model->getTopsitesSpecifyRows($id) < 1)
            redirect(base_url(),'refresh');

        $data['idlink'] = $id;

        $this->load->view('general/header');
        $this->load->view('vote/edittopsite', $data);
        $this->load->view('general/footer');
    }

    public function checkSoap()
    {
        foreach ($this->m_data->getRealms()->result() as $charsMultiRealm) {

            echo $this->m_soap->commandSoap('.server info', $charsMultiRealm->console_username, $charsMultiRealm->console_password, $charsMultiRealm->console_hostname, $charsMultiRealm->console_port, $charsMultiRealm->emulator).'<br>';
        }
    }
}
