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

        if (! $this->website->isLogged())
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

        $this->load->language('admin/admin');
        $this->load->language('vote');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('vote/admin'),
            'total_rows'  => $this->topsites->count_all(),
            'per_page'    => 25,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'topsites' => $this->topsites->find_all($config['per_page'], $offset),
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
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url');
            $this->form_validation->set_rules('time', 'Time', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('points', 'Points', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('image', 'Image', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/create');
            }
            else
            {
                $this->topsites->create([
                    'name'   => $this->input->post('name'),
                    'url'    => $this->input->post('url', TRUE),
                    'time'   => $this->input->post('time'),
                    'points' => $this->input->post('points'),
                    'image'  => $this->input->post('image', TRUE)
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
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url');
            $this->form_validation->set_rules('time', 'Time', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('points', 'Points', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('image', 'Image', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/edit', $data);
            }
            else
            {
                $this->topsites->update([
                    'name'   => $this->input->post('name'),
                    'url'    => $this->input->post('url', TRUE),
                    'time'   => $this->input->post('time'),
                    'points' => $this->input->post('points'),
                    'image'  => $this->input->post('image', TRUE)
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
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $search       = $this->input->get('search');
        $search_clean = $this->security->xss_clean($search);

        $config = [
            'base_url'    => site_url('store/admin/logs'),
            'total_rows'  => $this->topsites_logs->count_all($search_clean),
            'per_page'    => 25,
            'uri_segment' => 4
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'logs'  => $this->topsites_logs->find_all($config['per_page'], $offset, $search_clean),
            'links'  => $this->pagination->create_links(),
            'search' => $search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/logs', $data);
    }
}