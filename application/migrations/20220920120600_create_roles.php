<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_roles extends CI_Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => TRUE
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('roles', false, ['ENGINE' => 'InnoDB']);

        $this->role_model->insert_batch([
            ['name' => 'Guest', 'description' => 'Role assigned to users who are not logged'],
            ['name' => 'Banned', 'description' => 'Role assigned to banned users'],
            ['name' => 'User', 'description' => 'Default role assigned to users'],
            ['name' => 'Game Master', 'description' => 'Role assigned to game master users'],
            ['name' => 'Administrator', 'description' => 'Role assigned to admin users']
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('roles');
    }
}
