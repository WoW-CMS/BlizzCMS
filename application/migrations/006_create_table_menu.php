<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_menu extends CI_Migration
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
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'target' => [
                'type' => 'ENUM("_self","_blank")',
                'default' => '_self',
                'null' => FALSE
            ],
            'type' => [
                'type' => 'ENUM("default","dropdown")',
                'default' => 'default',
                'null' => FALSE
            ],
            'position' => [
                'type' => 'ENUM("main","aside")',
                'default' => 'main',
                'null' => FALSE
            ],
            'parent' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'sort' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('menu');

        $this->db->insert_batch('menu', [
            ['name' => 'Home', 'url' => '', 'icon' => 'fas fa-home', 'target' => '_self', 'type' => 'default', 'position' => 'main', 'parent' => 0, 'sort' => 1]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('menu');
    }
}
