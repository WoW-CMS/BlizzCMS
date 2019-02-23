<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getForumStatus())
            redirect(base_url(),'refresh');

        $this->load->model('forum_model');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_forums'),
        );
        
        $this->load->view('header', $data);
        $this->load->view('index');
        $this->load->view('footer');
    }

    public function category($id)
    {
        if (empty($id) || is_null($id))
            redirect(base_url('forum'),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_forums'),
            'tiny' => $tiny,
        );

        if ($this->forum_model->getType($id) == 2 && $this->m_data->isLogged())
            if ($this->m_data->getRank($this->session->userdata('fx_sess_id')) > 0) { }
        else
            redirect(base_url('forum'),'refresh');

        $this->load->view('header', $data);;
        $this->load->view('category', $data);
        $this->load->view('footer');
        $this->load->view('modal');
    }

    public function topic($id)
    {
        if (empty($id) || is_null($id))
            redirect(base_url('forum'),'refresh');

        if ($this->forum_model->getType($this->forum_model->getTopicForum($id)) == 2 && $this->m_data->isLogged())
            if ($this->m_data->getRank($this->session->userdata('fx_sess_id')) > 0) { }
        else
            redirect(base_url('forum'),'refresh');

        if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel')))
            $tiny = $this->m_general->tinyEditor('pluginsADM', 'toolbarADM');
        else
            $tiny = $this->m_general->tinyEditor('pluginsUser', 'toolbarUser');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_forums'),
            'tiny' => $tiny,
        );
        
        $this->load->view('header', $data);
        $this->load->view('topic', $data);
        $this->load->view('footer');
        $this->load->view('modal');
    }

    public function newTopic($idlink)
    {
        $title = $_POST['topic_title'];
        $description = $_POST['topic_description'];

        if (isset($_POST['topic_locked']))
            $locked = '1';
        else
            $locked = '0';

        if (isset($_POST['topic_pinned']))
            $pinned = '1';
        else
            $pinned = '0';

        $this->forum_model->insertTopic($idlink, $title, $this->session->userdata('fx_sess_id'), $description, $locked, $pinned);
    }
}
