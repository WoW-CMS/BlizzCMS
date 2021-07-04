<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_menu extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'target' => array(
                'type' => 'ENUM("_self","_blank")',
                'default' => '_self',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'ENUM("default","dropdown")',
                'default' => 'default',
                'null' => FALSE
            ),
            'position' => array(
                'type' => 'ENUM("main","aside")',
                'default' => 'main',
                'null' => FALSE
            ),
            'parent' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'sort' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('menu');

        $data = array(
            array('name' => 'Home', 'url' => '', 'icon' => 'fas fa-home', 'target' => '_self', 'type' => 'default', 'position' => 'main', 'parent' => 0, 'sort' => 1)
        );
        $this->db->insert_batch('menu', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('menu');
    }
}
