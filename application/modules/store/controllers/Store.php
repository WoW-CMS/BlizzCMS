<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getStatusStore())
            redirect(base_url(),'refresh');

        if (!$this->m_data->isLogged())
            redirect(base_url('login'),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Store'))
            redirect(base_url(),'refresh');

        $this->load->model('store_model');
    }

    public function index($id = '')
    {
        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_store'),
        );

        $this->load->config('store');

        $this->load->view('header', $data);

        if($this->config->item('shopStyle') == 1)
            $this->load->view('index1', $data);
        else
            $this->load->view('index2', $data);

        $this->load->view('footer');
    }

    public function cart($id)
    {
        if (!$this->m_data->isLogged())
            redirect(base_url('login'),'refresh');

        if ($this->store_model->getExistItem($id) < 1)
            redirect(base_url('store'),'refresh');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_cart'),
        );

        $this->load->view('header', $data);

        if (isset($_GET['tp']))
        {
            $mode = $_GET['tp'];

            if ($mode != 'vp' && $mode != 'dp')
                redirect(base_url('store'),'refresh');

            if ($mode == "vp")
                $this->store_model->getVPTrue($id);
            if ($mode == "dp")
                $this->store_model->getDPTrue($id);

            $data['idlink'] = $id;
            $this->load->view('cart', $data);
        }
        else
            redirect(base_url('store'),'refresh');

        $this->load->view('footer');
    }
}
