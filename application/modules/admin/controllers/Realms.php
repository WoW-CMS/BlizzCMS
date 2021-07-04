<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Realms extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->language('admin');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $data = [
            'realms' => $this->realms->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('realms/index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('max_cap', lang('maximum_capacity'), 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('char_host', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('char_user', lang('username'), 'trim|required|alpha_dash|max_length[32]');
            $this->form_validation->set_rules('char_pass', lang('password'), 'trim|required|max_length[32]');
            $this->form_validation->set_rules('char_db', lang('database'), 'trim|required|alpha_dash|max_length[64]');
            $this->form_validation->set_rules('char_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('console_host', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('console_user', lang('username'), 'trim|required');
            $this->form_validation->set_rules('console_pass', lang('password'), 'trim|required');
            $this->form_validation->set_rules('console_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('realm_host', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('realm_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('realms/create');
            }
            else
            {
                $this->realms->create([
                    'name'             => $this->input->post('name', TRUE),
                    'max_cap'          => $this->input->post('max_cap'),
                    'char_hostname'    => $this->input->post('char_host'),
                    'char_username'    => $this->input->post('char_user'),
                    'char_password'    => encrypt($this->input->post('char_pass')),
                    'char_database'    => $this->input->post('char_db'),
                    'char_port'        => $this->input->post('char_port'),
                    'console_hostname' => $this->input->post('console_host'),
                    'console_username' => $this->input->post('console_user'),
                    'console_password' => encrypt($this->input->post('console_pass')),
                    'console_port'     => $this->input->post('console_port'),
                    'realm_hostname'   => $this->input->post('realm_host'),
                    'realm_port'       => $this->input->post('realm_port')
                ]);

                $this->session->set_flashdata('success', lang('realm_created'));
                redirect(site_url('admin/realms/create'));
            }
        }
        else
        {
            $this->template->build('realms/create');
        }
    }

    /**
     * Edit realm
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $realm = $this->realms->find(['id' => $id]);

        if (empty($realm))
        {
            show_404();
        }

        $data = [
            'realm' => $realm
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('max_cap', lang('maximum_capacity'), 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('char_host', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('char_user', lang('username'), 'trim|required|alpha_dash|max_length[32]');
            $this->form_validation->set_rules('char_pass', lang('password'), 'trim|max_length[32]');
            $this->form_validation->set_rules('char_db', lang('database'), 'trim|required|alpha_dash|max_length[64]');
            $this->form_validation->set_rules('char_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('console_host', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('console_user', lang('username'), 'trim|required');
            $this->form_validation->set_rules('console_pass', lang('password'), 'trim');
            $this->form_validation->set_rules('console_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('realm_host', lang('hostname'), 'trim|required');
            $this->form_validation->set_rules('realm_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('realms/edit', $data);
            }
            else
            {
                $realm = [
                    'name'             => $this->input->post('name', TRUE),
                    'max_cap'          => $this->input->post('max_cap'),
                    'char_hostname'    => $this->input->post('char_host'),
                    'char_username'    => $this->input->post('char_user'),
                    'char_database'    => $this->input->post('char_db'),
                    'char_port'        => $this->input->post('char_port'),
                    'console_hostname' => $this->input->post('console_host'),
                    'console_username' => $this->input->post('console_user'),
                    'console_port'     => $this->input->post('console_port'),
                    'realm_hostname'   => $this->input->post('realm_host'),
                    'realm_port'       => $this->input->post('realm_port')
                ];

                if (! empty($this->input->post('char_pass')))
                {
                    $realm['char_password'] = encrypt($this->input->post('char_pass'));
                }

                if (! empty($this->input->post('console_pass')))
                {
                    $realm['console_password'] = encrypt($this->input->post('console_pass'));
                }

                $this->realms->update($realm, ['id' => $id]);

                $this->session->set_flashdata('success', lang('realm_updated'));
                redirect(site_url('admin/realms/edit/' . $id));
            }
        }
        else
        {
            $this->template->build('realms/edit', $data);
        }
    }

    /**
     * Delete realm
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $realm = $this->realms->find(['id' => $id]);

        if (empty($realm))
        {
            show_404();
        }

        $this->realms->delete(['id' => $id]);

        $this->session->set_flashdata('success', lang('realm_deleted'));
        redirect(site_url('admin/realms'));
    }

    public function check_soap($id = null)
    {
        $realm = $this->realms->find(['id' => $id]);

        if (empty($realm))
        {
            show_404();
        }

        $data = [
            'check' => $this->realms->send_command($id, '.server info')
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('realms/check_soap', $data);
    }
}