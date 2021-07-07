<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_users extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nickname' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE
            ],
            'dp' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'vp' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'avatar' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 1
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
                'default' => 'english'
            ],
            'joined_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
