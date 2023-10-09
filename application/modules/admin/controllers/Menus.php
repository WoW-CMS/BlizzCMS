<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.appearance');

        $data = [
            'menus' => $this->menu_model->find_all()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('menus/index', $data);
    }

    public function add()
    {
        require_permission('add.menus');

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required|is_unique[menus.name]');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $name = $this->input->post('name');

            $this->menu_model->insert([
                'name'        => $name,
                'description' => $this->input->post('description')
            ]);

            $menuId = $this->db->insert_id();

            $this->log_model->create('menu', 'add', 'Added a menu', [
                'menu' => $name
            ], 'admin/menus/edit/' . $menuId);

            $this->session->set_flashdata('success', lang('alert_menu_added'));
            redirect(site_url('admin/menus/add'));
        } else {
            $this->template->build('menus/add');
        }
    }

    /**
     * Edit menu
     *
     * @param int $menuId
     * @return string|void
     */
    public function edit($menuId = null)
    {
        require_permission('edit.menus');

        $menu = $this->menu_model->find(['id' => $menuId]);

        if (empty($menu)) {
            show_404();
        }

        $data = [
            'menu' => $menu
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        if (! in_array($menuId, Menu_model::DEFAULT_MENUS)) {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required|update_unique[menus.name.' . $menuId . ']');
        }

        $this->form_validation->set_rules('description', lang('description'), 'trim|required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $set = [
                'description' => $this->input->post('description')
            ];

            if (! in_array($menuId, Menu_model::DEFAULT_MENUS)) {
                $set['name'] = $this->input->post('name');
            }

            $this->menu_model->update($set, ['id' => $menuId]);

            $this->log_model->create('menu', 'edit', 'Edited a menu', [
                'id' => $menuId
            ], 'admin/menus/edit/' . $menuId);

            $this->cache->delete('menu_*');

            $this->session->set_flashdata('success', lang('alert_menu_updated'));
            redirect(site_url('admin/menus/edit/' . $menuId));
        } else {
            $this->template->build('menus/edit', $data);
        }
    }

    /**
     * Delete menu
     *
     * @param int $menuId
     * @return void
     */
    public function delete($menuId = null)
    {
        require_permission('delete.menus');

        $menu = $this->menu_model->find(['id' => $menuId]);

        if (empty($menu) || in_array($menuId, Menu_model::DEFAULT_MENUS)) {
            show_404();
        }

        $this->menu_model->delete(['id' => $menuId]);

        $this->log_model->create('menu', 'delete', 'Deleted a menu', [
            'menu' => $menu->name
        ]);

        $this->cache->delete('menu_*');

        $this->session->set_flashdata('success', lang('alert_menu_deleted'));
        redirect(site_url('admin/menus'));
    }

    /**
     * View menu items
     *
     * @param int $menuId
     * @return string
     */
    public function items($menuId = null)
    {
        require_permission('view.appearance');

        $menu = $this->menu_model->find(['id' => $menuId]);

        if (empty($menu)) {
            show_404();
        }

        $data = [
            'menu'  => $menu,
            'items' => $this->menu_item_model->find_all(['menu_id'=> $menuId, 'parent' => 0])
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('menus/items', $data);
    }

    /**
     * Add menu item
     *
     * @param int $menuId
     * @return string|void
     */
    public function add_item($menuId = null)
    {
        require_permission('add.menus');

        $menu = $this->menu_model->find(['id' => $menuId]);

        if (empty($menu)) {
            show_404();
        }

        $data = [
            'menu'    => $menu,
            'parents' => $this->menu_item_model->find_all(['menu_id' => $menuId, 'type' => ITEM_DROPDOWN]),
            'roles'   => $this->_menu_item_roles()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('url', lang('url'), 'trim');
        $this->form_validation->set_rules('icon', lang('icon'), 'trim');
        $this->form_validation->set_rules('target', lang('target'), 'trim|required|in_list[_self,_blank]');
        $this->form_validation->set_rules('type', lang('type'), 'trim|required|in_list[link,dropdown]');
        $this->form_validation->set_rules('parent', lang('parent'), 'trim|required|is_natural');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $name   = $this->input->post('name');
            $parent = $this->input->post('parent');
            $type   = $this->input->post('type');

            // Prevent creating dropdown items inside another
            if ($type === ITEM_DROPDOWN && (int) $parent > 0) {
                $this->session->set_flashdata('error', lang('alert_menu_not_dropdown_inside'));
                redirect(site_url('admin/menus/' . $menuId . '/add'));
            }

            $this->menu_item_model->insert([
                'menu_id' => $menuId,
                'name'    => $name,
                'url'     => $this->input->post('url', true),
                'icon'    => $this->input->post('icon'),
                'target'  => $this->input->post('target'),
                'type'    => $type,
                'parent'  => $parent,
                'sort'    => $this->menu_item_model->last_item_sort($menuId, $parent) + 1
            ]);

            $itemId = $this->db->insert_id();

            $this->permission_model->insert([
                'key'         => $itemId,
                'module'      => ':menu-item:',
                'description' => "Can view {$name} {$type} item"
            ]);

            $roles = $this->input->post('roles[]') ?? [];

            if (! empty($roles)) {
                $permission = $this->permission_model->find(['key' => $itemId, 'module' => ':menu-item:']);
                $rows       = [];

                foreach ($roles as $role) {
                    $rows[] = ['role_id' => $role, 'permission_id' => $permission->id];
                }

                $this->role_permission_model->insert_batch($rows);
            }

            $this->log_model->create('menu item', 'add', 'Added a menu item', [
                'item' => $name,
                'type' => $type
            ], "admin/menus/{$menuId}/edit/{$itemId}");

            $this->cache->delete('menu_*');
            $this->cache->delete('permission_*');

            $this->session->set_flashdata('success', lang('alert_menu_item_added'));
            redirect(site_url('admin/menus/' . $menuId . '/add'));
        } else {
            $this->template->build('menus/add_item', $data);
        }
    }

    /**
     * Edit menu item
     *
     * @param int $menuId
     * @param int $itemId
     * @return string|void
     */
    public function edit_item($menuId = null, $itemId = null)
    {
        require_permission('edit.menus');

        $item = $this->menu_item_model->find([
            'id'      => $itemId,
            'menu_id' => $menuId
        ]);

        if (empty($item)) {
            show_404();
        }

        $data = [
            'menu'    => $this->menu_model->find(['id' => $item->menu_id]),
            'item'    => $item,
            'parents' => $this->menu_item_model->find_all(['menu_id' => $item->menu_id, 'type' => ITEM_DROPDOWN]),
            'roles'   => $this->_menu_item_roles($itemId)
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('url', lang('url'), 'trim');
        $this->form_validation->set_rules('icon', lang('icon'), 'trim');
        $this->form_validation->set_rules('target', lang('target'), 'trim|required|in_list[_self,_blank]');
        $this->form_validation->set_rules('type', lang('type'), 'trim|required|in_list[link,dropdown]');
        $this->form_validation->set_rules('parent', lang('parent'), 'trim|required|is_natural');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $name   = $this->input->post('name');
            $parent = $this->input->post('parent');
            $type   = $this->input->post('type');

            // Prevent create dropdown item inside another
            if ($type === ITEM_DROPDOWN && (int) $parent > 0) {
                $this->session->set_flashdata('error', lang('alert_menu_not_dropdown_inside'));
                redirect(site_url('admin/menus/' . $item->menu_id . '/edit/' . $itemId));
            }

            $set = [
                'name'   => $name,
                'url'    => $this->input->post('url', true),
                'icon'   => $this->input->post('icon'),
                'target' => $this->input->post('target'),
                'type'   => $type,
                'parent' => $parent
            ];

            if ($item->parent !== $parent) {
                $set['sort'] = $this->menu_item_model->last_item_sort($item->menu_id, $parent) + 1;
            }

            $this->menu_item_model->update($set, ['id' => $itemId]);

            $this->permission_model->update([
                'description' => "Can view {$name} {$type} item"
            ], ['key' => $itemId, 'module' => ':menu-item:']);

            $roles = $this->input->post('roles[]') ?? [];

            if (! empty($roles)) {
                $permission = $this->permission_model->find(['key' => $itemId, 'module' => ':menu-item:']);
                $rows       = [];

                foreach ($roles as $role) {
                    $rows[] = ['role_id' => $role, 'permission_id' => $permission->id];
                }

                $this->role_permission_model->delete(['permission_id' => $permission->id]);

                $this->role_permission_model->insert_batch($rows);
            }

            $this->log_model->create('menu item', 'edit', 'Edited a menu item', [
                'item' => $name,
                'type' => $type
            ], "admin/menus/{$item->menu_id}/edit/{$itemId}");

            $this->cache->delete('menu_*');
            $this->cache->delete('permission_*');

            $this->session->set_flashdata('success', lang('alert_menu_item_updated'));
            redirect(site_url('admin/menus/' . $item->menu_id . '/edit/' . $itemId));
        } else {
            $this->template->build('menus/edit_item', $data);
        }
    }

    /**
     * Move menu item order
     *
     * @param int $menuId
     * @param int $itemId
     * @param string $action
     * @return void
     */
    public function move_item($menuId = null, $itemId = null, $action = null)
    {
        require_permission('edit.menus');

        $item = $this->menu_item_model->find([
            'id'      => $itemId,
            'menu_id' => $menuId
        ]);

        if (empty($item) || ! in_array($action, ['up', 'down'], true)) {
            show_404();
        }

        $itemSort = (int) $item->sort;
        $lastSort = $this->menu_item_model->last_item_sort($item->menu_id, $item->parent);

        if ($itemSort <= 1 && $action === 'up' || ($itemSort + 1) > $lastSort && $action === 'down') {
            show_404();
        }

        if ($action === 'up') {
            $this->menu_item_model->set(['sort' => 'sort+1'], [
                'menu_id' => $item->menu_id,
                'parent'  => $item->parent,
                'sort'    => $itemSort - 1
            ], false);
        } else {
            $this->menu_item_model->set(['sort' => 'sort-1'], [
                'menu_id' => $item->menu_id,
                'parent'  => $item->parent,
                'sort'    => $itemSort + 1
            ], false);
        }

        $this->menu_item_model->update([
            'menu_id' => $item->menu_id,
            'parent'  => $item->parent,
            'sort'    => $action === 'up' ? $itemSort - 1 : $itemSort + 1
        ], ['id' => $itemId]);

        $this->cache->delete('menu_*');

        $this->session->set_flashdata('success', lang('alert_menu_item_moved'));
        redirect(site_url('admin/menus/' . $menuId));
    }

    /**
     * Delete menu item
     *
     * @param int $menuId
     * @param int $itemId
     * @return void
     */
    public function delete_item($menuId = null, $itemId = null)
    {
        require_permission('delete.menus');

        $item = $this->menu_item_model->find([
            'id'      => $itemId,
            'menu_id' => $menuId
        ]);

        if (empty($item)) {
            show_404();
        }

        if ($item->type === ITEM_DROPDOWN) {
            $parents    = $this->menu_item_model->find_all(['parent' => $itemId], 'array');
            $parentsIds = array_column($parents, 'id');

            if ($parentsIds !== []) {
                foreach ($parentsIds as $id) {
                    $this->permission_model->delete([
                        'key'    => $id,
                        'module' => ':menu-item:'
                    ]);
                }

                $this->menu_item_model->delete(['parent' => $itemId]);
            }
        }

        $this->menu_item_model->delete(['id' => $itemId]);

        $this->permission_model->delete([
            'key'    => $itemId,
            'module' => ':menu-item:'
        ]);

        $this->menu_item_model->set(['sort' => 'sort-1'], [
            'menu_id' => $item->menu_id,
            'parent'  => $item->parent,
            'sort >'  => (int) $item->sort
        ], false);

        $this->log_model->create('menu item', 'delete', 'Deleted a menu item', [
            'item' => $item->name,
            'type' => $item->type
        ]);

        $this->cache->delete('menu_*');
        $this->cache->delete('permission_*');

        $this->session->set_flashdata('success', lang('alert_menu_item_deleted'));
        redirect(site_url('admin/menus/' . $menuId));
    }

    /**
     * Get a list of roles has view permission on the menu item
     *
     * @param int|null $itemId
     * @return array
     */
    private function _menu_item_roles($itemId = null)
    {
        $permission = $this->permission_model->find([
            'key'    => $itemId,
            'module' => ':menu-item:'
        ]);

        $ids   = empty($permission) ? [] : $this->role_permission_model->roles_ids($permission->id);
        $roles = [];

        foreach ($this->role_model->find_all([], 'array') as $row) {
            $roles[] = array_merge($row, ['checked' => in_array($row['id'], $ids, true)]);
        }

        return $roles;
    }
}
