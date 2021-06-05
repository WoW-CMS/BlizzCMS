<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_changelogs extends CI_Migration
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('changelogs');
    }

    public function down()
    {
        $this->dbforge->drop_table('changelogs');
    }
}
