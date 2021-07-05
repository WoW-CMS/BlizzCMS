<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_bugtracker extends CI_Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'realm_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'description' => [
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => '10',
                'default' => 1
            ],
            'priority' => [
                'type' => 'ENUM("low","normal","medium","high","critical")',
                'default' => 'normal',
                'null' => FALSE
            ],
            'status' => [
                'type' => 'ENUM("open","waiting information","confirmed","in progress","invalid","fixed")',
                'default' => 'open',
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('realm_id');
        $this->dbforge->add_key('category_id');
        $this->dbforge->create_table('bugtracker');
    }

    public function down()
    {
        $this->dbforge->drop_table('bugtracker');
    }
}
