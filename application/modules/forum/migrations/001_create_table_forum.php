<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_forum extends CI_Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'type' => [
                'type' => 'ENUM("category","forum")',
                'default' => 'category',
                'null' => FALSE
            ],
            'parent' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('forum');
    }

    public function down()
    {
        $this->dbforge->drop_table('forum');
    }
}
