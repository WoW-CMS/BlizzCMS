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

class Users extends MX_Controller
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
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $search       = $this->input->get('search');
        $search_clean = $this->security->xss_clean($search);

        $config = [
            'base_url'    => site_url('admin/users'),
            'total_rows'  => $this->users->count_all($search_clean),
            'per_page'    => 25,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'users'  => $this->users->find_all($config['per_page'], $offset, $search_clean),
            'links'  => $this->pagination->create_links(),
            'search' => $search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

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
        $user = $this->users->find(['id' => $id]);

        if (empty($user))
        {
            show_404();
        }

        $data = [
            'user' => $user
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('users/view', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('id', 'Id', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|alpha_numeric|max_length[16]');
        $this->form_validation->set_rules('dp', 'Donor points', 'trim|required|is_natural');
        $this->form_validation->set_rules('vp', 'Voter points', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE)
        {
            return $this->view($this->input->post('id', TRUE));
        }
        else
        {
            $id = $this->input->post('id', TRUE);

            $this->users->update([
                'nickname' => $this->input->post('nickname', TRUE),
                'dp'       => $this->input->post('dp'),
                'vp'       => $this->input->post('vp')
            ], ['id' => $id]);

            $this->session->set_flashdata('success', lang('user_updated'));
            redirect(site_url('admin/users/view/' . $id));
        }
    }

    public function users_banned()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $search       = $this->input->get('search');
        $search_clean = $this->security->xss_clean($search);

        $config = [
            'base_url'    => site_url('admin/users/banned'),
            'total_rows'  => $this->auth->count_all_bans($search_clean),
            'per_page'    => 25,
            'uri_segment' => 4
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'bans'   => $this->auth->get_all_bans($config['per_page'], $offset, $search_clean),
            'links'  => $this->pagination->create_links(),
            'search' => $search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('users/bans', $data);
    }

    /**
     * View ban details
     *
     * @param int $id
     * @return string
     */
    public function view_ban($id = null)
    {
        $ban = $this->auth->get_ban($id);

        if (empty($ban))
        {
            show_404();
        }

        $data = [
            'ban' => $ban
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('users/view_ban', $data);
    }

    public function user_ban()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('date', 'Date', 'trim|required|validate_date[Y-m-d]');
            $this->form_validation->set_rules('reason', 'Reason', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('users/add_ban');
            }
            else
            {
                $emulator = config_item('emulator');
                $user   = $this->auth->account_id($this->input->post('username', TRUE));
                $date   = $this->input->post('date');
                $reason = $this->input->post('reason', TRUE);

                if (empty($user))
                {
                    $this->session->set_flashdata('error', lang('user_not_found'));
                    redirect(site_url('admin/users/ban'));
                }

                if ($this->auth->is_banned($user))
                {
                    $this->session->set_flashdata('error', lang('user_already_banned'));
                    redirect(site_url('admin/users/ban'));
                }

                if (in_array($emulator, ['cmangos'], true))
                {
                    $this->auth->connect()->insert('account_banned', [
                        'account_id' => $user,
                        'banned_at'  => now(),
                        'expires_at' => strtotime($date),
                        'banned_by'  => 'Website',
                        'reason'     => $reason
                    ]);
                }
                else
                {
                    $this->auth->connect()->insert('account_banned', [
                        'id'        => $user,
                        'bandate'   => now(),
                        'unbandate' => strtotime($date),
                        'bannedby'  => 'Website',
                        'banreason' => $reason
                    ]);
                }

                if (config_item('emulator_bnet') === 'true')
                {
                    $this->auth->connect()->insert('battlenet_account_bans', [
                        'id'        => $user,
                        'bandate'   => now(),
                        'unbandate' => strtotime($date),
                        'bannedby'  => 'Website',
                        'banreason' => $reason
                    ]);
                }

                $this->session->set_flashdata('success', lang('user_banned'));
                redirect(site_url('admin/users/ban'));
            }
        }
        else
        {
            $this->template->build('users/add_ban');
        }
    }

    /**
     * Unban user
     *
     * @param int $id
     * @return void
     */
    public function user_unban($id = null)
    {
        $ban = $this->auth->get_ban($id);

        if (empty($ban))
        {
            show_404();
        }

        $this->auth->connect()->where('id', $id)->delete('account_banned');

        if (config_item('emulator_bnet') === 'true')
        {
            $this->auth->connect()->where('id', $id)->delete('battlenet_account_bans');
        }

        $this->session->set_flashdata('success', lang('user_unbanned'));
        redirect(site_url('admin/users/banned'));
    }
}