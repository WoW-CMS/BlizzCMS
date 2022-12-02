<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_roles_permissions extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'role_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE
            ],
            'permission_id' => [
                'type' => 'BIGINT',
                'constraint' => 20
            ]
        ]);
        $this->dbforge->add_key('role_id', true);
        $this->dbforge->add_key('permission_id', true);
        $this->dbforge->add_key('role_id');
        $this->dbforge->add_key('permission_id');
        $this->dbforge->create_table('roles_permissions', false, ['ENGINE' => 'InnoDB']);

        $this->db->query(add_foreign_key($this->db->dbprefix('roles_permissions'), 'role_id', $this->db->dbprefix('roles'), 'id', 'CASCADE'));
        $this->db->query(add_foreign_key($this->db->dbprefix('roles_permissions'), 'permission_id', $this->db->dbprefix('permissions'), 'id', 'CASCADE'));

        $this->role_permission_model->insert_batch([
            ['role_id' => '2', 'permission_id' => '-100'],
            ['role_id' => '2', 'permission_id' => '-101'],
            ['role_id' => '2', 'permission_id' => '-102'],

            ['role_id' => '3', 'permission_id' => '-1'],
            ['role_id' => '3', 'permission_id' => '-3'],
            ['role_id' => '3', 'permission_id' => '-5'],
            ['role_id' => '3', 'permission_id' => '-100'],
            ['role_id' => '3', 'permission_id' => '-101'],
            ['role_id' => '3', 'permission_id' => '-102'],

            ['role_id' => '4', 'permission_id' => '-1'],
            ['role_id' => '4', 'permission_id' => '-2'],
            ['role_id' => '4', 'permission_id' => '-4'],
            ['role_id' => '4', 'permission_id' => '-100'],
            ['role_id' => '4', 'permission_id' => '-101'],
            ['role_id' => '4', 'permission_id' => '-102'],

            ['role_id' => '5', 'permission_id' => '-1'],
            ['role_id' => '5', 'permission_id' => '-2'],
            ['role_id' => '5', 'permission_id' => '-4'],
            ['role_id' => '5', 'permission_id' => '-100'],
            ['role_id' => '5', 'permission_id' => '-101'],
            ['role_id' => '5', 'permission_id' => '-102'],
            ['role_id' => '5', 'permission_id' => '-200'],
            ['role_id' => '5', 'permission_id' => '-201'],
            ['role_id' => '5', 'permission_id' => '-202'],
            ['role_id' => '5', 'permission_id' => '-203'],
            ['role_id' => '5', 'permission_id' => '-204'],
            ['role_id' => '5', 'permission_id' => '-205'],
            ['role_id' => '5', 'permission_id' => '-206'],
            ['role_id' => '5', 'permission_id' => '-207'],
            ['role_id' => '5', 'permission_id' => '-208'],
            ['role_id' => '5', 'permission_id' => '-209'],
            ['role_id' => '5', 'permission_id' => '-210'],
            ['role_id' => '5', 'permission_id' => '-211'],
            ['role_id' => '5', 'permission_id' => '-212'],
            ['role_id' => '5', 'permission_id' => '-213'],
            ['role_id' => '5', 'permission_id' => '-214'],
            ['role_id' => '5', 'permission_id' => '-215'],
            ['role_id' => '5', 'permission_id' => '-216'],
            ['role_id' => '5', 'permission_id' => '-217'],
            ['role_id' => '5', 'permission_id' => '-218'],
            ['role_id' => '5', 'permission_id' => '-219'],
            ['role_id' => '5', 'permission_id' => '-220'],
            ['role_id' => '5', 'permission_id' => '-221'],
            ['role_id' => '5', 'permission_id' => '-222'],
            ['role_id' => '5', 'permission_id' => '-223'],
            ['role_id' => '5', 'permission_id' => '-224'],
            ['role_id' => '5', 'permission_id' => '-225'],
            ['role_id' => '5', 'permission_id' => '-226'],
            ['role_id' => '5', 'permission_id' => '-227'],
            ['role_id' => '5', 'permission_id' => '-228'],
            ['role_id' => '5', 'permission_id' => '-229'],
            ['role_id' => '5', 'permission_id' => '-230'],
            ['role_id' => '5', 'permission_id' => '-231'],
            ['role_id' => '5', 'permission_id' => '-232'],
            ['role_id' => '5', 'permission_id' => '-233'],
            ['role_id' => '5', 'permission_id' => '-234'],
            ['role_id' => '5', 'permission_id' => '-235'],
            ['role_id' => '5', 'permission_id' => '-236'],
            ['role_id' => '5', 'permission_id' => '-237'],
            ['role_id' => '5', 'permission_id' => '-238'],
            ['role_id' => '5', 'permission_id' => '-239'],
            ['role_id' => '5', 'permission_id' => '-240'],
            ['role_id' => '5', 'permission_id' => '-241']
        ]);
    }

    public function down()
    {
        $this->db->query(drop_foreign_key($this->db->dbprefix('roles_permissions'), 'role_id'));
        $this->db->query(drop_foreign_key($this->db->dbprefix('roles_permissions'), 'permission_id'));

        $this->dbforge->drop_table('roles_permissions');
    }
}
