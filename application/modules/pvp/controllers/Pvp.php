<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getPVPStatus())
            redirect(base_url(),'refresh');

        $this->load->model('pvp_model');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_pvp_statistics'),
            'nav_arena_statistics' => $this->lang->line('nav_arena_statistics'),
            'lang_2v2' => $this->lang->line('arena_top_2v2'),
            'lang_3v3' => $this->lang->line('arena_top_3v3'),
            'lang_5v5' => $this->lang->line('arena_top_5v5'),
            'column_team_name' => $this->lang->line('column_team_name'),
            'column_members' => $this->lang->line('column_members'),
            'column_rating' => $this->lang->line('column_rating'),
            //general
            'realms' => $this->m_data->getRealms()->result(),
        );

        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
}
