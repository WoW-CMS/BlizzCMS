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

class Admin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('donate', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->model([
            'donation_logs_model' => 'donation_logs',
        ]);

        $this->load->language('admin/admin');
        $this->load->language('donate');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $data = [
            'latest' => $this->donation_logs->latest()
        ];

        $this->template->add_js(base_url('assets/chart/chart.js'));
        $this->template->add_js(base_url('application/modules/donate/js/chart.js'));

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/index', $data);
    }

    public function settings()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('paypal_mode', lang('mode'), 'trim|required|in_list[sandbox,production]');
            $this->form_validation->set_rules('paypal_minimal', lang('minimal_amount'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('paypal_client', lang('client_id'), 'trim|required');
            $this->form_validation->set_rules('paypal_secret', lang('secret'), 'trim');
            $this->form_validation->set_rules('paypal_currency_rate', lang('amount'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('paypal_currency', lang('currency'), 'trim|required|alpha|max_length[3]');
            $this->form_validation->set_rules('paypal_points_rate', lang('points'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('paypal_gateway', lang('gateway'), 'trim');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/settings');
            }
            else
            {
                $this->settings->update_batch([
                    [
                        'key'   => 'paypal_currency',
                        'value' => strtoupper($this->input->post('paypal_currency'))
                    ],
                    [
                        'key'   => 'paypal_mode',
                        'value' => $this->input->post('paypal_mode')
                    ],
                    [
                        'key'   => 'paypal_client',
                        'value' => $this->input->post('paypal_client', TRUE)
                    ],
                    [
                        'key'   => 'paypal_minimal_amount',
                        'value' => $this->input->post('paypal_minimal')
                    ],
                    [
                        'key'   => 'paypal_currency_rate',
                        'value' => $this->input->post('paypal_currency_rate')
                    ],
                    [
                        'key'   => 'paypal_points_rate',
                        'value' => $this->input->post('paypal_points_rate')
                    ],
                    [
                        'key'   => 'paypal_gateway',
                        'value' => ($this->input->post('paypal_gateway', TRUE) != 'true') ? 'false' : 'true'
                    ]
                ], 'key');

                $paypal_secret = $this->input->post('paypal_secret');

                if (! empty($paypal_secret))
                {
                    $this->settings->update([
                        'value' => encrypt($paypal_secret)
                    ], ['key' => 'paypal_secret']);
                }

                // Clear cache
                $this->cache->file->delete('settings');

                $this->session->set_flashdata('success', lang('settings_updated'));
                redirect(site_url('donate/admin/settings'));
            }
        }
        else
        {
            $this->template->build('admin/settings');
        }
    }

    public function logs()
    {
        $raw_page   = $this->input->get('page');
        $raw_search = $this->input->get('search');

        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $search   = $this->security->xss_clean($raw_search);
        $per_page = 25;

        $this->pagination->initialize([
            'base_url'    => site_url('donate/admin/logs'),
            'total_rows'  => $this->donation_logs->count_all($search),
            'per_page'    => $per_page,
            'uri_segment' => 4
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'logs'   => $this->donation_logs->find_all($per_page, $offset, $search),
            'links'  => $this->pagination->create_links(),
            'search' => $raw_search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/logs', $data);
    }

    /**
     * View donation log details
     *
     * @param int $id
     * @return string
     */
    public function view_log($id = null)
    {
        $log = $this->donation_logs->find(['id' => $id]);

        if (empty($log))
        {
            show_404();
        }

        $data = [
            'log' => $log
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/view_log', $data);
    }

    public function create_payment()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_numeric');
            $this->form_validation->set_rules('order', lang('order_id'), 'trim|required');
            $this->form_validation->set_rules('reference', lang('reference_id'), 'trim|required');
            $this->form_validation->set_rules('payment', lang('payment_id'), 'trim|required');
            $this->form_validation->set_rules('gateway', lang('gateway'), 'trim|required|in_list[PayPal]');
            $this->form_validation->set_rules('points', lang('points'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('amount', lang('amount'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('currency', lang('currency'), 'trim|required|alpha|max_length[3]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/create_payment');
            }
            else
            {
                $user   = $this->cms->user_id($this->input->post('username', TRUE));
                $points = (int) $this->input->post('points');
                $ip     = $this->input->ip_address();

                if (empty($user))
                {
                    $this->session->set_flashdata('error', lang('user_not_found'));
                    redirect(site_url('donate/admin/logs/create'));
                }

                $this->db->query("UPDATE users SET dp = dp + ? WHERE id = ?", [$points, $user]);

                $this->donation_logs->create([
                    'user_id'         => $user,
                    'order_id'        => $this->input->post('order'),
                    'reference_id'    => $this->input->post('reference'),
                    'payment_id'      => $this->input->post('payment'),
                    'payment_status'  => 'COMPLETED',
                    'payment_gateway' => $this->input->post('gateway'),
                    'points'          => $points,
                    'amount'          => $this->input->post('amount'),
                    'currency'        => $this->input->post('currency'),
                    'rewarded'        => 'YES',
                    'ip'              => $ip,
                    'created_at'      => current_date()
                ]);

                $this->session->set_flashdata('success', lang('manual_donation_success'));
                redirect(site_url('donate/admin/logs/create'));
            }
        }
        else
        {
            $this->template->build('admin/create_payment');
        }
    }

    public function update_payment($id = null)
    {
        $log = $this->donation_logs->find(['id' => $id]);

        if (empty($log))
        {
            show_404();
        }

        if (in_array($log->payment_status, ['COMPLETED', 'DECLINED'], true))
        {
            $this->session->set_flashdata('error', lang('update_payment_error'));
            redirect(site_url('donate/admin/logs'));
        }

        $data = [
            'log' => $log
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('order', lang('order_id'), 'trim');
            $this->form_validation->set_rules('reference', lang('reference_id'), 'trim');
            $this->form_validation->set_rules('payment', lang('payment_id'), 'trim');
            $this->form_validation->set_rules('status', lang('status'), 'trim|required|in_list[COMPLETED,PENDING,DECLINED]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/update_payment', $data);
            }
            else
            {
                $status = $this->input->post('status');

                $this->donation_logs->update([
                    'order_id'       => $this->input->post('order'),
                    'reference_id'   => $this->input->post('reference'),
                    'payment_id'     => $this->input->post('payment'),
                    'payment_status' => $this->input->post('status'),
                    'updated_at'     => current_url()
                ], ['id' => $id]);

                if ($status === 'COMPLETED')
                {
                    $this->db->query("UPDATE users SET dp = dp + ? WHERE id = ?", [$log->points, $log->user_id]);

                    $this->donation_logs->update([
                        'rewarded'   => 'YES',
                        'updated_at' => current_url()
                    ], ['id' => $id]);
                }

                $this->session->set_flashdata('success', lang('manual_donation_success'));
                redirect(site_url('donate/admin/logs/view/'.$id));
            }
        }
        else
        {
            $this->template->build('admin/update_payment', $data);
        }
    }
}