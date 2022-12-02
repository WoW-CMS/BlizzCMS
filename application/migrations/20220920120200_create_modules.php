<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_modules extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'module' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'version' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->dbforge->add_key('module', true);
        $this->dbforge->create_table('modules', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->dbforge->drop_table('modules');
    }
}
