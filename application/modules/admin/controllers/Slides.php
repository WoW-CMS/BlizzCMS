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

class Slides extends MX_Controller
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
        $data = [
            'slides' => $this->slides->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('slides/index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[image,video,iframe]');
            $this->form_validation->set_rules('route', 'Route', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('slides/create');
            }
            else
            {
                $this->slides->create([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'type'        => $this->input->post('type'),
                    'route'       => $this->input->post('route', TRUE)
                ]);

                $this->session->set_flashdata('success', lang('slide_created'));
                redirect(site_url('admin/slides/create'));
            }
        }
        else
        {
            $this->template->build('slides/create');
        }
    }

    /**
     * Edit slide
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $slide = $this->slides->find(['id' => $id]);

        if (empty($slide))
        {
            show_404();
        }

        $data = [
            'slide' => $slide
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[image,video,iframe]');
            $this->form_validation->set_rules('route', 'Route', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('slides/edit', $data);
            }
            else
            {
                $this->slides->update([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'type'        => $this->input->post('type'),
                    'route'       => $this->input->post('route', TRUE)
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('slide_updated'));
                redirect(site_url('admin/slides/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('slides/edit', $data);
        }
    }

    /**
     * Delete slide
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $slide = $this->slides->find(['id' => $id]);

        if (empty($slide))
        {
            show_404();
        }

        $this->slides->delete(['id' => $id]);

        $this->session->set_flashdata('success', lang('slide_deleted'));
        redirect(site_url('admin/slides'));
    }
}