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

class Pages extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->website->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->model([
            'pages_model' => 'pages'
        ]);

        $this->load->language('admin');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('admin/pages'),
            'total_rows'  => $this->pages->count_all(),
            'per_page'    => 25,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'pages' => $this->pages->find_all($config['per_page'], $offset),
            'links' => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('pages/index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[pages.slug]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('pages/create');
            }
            else
            {
                $this->pages->create([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'slug'        => $this->input->post('slug'),
                    'created_at'  => current_date()
                ]);

                $this->session->set_flashdata('success', lang('page_created'));
                redirect(site_url('admin/pages/create'));
            }
        }
        else
        {
            $this->template->build('pages/create');
        }
    }

    /**
     * Edit page
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $page = $this->pages->find(['id' => $id]);

        if (empty($page))
        {
            show_404();
        }

        $data = [
            'page' => $page
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|update_unique[pages.slug.'.$id.']');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('pages/edit', $data);
            }
            else
            {
                $this->pages->update([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'slug'        => $this->input->post('slug'),
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('page_updated'));
                redirect(site_url('admin/pages/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('pages/edit', $data);
        }
    }

    /**
     * Delete page
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $page = $this->pages->find(['id' => $id]);

        if (empty($page))
        {
            show_404();
        }

        $this->pages->delete(['id' => $id]);

        $this->session->set_flashdata('success', lang('page_deleted'));
        redirect(site_url('admin/pages'));
    }
}