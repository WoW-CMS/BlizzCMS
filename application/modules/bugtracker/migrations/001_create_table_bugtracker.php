<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_bugtracker extends CI_Migration
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
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ),
            'realm_id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'default' => 1
            ),
            'priority' => array(
                'type' => 'ENUM("low","normal","medium","high","critical")',
                'default' => 'normal',
                'null' => FALSE
            ),
            'status' => array(
                'type' => 'ENUM("open","waiting information","confirmed","in progress","invalid","fixed")',
                'default' => 'open',
                'null' => FALSE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
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
