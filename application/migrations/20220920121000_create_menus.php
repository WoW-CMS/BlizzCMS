<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_menus extends CI_Migration
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
        $this->dbforge->create_table('menus', false, ['ENGINE' => 'InnoDB']);

        $this->menu_model->insert_batch([
            ['name' => 'main', 'description' => 'Menu displayed in the header of the layout'],
            ['name' => 'panel', 'description' => 'Menu displayed in the user panel']
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('menus');
    }
}
