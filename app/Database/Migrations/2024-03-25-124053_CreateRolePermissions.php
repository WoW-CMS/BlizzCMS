<?php

namespace App\Database\Migrations;

use App\Models\RolePermission;
use CodeIgniter\Database\Migration;

class CreateRolePermissions extends Migration
{
    public function up()
    {
        $model = new RolePermission();

        $this->forge->addField([
            'role_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true
            ],
            'permission_id' => [
                'type' => 'BIGINT',
                'constraint' => 20
            ]
        ]);

        $this->forge->addKey(['role_id', 'permission_id'], true);


        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE', 'roles_role_id_foreign');
        $this->forge->addForeignKey('permission_id', 'permissions', 'id', 'CASCADE', 'CASCADE', 'permissions_permission_id_foreign');

        $this->forge->createTable('roles_permissions', false, ['ENGINE' => 'InnoDB']);

        $model->insertBatch([
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
        $this->forge->dropTable('roles_permissions');
    }
}
