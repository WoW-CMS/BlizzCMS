<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Bans extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.bans');

        $inputSearch = $this->input->get('search');
        $inputPage   = $this->input->get('page');
        $page        = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('admin/bans'),
            'total_rows' => $this->ban_model->total_paginate(Ban_model::TYPE_USER, trim(xss_clean($inputSearch))),
            'per_page'   => $perPage
        ]);

        $data = [
            'bans'       => $this->ban_model->paginate($perPage, $offset, Ban_model::TYPE_USER, trim(xss_clean($inputSearch))),
            'pagination' => $this->pagination->create_links(),
            'search'     => $inputSearch
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('bans/index', $data);
    }

    public function add_user()
    {
        require_permission('add.bans');

        $data = [
            'user' => $this->input->get('user')
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        if ($this->input->method() === 'post') {
            $inputs = $this->input->post(null, true);

            $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_numeric');
            $this->form_validation->set_rules('type', lang('type'), 'trim|required|in_list[0,1]');

            if ($inputs['type'] === '1') {
                $this->form_validation->set_rules('value', lang('value'), 'trim|required|is_natural_no_zero|less_than_equal_to[365]');
                $this->form_validation->set_rules('value_option', lang('option'), 'trim|required|in_list[D,M,Y]');
            }

            $this->form_validation->set_rules('reason', lang('reason'), 'trim|required');

            $this->form_validation->set_data($inputs);

            if ($this->form_validation->run()) {
                $user = user(null, user_id($inputs['username']));

                if (empty($user)) {
                    $this->session->set_flashdata('error', lang('alert_user_not_found'));
                    redirect(site_url('admin/bans/add'));
                }

                if (in_array($user->role, [Role_model::ROLE_ADMIN])) {
                    $this->session->set_flashdata('error', lang('alert_user_cant_banned'));
                    redirect(site_url('admin/bans/add'));
                }

                if ($this->ban_model->is_user_banned($user->id)) {
                    $this->session->set_flashdata('error', lang('alert_user_already_banned'));
                    redirect(site_url('admin/bans/add'));
                }

                $set = [
                    'type'     => Ban_model::TYPE_USER,
                    'value'    => $user->id,
                    'reason'   => $inputs['reason'],
                    'start_at' => current_date()
                ];

                if ($inputs['type'] === '1') {
                    $set['end_at'] = add_timespan('now', 'P' . $inputs['value'] . $inputs['value_option']);
                }

                $this->ban_model->insert($set);

                $this->user_model->update([
                    'role' => Role_model::ROLE_BANNED
                ], ['id' => $user->id]);

                $this->log_model->create('ban', 'add', 'Added a user ban', [
                    'username' => $inputs['username']
                ]);

                $this->session->set_flashdata('success', lang('alert_user_ban_added'));
                redirect(site_url('admin/bans/add'));
            }
        }

        $this->template->build('bans/add_user', $data);
    }

    public function delete_user()
    {
        require_permission('delete.bans');

        $data = [
            'user' => $this->input->get('user')
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_numeric');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $username = $this->input->post('username');
            $userId   = user_id($username);

            if ($userId === 0) {
                $this->session->set_flashdata('error', lang('alert_user_not_found'));
                redirect(site_url('admin/bans/delete'));
            }

            if (! $this->ban_model->is_user_banned($userId)) {
                $this->session->set_flashdata('error', lang('alert_user_not_banned'));
                redirect(site_url('admin/bans/delete'));
            }

            $this->ban_model->delete([
                'type'  => Ban_model::TYPE_USER,
                'value' => $userId
            ]);

            $this->user_model->update([
                'role' => Role_model::ROLE_USER
            ], ['id' => $userId]);

            $this->log_model->create('ban', 'delete', 'Deleted a user ban', [
                'username' => $username
            ]);

            $this->session->set_flashdata('success', lang('alert_user_ban_deleted'));
            redirect(site_url('admin/bans/delete'));
        } else {
            $this->template->build('bans/delete_user', $data);
        }
    }

    /**
     * View ban details for user
     *
     * @param int $id
     * @return string
     */
    public function view_user($id = null)
    {
        $ban = $this->ban_model->find([
            'id'   => $id,
            'type' => Ban_model::TYPE_USER
        ]);

        if (empty($ban)) {
            show_404();
        }

        $data = [
            'ban' => $ban
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('bans/view_user', $data);
    }

    public function ips()
    {
        require_permission('view.bans');

        $inputSearch = $this->input->get('search');
        $inputPage   = $this->input->get('page');
        $page        = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('admin/bans/ips'),
            'total_rows' => $this->ban_model->total_paginate(Ban_model::TYPE_IP, trim(xss_clean($inputSearch))),
            'per_page'   => $perPage
        ]);

        $data = [
            'bans'       => $this->ban_model->paginate($perPage, $offset, Ban_model::TYPE_IP, trim(xss_clean($inputSearch))),
            'pagination' => $this->pagination->create_links(),
            'search'     => $inputSearch
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('bans/ips', $data);
    }

    public function add_ip()
    {
        require_permission('add.bans');

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('ip', lang('ip'), 'trim|required|valid_ip_address');
        $this->form_validation->set_rules('reason', lang('reason'), 'trim|required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $ip = $this->input->post('ip', true);

            $find = $this->ban_model->find([
                'value' => $ip,
                'type'  => Ban_model::TYPE_IP
            ]);

            if (! empty($find)) {
                $this->session->set_flashdata('error', lang('alert_ip_already_banned'));
                redirect(site_url('admin/bans/ips/add'));
            }

            $this->ban_model->insert([
                'type'     => Ban_model::TYPE_IP,
                'value'    => $ip,
                'reason'   => $this->input->post('reason', true),
                'start_at' => current_date()
            ]);

            $this->log_model->create('ban', 'add', 'Added a IP ban', [
                'ip' => $ip
            ]);

            $this->cache->delete('banned_ips');

            $this->session->set_flashdata('success', lang('alert_ip_ban_added'));
            redirect(site_url('admin/bans/ips/add'));
        } else {
            $this->template->build('bans/add_ip');
        }
    }

    public function delete_ip($id = null)
    {
        require_permission('delete.bans');

        $ip = $this->ban_model->find([
            'id'   => $id,
            'type' => Ban_model::TYPE_IP
        ]);

        if (empty($ip)) {
            show_404();
        }

        $this->ban_model->delete(['id' => $id]);

        $this->log_model->create('ban', 'delete', 'Deleted a IP ban', [
            'ip' => $ip->value
        ]);

        $this->cache->delete('banned_ips');

        $this->session->set_flashdata('success', lang('alert_ip_ban_deleted'));
        redirect(site_url('admin/bans/ips'));
    }

    /**
     * View ban details for IP
     *
     * @param int $id
     * @return string
     */
    public function view_ip($id = null)
    {
        $ban = $this->ban_model->find([
            'id'   => $id,
            'type' => Ban_model::TYPE_IP
        ]);

        if (empty($ban)) {
            show_404();
        }

        $data = [
            'ban' => $ban
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('bans/view_ip', $data);
    }

    public function emails()
    {
        require_permission('view.bans');

        $inputSearch = $this->input->get('search');
        $inputPage   = $this->input->get('page');
        $page        = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('admin/bans/emails'),
            'total_rows' => $this->ban_model->total_paginate(Ban_model::TYPE_EMAIL, trim(xss_clean($inputSearch))),
            'per_page'   => $perPage
        ]);

        $data = [
            'bans'       => $this->ban_model->paginate($perPage, $offset, Ban_model::TYPE_EMAIL, trim(xss_clean($inputSearch))),
            'pagination' => $this->pagination->create_links(),
            'search'     => $inputSearch
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('bans/emails', $data);
    }

    public function add_email()
    {
        require_permission('add.bans');

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('domain', lang('domain'), 'trim|required|valid_domain');
        $this->form_validation->set_rules('reason', lang('reason'), 'trim|required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $domain = $this->input->post('domain');

            $find = $this->ban_model->find([
                'value' => $domain,
                'type'  => Ban_model::TYPE_EMAIL
            ]);

            if (! empty($find)) {
                $this->session->set_flashdata('error', lang('alert_email_already_banned'));
                redirect(site_url('admin/bans/emails/add'));
            }

            $this->ban_model->insert([
                'type'     => Ban_model::TYPE_EMAIL,
                'value'    => $domain,
                'reason'   => $this->input->post('reason', true),
                'start_at' => current_date()
            ]);

            $this->log_model->create('ban', 'add', 'Added a email domain ban', [
                'domain' => $domain
            ]);

            $this->cache->delete('banned_emails');

            $this->session->set_flashdata('success', lang('alert_email_ban_added'));
            redirect(site_url('admin/bans/emails/add'));
        } else {
            $this->template->build('bans/add_email');
        }
    }

    public function delete_email($id = null)
    {
        require_permission('delete.bans');

        $email = $this->ban_model->find([
            'id'   => $id,
            'type' => Ban_model::TYPE_EMAIL
        ]);

        if (empty($email)) {
            show_404();
        }

        $this->ban_model->delete(['id' => $id]);

        $this->log_model->create('ban', 'delete', 'Deleted a email domain ban', [
            'domain' => $email->value
        ]);

        $this->cache->delete('banned_emails');

        $this->session->set_flashdata('success', lang('alert_email_ban_deleted'));
        redirect(site_url('admin/bans/emails'));
    }

    /**
     * View ban details for email
     *
     * @param int $id
     * @return string
     */
    public function view_email($id = null)
    {
        $ban = $this->ban_model->find([
            'id'   => $id,
            'type' => Ban_model::TYPE_EMAIL
        ]);

        if (empty($ban)) {
            show_404();
        }

        $data = [
            'ban' => $ban
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('bans/view_email', $data);
    }
}
