<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_login();

        $this->load->language('user');
    }

    public function index()
    {
        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate
        $filters = [
            'user'   => $this->session->userdata('id'),
            'object' => 'user',
            'event'  => ['login', 'logout']
        ];

        $this->pagination->initialize([
            'base_url'   => site_url('user/security'),
            'total_rows' => $this->log_model->total_paginate($filters),
            'per_page'   => $perPage
        ]);

        $data = [
            'logs'       => $this->log_model->paginate($perPage, $offset, $filters),
            'pagination' => $this->pagination->create_links()
        ];

        $this->template->title(lang('user_panel'), config_item('app_name'));

        $this->template->build('security/index', $data);
    }

    public function change_email()
    {
        require_permission('editown.email');

        $this->template->title(lang('user_panel'), config_item('app_name'));

        $this->form_validation->set_rules('new_email', lang('new_email'), 'trim|required|valid_email|is_user_field_unique[email]');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $newEmail = $this->input->post('new_email', true);
            $password = $this->input->post('password');
            $user     = user();

            if (! password_verify($password, $user->password)) {
                $this->session->set_flashdata('error', lang('alert_password_invalid'));
                redirect(site_url('user/security/email'));
            }

            if ($this->ban_model->is_email_banned($newEmail)) {
                $this->session->set_flashdata('error', lang('alert_email_blocked'));
                redirect(site_url('user/security/email'));
            }

            $auth = $this->server_auth_model->connect();

            $auth->update('account', ['email' => $newEmail], ['id' => $user->id]);

            // Update BNET account if BNET is enabled and the table exists
            if (config_item('app_emulator_bnet') && $auth->table_exists('battlenet_accounts')) {
                $auth->update('battlenet_accounts', [
                    'email'         => $newEmail,
                    'sha_pass_hash' => client_pwd_hash($newEmail, $password, 'bnet')
                ], ['id' => $user->id]);
            }

            $this->user_model->update(['email' => $newEmail], ['id' => $user->id]);

            $this->log_model->create('user', 'change', 'Changed his email', [
                'from' => $user->email,
                'to'   => $newEmail
            ]);

            $this->session->set_flashdata('success', lang('alert_own_email_changed'));
            redirect(site_url('user/security/email'));
        } else {
            $this->template->build('security/change_email');
        }
    }

    public function change_password()
    {
        require_permission('editown.password');

        $this->template->title(lang('user_panel'), config_item('app_name'));

        $this->form_validation->set_rules('current_password', lang('current_password'), 'trim|required');
        $this->form_validation->set_rules('new_password', lang('new_password'), 'trim|required|min_length[8]|max_length[32]|differs[password]');
        $this->form_validation->set_rules('confirm_new_password', lang('confirm_new_password'), 'trim|required|min_length[8]|max_length[32]|matches[new_password]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $password    = $this->input->post('current_password');
            $newPassword = $this->input->post('new_password');
            $user        = user();

            if (! password_verify($password, $user->password)) {
                $this->session->set_flashdata('error', lang('alert_password_invalid'));
                redirect(site_url('user/security/password'));
            }

            $emulator = config_item('app_emulator');
            $auth     = $this->server_auth_model->connect();

            switch ($emulator) {
                case 'azeroth':
                    $salt = random_bytes(32);
                    $setUser = [
                        'salt'        => $salt,
                        'verifier'    => client_pwd_hash($user->username, $newPassword, 'srp6', $salt),
                        'session_key' => null
                    ];
                    break;

                case 'trinity':
                    $salt = random_bytes(32);
                    $setUser = [
                        'salt'             => $salt,
                        'verifier'         => client_pwd_hash($user->username, $newPassword, 'srp6', $salt),
                        'session_key_auth' => null,
                        'session_key_bnet' => null
                    ];
                    break;

                case 'cmangos':
                    $salt = strtoupper(bin2hex(random_bytes(32)));
                    $setUser = [
                        'sessionkey' => '',
                        'v'          => client_pwd_hash($user->username, $newPassword, 'hex', $salt),
                        's'          => $salt
                    ];
                    break;

                case 'mangos':
                case 'trinity_sha':
                    $setUser = [
                        'sha_pass_hash' => client_pwd_hash($user->username, $newPassword),
                        'sessionkey'    => '',
                        'v'             => '',
                        's'             => ''
                    ];
                    break;
            }

            $auth->update('account', $setUser, ['id' => $user->id]);

            // Update BNET account if BNET is enabled and the table exists
            if (config_item('app_emulator_bnet') && $auth->table_exists('battlenet_accounts')) {
                $auth->update('battlenet_accounts', [
                    'sha_pass_hash' => client_pwd_hash($user->email, $newPassword, 'bnet')
                ], ['id' => $user->id]);
            }

            $this->user_model->update(['password' => $newPassword], ['id' => $user->id]);

            $this->log_model->create('user', 'change', 'Changed his password');

            $this->session->set_flashdata('success', lang('alert_own_password_changed'));
            redirect(site_url('user/security/password'));
        } else {
            $this->template->build('security/change_password');
        }
    }
}
