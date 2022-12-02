<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_menus_items extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'menu_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'url' => [
                'type' => 'TEXT'
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'target' => [
                'type' => 'ENUM("_self","_blank")',
                'default' => '_self'
            ],
            'type' => [
                'type' => 'ENUM("link","dropdown")',
                'default' => 'link'
            ],
            'parent' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'sort' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'default' => 0
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('menu_id');
        $this->dbforge->create_table('menus_items', false, ['ENGINE' => 'InnoDB']);

        $this->db->query(add_foreign_key($this->db->dbprefix('menus_items'), 'menu_id', $this->db->dbprefix('menus'), 'id', 'CASCADE'));

        $this->menu_item_model->insert_batch([
            ['menu_id' => 1, 'name' => 'Home', 'url' => '', 'icon' => 'fa-solid fa-house', 'target' => '_self', 'type' => 'link', 'parent' => 0, 'sort' => 1],
            ['menu_id' => 2, 'name' => 'Dashboard', 'url' => 'user', 'icon' => 'fa-solid fa-gauge', 'target' => '_self', 'type' => 'link', 'parent' => 0, 'sort' => 1],
            ['menu_id' => 2, 'name' => 'My Profile', 'url' => 'user/profile', 'icon' => 'fa-solid fa-circle-user', 'target' => '_self', 'type' => 'link', 'parent' => 0, 'sort' => 2],
            ['menu_id' => 2, 'name' => 'Security', 'url' => 'user/security', 'icon' => 'fa-solid fa-shield', 'target' => '_self', 'type' => 'link', 'parent' => 0, 'sort' => 3],
        ]);

        $items      = $this->menu_item_model->find_all();
        $permsItems = [];

        foreach ($items as $item) {
            $permsItems[] = [
                'key'         => $item->id,
                'module'      => ':menu-item:',
                'description' => "Can view {$item->name} {$item->type} item"
            ];
        }

        $this->permission_model->insert_batch($permsItems);

        $permissions = $this->permission_model->find_all(['module' => ':menu-item:']);
        $permsLinked = [];

        foreach ($permissions as $permission) {
            if ($permission->key == 1) {
                $permsLinked[] = ['role_id' => '1', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '2', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '3', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '4', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '5', 'permission_id' => $permission->id];
            }

            if ($permission->key >= 2) {
                $permsLinked[] = ['role_id' => '2', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '3', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '4', 'permission_id' => $permission->id];
                $permsLinked[] = ['role_id' => '5', 'permission_id' => $permission->id];
            }
        }

        $this->role_permission_model->insert_batch($permsLinked);
    }

    public function down()
    {
        $this->db->query(drop_foreign_key($this->db->dbprefix('menus_items'), 'menu_id'));

        $this->dbforge->drop_table('menus_items');

        $permissions    = $this->permission_model->find_all(['module' => ':menu-item:'], 'array');
        $permissionsIds = array_column($permissions, 'id');

        if ($permissionsIds !== []) {
            $this->permission_model->delete_in('id', $permissionsIds);
        }
    }
}
