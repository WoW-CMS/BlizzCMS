<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getChangelogsStatus())
            redirect(base_url(),'refresh');

        $this->load->model('changelogs_model');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_changelogs'),
        );
        
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
}
