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

class Menu extends MX_Controller
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

        $this->load->language('admin', $this->language->current());

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $data = [
            'menu' => $this->menu->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('menu/index', $data);
    }

    public function create()
    {
        $data = [
            'parents' => $this->menu->find_all(['type' => TYPE_DROPDOWN])
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('url', lang('url'), 'trim');
            $this->form_validation->set_rules('icon', lang('icon'), 'trim');
            $this->form_validation->set_rules('target', lang('target'), 'trim|required|in_list[_self,_blank]');
            $this->form_validation->set_rules('type', lang('type'), 'trim|required|in_list[default,dropdown]');
            $this->form_validation->set_rules('parent', lang('parent'), 'trim|required|is_natural');

            if ($this->form_validation->run() == false)
            {
                $this->template->build('menu/create', $data);
            }
            else
            {
                $this->menu->create([
                    'name'   => $this->input->post('name'),
                    'url'    => $this->input->post('url'),
                    'icon'   => $this->input->post('icon'),
                    'target' => $this->input->post('target'),
                    'type'   => $this->input->post('type'),
                    'parent' => $this->input->post('parent')
                ]);

                $this->session->set_flashdata('success', lang('menu_created'));
                redirect(site_url('admin/menu/create'));
            }
        }
        else
        {
            $this->template->build('menu/create', $data);
        }
    }

    /**
     * Edit menu
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $menu = $this->menu->find(['id' => $id]);

        if (empty($menu))
        {
            show_404();
        }

        $data = [
            'parents' => $this->menu->find_all(['type' => TYPE_DROPDOWN]),
            'menu'    => $menu
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required');
            $this->form_validation->set_rules('url', lang('url'), 'trim');
            $this->form_validation->set_rules('icon', lang('icon'), 'trim');
            $this->form_validation->set_rules('target', lang('target'), 'trim|required|in_list[_self,_blank]');
            $this->form_validation->set_rules('type', lang('type'), 'trim|required|in_list[default,dropdown]');
            $this->form_validation->set_rules('parent', lang('parent'), 'trim|required|is_natural');

            if ($this->form_validation->run() == false)
            {
                $this->template->build('menu/edit', $data);
            }
            else
            {
                $set = [
                    'name'   => $this->input->post('name'),
                    'url'    => $this->input->post('url'),
                    'icon'   => $this->input->post('icon'),
                    'target' => $this->input->post('target'),
                    'type'   => $this->input->post('type'),
                    'parent' => $this->input->post('parent')
                ];

                $this->menu->update($set, ['id' => $id]);

                $this->session->set_flashdata('success', lang('menu_updated'));

                redirect(site_url('admin/menu/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('menu/edit', $data);
        }
    }

    /**
     * Delete menu
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $menu = $this->menu->find(['id' => $id]);

        if (empty($menu))
        {
            show_404();
        }

        $this->menu->delete(['id' => $id]);
        $this->menu->delete(['parent' => $id]);

        $this->session->set_flashdata('success', lang('menu_deleted'));
        redirect(site_url('admin/menu'));
    }
}