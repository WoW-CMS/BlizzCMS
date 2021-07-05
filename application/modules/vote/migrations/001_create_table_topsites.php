<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_topsites extends CI_Migration
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
            'time' => [
                'type' => 'TINYINT',
                'constraint' => '3',
                'unsigned' => TRUE,
                'default' => 1
            ],
            'points' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 1
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('topsites');
    }

    public function down()
    {
        $this->dbforge->drop_table('topsites');
    }
}
