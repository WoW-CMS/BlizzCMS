<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        if (!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));
    }

    public function login()
    {
        if (!$this->m_modules->getStatusLogin())
            redirect(base_url(),'refresh');

        if ($this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Login'))
            redirect(base_url(),'refresh');

        $data['pagetitle'] = $this->lang->line('nav_login');

        $this->load->view('header', $data);

        if ($this->m_general->getExpansionAction() == 1)
        {
            $data = array(
                "username_form" => array(
                    'id' => 'login_username',
                    'name' => 'login_username',
                    'class' => 'uk-input',
                    'required' => 'required',
                    'placeholder' => $this->lang->line('form_username'),
                    'type' => 'text'),

                "password_form" => array(
                    'id' => 'login_password',
                    'name' => 'login_password',
                    'class' => 'uk-input',
                    'required' => 'required',
                    'placeholder' => $this->lang->line('form_password'),
                    'type' => 'password'),

                "submit_form" => array(
                    'id' => 'button_log',
                    'name' => 'button_log',
                    'value' => $this->lang->line('button_login'),
                    'class' => 'uk-button uk-button-default uk-width-1-1 uk-width-1-6@m'),
                'recapKey' => $this->config->item('recaptcha_sitekey'),
            );

            $this->load->view('login1', $data);
        }
        else
        {
            $data = array(
                "email_form" => array(
                    'id' => 'login_email',
                    'name' => 'login_email',
                    'class' => 'uk-input',
                    'required' => 'required',
                    'placeholder' => $this->lang->line('form_email'),
                    'type' => 'email'),

                "password_form" => array(
                    'id' => 'login_password',
                    'name' => 'login_password',
                    'class' => 'uk-input',
                    'required' => 'required',
                    'placeholder' => $this->lang->line('form_password'),
                    'type' => 'password'),

                "submit_form" => array(
                    'id' => 'button_log',
                    'name' => 'button_log',
                    'value' => $this->lang->line('button_login'),
                    'class' => 'uk-button uk-button-default uk-width-1-1 uk-width-1-6@m'),
                'recapKey' => $this->config->item('recaptcha_sitekey'),
            );

            $this->load->view('login2', $data);
        }

        $this->load->view('footer');
    }

    public function verify1()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        echo $this->user_model->checklogin($username, $password);
    }

    public function verify2()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        echo $this->user_model->checkloginbattle($username, $password);
    }

    public function register()
    {
        if (!$this->m_modules->getStatusRegister())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Register'))
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('nav_register'),
            'recapKey' => $this->config->item('recaptcha_sitekey'),
        );

        $this->load->view('header', $data);
        $this->load->view('register', $data);
        $this->load->view('footer');
    }

    public function newaccount()
    {
        $country = $this->input->post('country');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        echo $this->user_model->insertRegister($username, $email, $password, $repassword, $country);
    }

    public function logout()
    {
        $this->m_data->logout();
    }

    public function recovery()
    {
        if (!$this->m_modules->getForgotPassword())
            redirect(base_url(),'refresh');

        if ($this->m_data->isLogged())
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('nav_reset'),
            'recapKey' => $this->config->item('recaptcha_sitekey'),
        );

        $this->load->view('header', $data);
        $this->load->view('recovery', $data);
        $this->load->view('footer');
    }

    public function forgotpassword()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        echo $this->user_model->sendpassword($username, $email);
    }

    public function panel()
    {
        if (!$this->m_modules->getStatusUCP())
            redirect(base_url(),'refresh');

        if (!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMyPermissions('Permission_Panel'))
            redirect(base_url(),'refresh');

        $data = array(
            "pagetitle" => $this->lang->line('nav_account'),
        );
        
        $this->load->view('header', $data);
        $this->load->view('panel', $data);
        $this->load->view('footer');
        $this->load->view('modal');
    }
}
