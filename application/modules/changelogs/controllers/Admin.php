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

        mod_located('changelogs', true);

        if (! $this->website->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->model([
            'changelogs_model' => 'changelogs'
        ]);

        $this->load->language('admin/admin');
        $this->load->language('changelogs');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('changelogs/admin'),
            'total_rows'  => $this->changelogs->count_all(),
            'per_page'    => 25,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'changelogs' => $this->changelogs->find_all($config['per_page'], $offset),
            'links'      => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/create');
            }
            else
            {
                $this->changelogs->create([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'created_at'  => current_date()
                ]);

                $this->session->set_flashdata('success', lang('changelog_created'));
                redirect(site_url('changelogs/admin/create'));
            }
        }
        else
        {
            $this->template->build('admin/create');
        }
    }

    /**
     * Edit changelog
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $changelog = $this->changelogs->find(['id' => $id]);

        if (empty($changelog))
        {
            show_404();
        }

        $data = [
            'changelog' => $changelog
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/edit', $data);
            }
            else
            {
                $this->changelogs->update([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description')
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('changelog_updated'));
                redirect(site_url('changelogs/admin/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('admin/edit', $data);
        }
    }

    /**
     * Delete changelog
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $changelog = $this->changelogs->find(['id' => $id]);

        if (empty($changelog))
        {
            show_404();
        }

        $this->changelogs->delete(['id' => $id]);

        $this->session->set_flashdata('success', lang('changelog_deleted'));
        redirect(site_url('changelogs/admin'));
    }
}