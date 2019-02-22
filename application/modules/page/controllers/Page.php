<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        $this->load->model('page_model');
    }

    public function index($id)
    {
        if (empty($id) || is_null($id) || $id == '0')
            redirect(base_url(),'refresh');

        if ($this->page_model->getVerifyExist($id) < 1)
            redirect(base_url(),'refresh');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->page_model->getName($id),
        );
        
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
}
