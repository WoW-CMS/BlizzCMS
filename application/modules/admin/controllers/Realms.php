<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Realms extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.realms');

        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'    => site_url('admin/realms'),
            'total_rows'  => $this->realm_model->total_paginate(),
            'per_page'    => $perPage
        ]);

        $data = [
            'realms'     => $this->realm_model->paginate($perPage, $offset),
            'pagination' => $this->pagination->create_links()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('realms/index', $data);
    }

    public function add()
    {
        require_permission('add.realms');

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('realm_name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('realm_capacity', lang('maximum_capacity'), 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('char_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('char_username', lang('username'), 'trim|required|alpha_dash|max_length[32]');
        $this->form_validation->set_rules('char_password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('char_database', lang('database'), 'trim|required|alpha_dash|max_length[64]');
        $this->form_validation->set_rules('char_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('console_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('console_username', lang('username'), 'trim|required');
        $this->form_validation->set_rules('console_password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('console_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('realm_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('realm_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->realm_model->insert([
                'realm_name'       => $this->input->post('realm_name'),
                'realm_capacity'   => $this->input->post('realm_capacity'),
                'char_hostname'    => $this->input->post('char_hostname'),
                'char_username'    => $this->input->post('char_username'),
                'char_password'    => encrypt($this->input->post('char_password')),
                'char_database'    => $this->input->post('char_database'),
                'char_port'        => $this->input->post('char_port'),
                'console_hostname' => $this->input->post('console_hostname'),
                'console_username' => $this->input->post('console_username'),
                'console_password' => encrypt($this->input->post('console_password')),
                'console_port'     => $this->input->post('console_port'),
                'realm_hostname'   => $this->input->post('realm_hostname'),
                'realm_port'       => $this->input->post('realm_port')
            ]);

            $realmId = $this->db->insert_id();

            $this->log_model->create('realm', 'add', 'Added a realm', [
                'realm' => $this->input->post('realm_name')
            ], 'admin/realms/edit/' . $realmId);

            $this->session->set_flashdata('success', lang('alert_realm_added'));
            redirect(site_url('admin/realms/edit/' . $realmId));
        } else {
            $this->template->build('realms/add');
        }
    }

    /**
     * Edit realm
     *
     * @param int $id
     * @return string|void
     */
    public function edit($id = null)
    {
        require_permission('edit.realms');

        $realm = $this->realm_model->find(['id' => $id]);

        if (empty($realm)) {
            show_404();
        }

        $data = [
            'realm' => $realm
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('realm_name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('realm_capacity', lang('maximum_capacity'), 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('char_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('char_username', lang('username'), 'trim|required|alpha_dash|max_length[32]');
        $this->form_validation->set_rules('char_password', lang('password'), 'trim');
        $this->form_validation->set_rules('char_database', lang('database'), 'trim|required|alpha_dash|max_length[64]');
        $this->form_validation->set_rules('char_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('console_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('console_username', lang('username'), 'trim|required');
        $this->form_validation->set_rules('console_password', lang('password'), 'trim');
        $this->form_validation->set_rules('console_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('realm_hostname', lang('hostname'), 'trim|required|alpha_period');
        $this->form_validation->set_rules('realm_port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $realm = [
                'realm_name'       => $this->input->post('realm_name'),
                'realm_capacity'   => $this->input->post('realm_capacity'),
                'char_hostname'    => $this->input->post('char_hostname'),
                'char_username'    => $this->input->post('char_username'),
                'char_database'    => $this->input->post('char_database'),
                'char_port'        => $this->input->post('char_port'),
                'console_hostname' => $this->input->post('console_hostname'),
                'console_username' => $this->input->post('console_username'),
                'console_port'     => $this->input->post('console_port'),
                'realm_hostname'   => $this->input->post('realm_hostname'),
                'realm_port'       => $this->input->post('realm_port')
            ];

            if (! empty($this->input->post('char_password'))) {
                $realm['char_password'] = encrypt($this->input->post('char_password'));
            }

            if (! empty($this->input->post('console_password'))) {
                $realm['console_password'] = encrypt($this->input->post('console_password'));
            }

            $this->realm_model->update($realm, ['id' => $id]);

            $this->log_model->create('realm', 'edit', 'Edited a realm', [
                'realm' => $this->input->post('realm_name')
            ], 'admin/realms/edit/' . $id);

            $this->session->set_flashdata('success', lang('alert_realm_updated'));
            redirect(site_url('admin/realms/edit/' . $id));
        } else {
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
        require_permission('delete.realms');

        $realm = $this->realm_model->find(['id' => $id]);

        if (empty($realm)) {
            show_404();
        }

        $this->realm_model->delete(['id' => $id]);

        $this->log_model->create('realm', 'delete', 'Deleted a realm', [
            'realm' => $realm->realm_name
        ]);

        $this->session->set_flashdata('success', lang('alert_realm_deleted'));
        redirect(site_url('admin/realms'));
    }

    public function check_soap($id = null)
    {
        $realm = $this->realm_model->find(['id' => $id]);

        if (empty($realm)) {
            show_404();
        }

        $data = [
            'result' => $this->realm_model->execute_command($id, '.server info', true)
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('realms/check_soap', $data);
    }
}
