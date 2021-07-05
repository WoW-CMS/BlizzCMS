<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_sessions extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '45'
            ],
            'timestamp' => [
                'type' => 'INT',
                'constraint' => '10'
            ],
            'data' => [
                'type' => 'BLOB'
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('timestamp');
        $this->dbforge->create_table('sessions');
    }

    public function down()
    {
        $this->dbforge->drop_table('sessions');
    }
}
