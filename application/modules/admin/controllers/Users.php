<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.users');

        $inputSearch = $this->input->get('search');
        $inputPage   = $this->input->get('page');
        $page        = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate
        $filters = ['search' => trim(xss_clean($inputSearch))];

        $this->pagination->initialize([
            'base_url'   => site_url('admin/users'),
            'total_rows' => $this->user_model->total_paginate($filters),
            'per_page'   => $perPage
        ]);

        $data = [
            'users'      => $this->user_model->paginate($perPage, $offset, $filters),
            'pagination' => $this->pagination->create_links(),
            'search'     => $inputSearch
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('users/index', $data);
    }

    /**
     * View user
     *
     * @param int $id
     * @return string
     */
    public function view($id = null)
    {
        require_permission('view.users');

        $user = $this->user_model->find(['id' => $id]);

        if (empty($user)) {
            show_404();
        }

        $data = [
            'user'          => $user,
            'is_banned'     => $this->ban_model->is_user_banned($id),
            'is_restricted' => in_array($user->role, Role_model::RESTRICTED_ROLES),
            'roles'         => $this->role_model->unrestricted_roles()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('users/view', $data);
    }

    /**
     * Update user
     *
     * @param int $id
     * @return string
     */
    public function update($id = null)
    {
        require_permission('edit.users');

        $user = $this->user_model->find(['id' => $id]);

        if (empty($user)) {
            show_404();
        }

        $this->form_validation->set_rules('nickname', lang('nickname'), 'trim|alpha_dash|max_length[16]');
        $this->form_validation->set_rules('email', lang('email'), 'trim|valid_email');

        if (! in_array($user->role, Role_model::RESTRICTED_ROLES)) {
            $this->form_validation->set_rules('role', lang('role'), 'trim|is_natural');
        }

        $this->form_validation->set_rules('dp', lang('donation_points'), 'trim|is_natural');
        $this->form_validation->set_rules('vp', lang('voting_points'), 'trim|is_natural');

        if ($this->form_validation->run()) {
            $nickname = $this->input->post('nickname');
            $email    = $this->input->post('email');
            $dp       = $this->input->post('dp');
            $vp       = $this->input->post('vp');

            $setUser = [];
            $setLog  = [];

            if ($user->nickname !== $nickname) {
                if ($this->user_model->user_exists($nickname, 'nickname') || $this->user_token_model->userdata_exists($nickname, 'nickname')) {
                    $this->session->set_flashdata('error', lang('alert_nickname_exists'));
                    redirect(site_url('admin/users/view/' . $id));
                }

                $setUser['nickname'] = $nickname;

                $setLog['previous nickname'] = $user->nickname;
                $setLog['new nickname'] = $nickname;
            }

            if ($user->email !== $email) {
                if ($this->server_auth_model->account_exists($email, 'email') || $this->user_token_model->userdata_exists($email, 'email')) {
                    $this->session->set_flashdata('error', lang('alert_email_exists'));
                    redirect(site_url('admin/users/view/' . $id));
                }

                if ($this->ban_model->is_email_banned($email)) {
                    $this->session->set_flashdata('error', lang('alert_email_blocked'));
                    redirect(site_url('admin/users/view/' . $id));
                }

                $auth = $this->server_auth_model->connect();

                $auth->update('account', ['email' => $email], ['id' => $id]);

                // Update BNET account if BNET is enabled and the table exists
                if (config_item('app_emulator_bnet') && $auth->table_exists('battlenet_accounts')) {
                    $auth->update('battlenet_accounts', ['email' => $email], ['id' => $id]);
                }

                $setUser['email'] = $email;

                $setLog['previous email'] = $user->email;
                $setLog['new email'] = $email;
            }

            if (! in_array($user->role, Role_model::RESTRICTED_ROLES)) {
                $role = $this->input->post('role');

                if ($user->role !== $role) {
                    $setUser['role'] = $role;

                    $setLog['previous role'] = $this->role_model->get_name($user->role);
                    $setLog['new role'] = $this->role_model->get_name($role);
                }
            }

            if ($user->dp !== $dp) {
                $setUser['dp'] = $dp;

                $setLog['previous dp'] = $user->dp;
                $setLog['current dp'] = $dp;
            }

            if ($user->vp !== $vp) {
                $setUser['vp'] = $vp;

                $setLog['previous vp'] = $user->vp;
                $setLog['current vp'] = $vp;
            }

            if ($setUser === []) {
                $this->session->set_flashdata('info', lang('alert_user_not_updated'));
                redirect(site_url('admin/users/view/' . $id));
            }

            $this->user_model->update($setUser, ['id' => $id]);

            $this->log_model->create('user', 'edit', "Edited the user {$user->username}", $setLog);

            $this->session->set_flashdata('success', lang('alert_user_updated'));
            redirect(site_url('admin/users/view/' . $id));
        } else {
            return $this->view($id);
        }
    }

    /**
     * View user characters
     *
     * @param int $id
     * @return string
     */
    public function view_characters($id = null)
    {
        require_permission('view.users');

        $user = $this->user_model->find(['id' => $id]);

        if (empty($user)) {
            show_404();
        }

        $realms = $this->realm_model->find_all();
        $list   = [];

        foreach ($realms as $realm) {
            $list[] = (object) [
                'realm'      => $realm->realm_name,
                'characters' => $this->server_characters_model->all_characters($realm->id, $user->id)
            ];
        }

        $data = [
            'user' => $user,
            'list' => $list
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('users/view_characters', $data);
    }

    /**
     * View user logs
     *
     * @param int $id
     * @return string
     */
    public function view_logs($id = null)
    {
        require_permission('view.users');

        $user = $this->user_model->find(['id' => $id]);

        if (empty($user)) {
            show_404();
        }

        $inputSearch = $this->input->get('search');
        $inputPage   = $this->input->get('page');
        $page        = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate
        $filters = [
            'user'   => $id,
            'search' => trim(xss_clean($inputSearch))
        ];

        $this->pagination->initialize([
            'base_url'   => site_url('admin/users/view/' . $id . '/logs'),
            'total_rows' => $this->log_model->total_paginate($filters),
            'per_page'   => $perPage
        ]);

        $data = [
            'user'       => $user,
            'logs'       => $this->log_model->paginate($perPage, $offset, $filters),
            'pagination' => $this->pagination->create_links(),
            'search'     => $inputSearch
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('users/view_logs', $data);
    }
}
