<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_modules extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'module' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            )
        ));
        $this->dbforge->add_key('module', TRUE);
        $this->dbforge->create_table('modules');
    }

    public function down()
    {
        $this->dbforge->drop_table('modules');
    }
}
