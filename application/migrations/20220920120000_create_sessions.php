<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_sessions extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ],
            'timestamp' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 0
            ],
            'data' => [
                'type' => 'BLOB'
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('timestamp');
        $this->dbforge->create_table('sessions', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->dbforge->drop_table('sessions');
    }
}
