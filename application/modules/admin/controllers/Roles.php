<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.roles');

        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('admin/roles'),
            'total_rows' => $this->role_model->total_paginate(),
            'per_page'   => $perPage
        ]);

        $data = [
            'roles'      => $this->role_model->paginate($perPage, $offset),
            'pagination' => $this->pagination->create_links()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('roles/index', $data);
    }

    public function add()
    {
        require_permission('add.roles');

        $data = [
            'base'    => $this->_permissions_check(':base:'),
            'admin'   => $this->_permissions_check('admin'),
            'user'    => $this->_permissions_check('user'),
            'pages'   => $this->_permissions_check(':page:'),
            'menus'   => $this->_menus_permissions(),
            'modules' => $this->_modules_permissions()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required|is_unique[roles.name]');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required');
        $this->form_validation->set_rules('permissions[]', lang('permissions'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->role_model->insert([
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description', true)
            ]);

            $roleId      = $this->db->insert_id();
            $permissions = $this->input->post('permissions[]') ?? [];

            if (! empty($permissions)) {
                $rows = [];

                foreach ($permissions as $item) {
                    $rows[] = ['role_id' => $roleId, 'permission_id' => $item];
                }

                $this->role_permission_model->insert_batch($rows);
            }

            $this->log_model->create('role', 'add', 'Added a role', [
                'role' => $this->input->post('name')
            ], 'admin/roles/edit/' . $roleId);

            $this->cache->clean();

            $this->session->set_flashdata('success', lang('alert_role_added'));
            redirect(site_url('admin/roles/edit/' . $roleId));
        } else {
            $this->template->build('roles/add', $data);
        }
    }

    /**
     * Edit role
     *
     * @param int $id
     * @return string|void
     */
    public function edit($id = null)
    {
        require_permission('edit.roles');

        $role = $this->role_model->find(['id' => $id]);

        if (empty($role)) {
            show_404();
        }

        $data = [
            'role'    => $role,
            'base'    => $this->_permissions_check(':base:', $id),
            'admin'   => $this->_permissions_check('admin', $id),
            'user'    => $this->_permissions_check('user', $id),
            'pages'   => $this->_permissions_check(':page:', $id),
            'menus'   => $this->_menus_permissions($id),
            'modules' => $this->_modules_permissions($id)
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required|update_unique[roles.name.' . $id . ']');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required');
        $this->form_validation->set_rules('permissions[]', lang('permissions'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->role_model->update([
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description', true)
            ], ['id' => $id]);

            $permissions = $this->input->post('permissions[]') ?? [];

            if (! empty($permissions)) {
                $rows = [];

                foreach ($permissions as $item) {
                    $rows[] = ['role_id' => $id, 'permission_id' => $item];
                }

                $this->role_permission_model->delete(['role_id' => $id]);

                $this->role_permission_model->insert_batch($rows);
            }

            $this->log_model->create('role', 'edit', 'Edited a role', [
                'role' => $this->input->post('name')
            ], 'admin/roles/edit/' . $id);

            $this->cache->clean();

            $this->session->set_flashdata('success', lang('alert_role_updated'));
            redirect(site_url('admin/roles/edit/' . $id));
        } else {
            $this->template->build('roles/edit', $data);
        }
    }

    /**
     * Delete role
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        require_permission('delete.roles');

        $role = $this->role_model->find(['id' => $id]);

        if (empty($role) || in_array($id, Role_model::DEFAULT_ROLES)) {
            show_404();
        }

        $this->role_model->delete(['id' => $id]);

        $this->log_model->create('role', 'delete', 'Deleted a role', [
            'role' => $role->name
        ]);

        $this->user_model->update(['role' => Role_model::ROLE_USER], ['role' => $id]);

        $this->cache->clean();

        $this->session->set_flashdata('success', lang('alert_role_deleted'));
        redirect(site_url('admin/roles'));
    }

    /**
     * Get a list of all module permissions for a role
     *
     * @param int|null $role
     * @return array
     */
    private function _modules_permissions($role = null)
    {
        $reserved = array_merge(Permission_model::INTERNAL_NAMES, Module_model::RESERVED_NAMES);
        $list     = [];

        foreach ($this->permission_model->module_list() as $module) {
            if (in_array($module, $reserved, true)) {
                continue;
            }

            $str = str_replace(['-', '_'], ' ', $module);

            $list[$str] = $this->_permissions_check($module, $role);
        }

        return $list;
    }

    /**
     * Get all permissions rows from a module and check if a role has it
     *
     * @param string $module
     * @param int|null $role
     * @return array
     */
    private function _permissions_check($module, $role = null)
    {
        $ids   = $role === null ? [] : $this->role_permission_model->permissions_ids($role);
        $perms = [];

        foreach ($this->permission_model->find_all(['module' => $module], 'array') as $row) {
            $perms[] = array_merge($row, ['checked' => in_array($row['id'], $ids, true)]);
        }

        return $perms;
    }

    /**
     * Get a list of all menus permissions and check if a role has it
     *
     * @param int|null $role
     * @return array
     */
    private function _menus_permissions($role = null)
    {
        $ids   = $role === null ? [] : $this->role_permission_model->permissions_ids($role);
        $menus = [];

        foreach ($this->menu_model->find_all() as $menu) {
            $items = $this->menu_item_model->items_ids($menu->id);
            $perms = [];

            foreach ($this->permission_model->find_all(['module' => ':menu-item:'], 'array') as $row) {
                if (! in_array($row['key'], $items, true)) {
                    continue;
                }

                $perms[] = array_merge($row, ['checked' => in_array($row['id'], $ids, true)]);
            }

            $menus[$menu->name] = $perms;
        }

        return $menus;
    }
}
