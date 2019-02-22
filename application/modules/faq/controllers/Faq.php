<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getFaq())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Faq'))
            redirect(base_url(),'refresh');

        $this->load->model('faq_model');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_faq'),
        );

        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
}
