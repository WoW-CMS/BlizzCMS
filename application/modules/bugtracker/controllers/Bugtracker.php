<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugtracker extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getBugtrackerStatus())
            redirect(base_url(),'refresh');

        if(!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Bugtracker'))
            redirect(base_url(),'refresh');
        
        $this->load->config('bugtracker');
        $this->load->model('bugtracker_model');
    }

    public function index()
    {

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_id')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'pagetitle' => $this->lang->line('nav_bugtracker'),
            'tiny' => $tiny,
        );

        $config['total_rows'] = $this->bugtracker_model->getAllBugs();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';
 
        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(3);
            $config['base_url'] = base_url().'bugtracker/index/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->bugtracker_model->setPageNumber($this->pagination->per_page);
            $this->bugtracker_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['bugtrackerList'] = $this->bugtracker_model->bugtrackerList();
        }

        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
        $this->load->view('modal');
    }

    public function post($id)
    {
        if (empty($id) || is_null($id) || $id == '0')
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getBugtrackerStatus())
            redirect(base_url(),'refresh');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_bugtracker'),
        );

        $this->load->view('header', $data);
        $this->load->view('post', $data);
        $this->load->view('footer');
    }

    public function create()
    {
        $title = $_POST['bug_title'];
        $type = $_POST['bug_type'];
        $desc = $_POST['bug_description'];
        $url = $_POST['bug_url'];

        $this->bugtracker_model->insertIssue($title, $type, $desc, $url);
    }
}
