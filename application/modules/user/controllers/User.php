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
        if (!$this->m_modules->getLoginStatus())
            redirect(base_url(),'refresh');

        if ($this->m_data->isLogged())
            redirect(base_url(),'refresh');

        $data = array(
          'pagetitle' => $this->lang->line('tab_login'),
        );

        $this->load->view('header', $data);

        if ($this->m_general->getExpansionAction() == 1)
        {
            $data = array(
                'recapKey' => $this->config->item('recaptcha_sitekey'),
                'lang' => $this->lang->lang(),
            );
            $this->load->view('login1', $data);
        }
        else
        {
            $data = array(
                'recapKey' => $this->config->item('recaptcha_sitekey'),
                'lang' => $this->lang->lang(),
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
        echo $this->user_model->checkloginbattle($email, $password);
    }

    public function register()
    {
        if (!$this->m_modules->getRegisterStatus())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('tab_register'),
            'recapKey' => $this->config->item('recaptcha_sitekey'),
            'lang' => $this->lang->lang(),
        );

        $this->load->view('header', $data);
        $this->load->view('register', $data);
        $this->load->view('footer');
    }

    public function newaccount()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        echo $this->user_model->insertRegister($username, $email, $password, $repassword);
    }

    public function logout()
    {
        $this->m_data->logout();
    }

    public function recovery()
    {
        if (!$this->m_modules->getRecoveryStatus())
            redirect(base_url(),'refresh');

        if ($this->m_data->isLogged())
            redirect(base_url(),'refresh');

        $data = array(
            'pagetitle' => $this->lang->line('tab_reset'),
            'recapKey' => $this->config->item('recaptcha_sitekey'),
            'lang' => $this->lang->lang(),
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

    public function activate($key)
    {
        echo $this->user_model->activateAccount($key);
    }

    public function panel()
    {
        if (!$this->m_modules->getUCPStatus())
            redirect(base_url(),'refresh');

        if (!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        $data = array(
            "pagetitle" => $this->lang->line('tab_account'),
            'lang' => $this->lang->lang(),
        );

        $this->load->view('header', $data);
        $this->load->view('panel', $data);
        $this->load->view('footer');
        $this->load->view('modal');
    }

    public function settings()
    {
        if (!$this->m_modules->getUCPStatus())
            redirect(base_url(),'refresh');

        if (!$this->m_data->isLogged())
            redirect(base_url(),'refresh');

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        $data = array(
            "pagetitle" => $this->lang->line('tab_account'),
            'lang' => $this->lang->lang(),
        );

        $this->load->view('header', $data);
        $this->load->view('settings', $data);
        $this->load->view('footer');
        $this->load->view('modal');
    }

    public function newpass()
    {
        $oldpass = $this->input->post('oldpass');
        $newpass = $this->input->post('newpass');
        $renewpass = $this->input->post('renewpass');
        echo $this->user_model->changePassword($oldpass, $newpass, $renewpass);
    }

    public function newemail()
    {
        $newemail = $this->input->post('newemail');
        $renewemail = $this->input->post('renewemail');
        $password = $this->input->post('password');
        echo $this->user_model->changeEmail($newemail, $renewemail, $password);
    }
}
