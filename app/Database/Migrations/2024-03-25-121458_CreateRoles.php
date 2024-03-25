<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use App\Models\Role;

class CreateRoles extends Migration
{
    public function up()
    {
        $model = new Role();

        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roles', false, ['ENGINE' => 'InnoDB']);

        $model->insertBatch([
            ['name' => 'Guest', 'description' => 'Role assigned to users who are not logged'],
            ['name' => 'Banned', 'description' => 'Role assigned to banned users'],
            ['name' => 'User', 'description' => 'Default role assigned to users'],
            ['name' => 'Game Master', 'description' => 'Role assigned to game master users'],
            ['name' => 'Administrator', 'description' => 'Role assigned to admin users'],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
