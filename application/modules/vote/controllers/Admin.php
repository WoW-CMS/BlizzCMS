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

        mod_located('vote', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->model([
            'topsites_model'      => 'topsites',
            'topsites_logs_model' => 'topsites_logs'
        ]);

        $language = $this->language->current();

        $this->load->language('admin/admin', $language);
        $this->load->language('vote', $language);

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 25;

        $this->pagination->initialize([
            'base_url'    => site_url('vote/admin'),
            'total_rows'  => $this->topsites->count_all(),
            'per_page'    => $per_page,
            'uri_segment' => 3
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'topsites' => $this->topsites->find_all($per_page, $offset),
            'links'    => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('url', lang('url'), 'trim|required|valid_url');
            $this->form_validation->set_rules('time', lang('time'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('points', lang('points'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('image', lang('image'), 'trim|required');

            if ($this->form_validation->run() == false)
            {
                $this->template->build('admin/create');
            }
            else
            {
                $this->topsites->create([
                    'name'   => $this->input->post('name'),
                    'url'    => $this->input->post('url', true),
                    'time'   => $this->input->post('time'),
                    'points' => $this->input->post('points'),
                    'image'  => $this->input->post('image', true)
                ]);

                $this->session->set_flashdata('success', lang('topsite_created'));
                redirect(site_url('vote/admin/create'));
            }
        }
        else
        {
            $this->template->build('admin/create');
        }
    }

    /**
     * Edit topsite
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $topsite = $this->topsites->find(['id' => $id]);

        if (empty($topsite))
        {
            show_404();
        }

        $data = [
            'topsite' => $topsite
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('url', lang('url'), 'trim|required|valid_url');
            $this->form_validation->set_rules('time', lang('time'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('points', lang('points'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('image', lang('image'), 'trim|required');

            if ($this->form_validation->run() == false)
            {
                $this->template->build('admin/edit', $data);
            }
            else
            {
                $this->topsites->update([
                    'name'   => $this->input->post('name'),
                    'url'    => $this->input->post('url', true),
                    'time'   => $this->input->post('time'),
                    'points' => $this->input->post('points'),
                    'image'  => $this->input->post('image', true)
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('topsite_updated'));
                redirect(site_url('vote/admin/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('admin/edit', $data);
        }
    }

    /**
     * Delete topsite
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $topsite = $this->topsites->find(['id' => $id]);

        if (empty($topsite))
        {
            show_404();
        }

        $this->topsites->delete(['id' => $id]);
        $this->topsites_logs->delete(['topsite_id' => $id]);

        $this->session->set_flashdata('success', lang('topsite_deleted'));
        redirect(site_url('vote/admin'));
    }

    public function logs()
    {
        $raw_page   = $this->input->get('page');
        $raw_search = $this->input->get('search');

        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $search   = $this->security->xss_clean($raw_search);
        $per_page = 25;

        $this->pagination->initialize([
            'base_url'    => site_url('store/admin/logs'),
            'total_rows'  => $this->topsites_logs->count_all($search),
            'per_page'    => $per_page,
            'uri_segment' => 4
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'logs'  => $this->topsites_logs->find_all($per_page, $offset, $search),
            'links'  => $this->pagination->create_links(),
            'search' => $raw_search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/logs', $data);
    }
}