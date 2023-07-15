<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.pages');

        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('admin/pages'),
            'total_rows' => $this->page_model->total_paginate(),
            'per_page'   => $perPage
        ]);

        $data = [
            'pages'      => $this->page_model->paginate($perPage, $offset),
            'pagination' => $this->pagination->create_links()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('pages/index', $data);
    }

    public function add()
    {
        require_permission('add.pages');

        $data = [
            'roles' => $this->_page_roles()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->add_js(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin'])
            ->add_js(base_url('assets/js/tmce-content.js'));

        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        $this->form_validation->set_rules('content', lang('content'), 'trim|required');
        $this->form_validation->set_rules('slug', lang('slug'), 'trim|required|alpha_dash|is_unique[pages.slug]');
        $this->form_validation->set_rules('meta_description', lang('meta_description'), 'trim|max_length[155]');
        $this->form_validation->set_rules('meta_robots', lang('meta_robots'), 'trim');
        $this->form_validation->set_rules('roles[]', lang('roles'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $title = $this->input->post('title');

            $this->page_model->insert([
                'title'            => $title,
                'content'          => purify($this->input->post('content'), 'article'),
                'slug'             => strtolower($this->input->post('slug')),
                'meta_description' => $this->input->post('meta_description', true),
                'meta_robots'      => $this->input->post('meta_robots', true)
            ]);

            $pageId = $this->db->insert_id();

            $this->permission_model->insert([
                'key'         => $pageId,
                'module'      => ':page:',
                'description' => "Can view {$title} page"
            ]);

            $roles = $this->input->post('roles[]') ?? [];

            if (! empty($roles)) {
                $permission = $this->permission_model->find(['key' => $pageId, 'module' => ':page:']);
                $rows       = [];

                foreach ($roles as $role) {
                    $rows[] = ['role_id' => $role, 'permission_id' => $permission->id];
                }

                $this->role_permission_model->insert_batch($rows);
            }

            $this->log_model->create('page', 'add', 'Added a page', [
                'page' => $title
            ], 'admin/pages/edit/' . $pageId);

            $this->cache->delete('permission_*');

            $this->session->set_flashdata('success', lang('alert_page_added'));
            redirect(site_url('admin/pages/edit/' . $pageId));
        } else {
            $this->template->build('pages/add', $data);
        }
    }

    /**
     * Edit page
     *
     * @param int $id
     * @return string|void
     */
    public function edit($id = null)
    {
        require_permission('edit.pages');

        $page = $this->page_model->find(['id' => $id]);

        if (empty($page)) {
            show_404();
        }

        $data = [
            'page'  => $page,
            'roles' => $this->_page_roles($id)
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->add_js(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin'])
            ->add_js(base_url('assets/js/tmce-content.js'));

        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        $this->form_validation->set_rules('content', lang('content'), 'trim|required');
        $this->form_validation->set_rules('slug', lang('slug'), 'trim|required|alpha_dash|update_unique[pages.slug.' . $id . ']');
        $this->form_validation->set_rules('meta_description', lang('meta_description'), 'trim|max_length[155]');
        $this->form_validation->set_rules('meta_robots', lang('meta_robots'), 'trim');
        $this->form_validation->set_rules('roles[]', lang('roles'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $title = $this->input->post('title');

            $this->page_model->update([
                'title'            => $title,
                'content'          => purify($this->input->post('content'), 'article'),
                'slug'             => strtolower($this->input->post('slug')),
                'meta_description' => $this->input->post('meta_description', true),
                'meta_robots'      => $this->input->post('meta_robots', true)
            ], ['id' => $id]);

            $this->permission_model->update([
                'description' => "Can view {$title} page"
            ], ['key' => $id, 'module' => ':page:']);

            $roles = $this->input->post('roles[]') ?? [];

            if (! empty($roles)) {
                $permission = $this->permission_model->find(['key' => $id, 'module' => ':page:']);
                $rows       = [];

                foreach ($roles as $role) {
                    $rows[] = ['role_id' => $role, 'permission_id' => $permission->id];
                }

                $this->role_permission_model->delete(['permission_id' => $permission->id]);

                $this->role_permission_model->insert_batch($rows);
            }

            $this->log_model->create('page', 'edit', 'Edited a page', [
                'page' => $title
            ], 'admin/pages/edit/' . $id);

            $this->cache->delete('permission_*');

            $this->session->set_flashdata('success', lang('alert_page_updated'));
            redirect(site_url('admin/pages/edit/' . $id));
        } else {
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
        require_permission('delete.pages');

        $page = $this->page_model->find(['id' => $id]);

        if (empty($page)) {
            show_404();
        }

        $this->page_model->delete(['id' => $id]);

        $this->permission_model->delete([
            'key'    => $id,
            'module' => ':page:'
        ]);

        $this->log_model->create('page', 'delete', 'Deleted a page', [
            'page' => $page->title
        ]);

        $this->cache->delete('permission_*');

        $this->session->set_flashdata('success', lang('alert_page_deleted'));
        redirect(site_url('admin/pages'));
    }

    /**
     * Get a list of roles has view permission on the page
     *
     * @param int|null $id
     * @return array
     */
    private function _page_roles($id = null)
    {
        $permission = $this->permission_model->find([
            'key'    => $id,
            'module' => ':page:'
        ]);

        $ids   = empty($permission) ? [] : $this->role_permission_model->roles_ids($permission->id);
        $roles = [];

        foreach ($this->role_model->find_all([], 'array') as $row) {
            $roles[] = array_merge($row, ['checked' => in_array($row['id'], $ids, true)]);
        }

        return $roles;
    }
}
