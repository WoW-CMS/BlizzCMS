<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_realms extends CI_Migration
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
            'realm_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'realm_capacity' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'default' => 100
            ],
            'char_hostname' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => '127.0.0.1'
            ],
            'char_username' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'char_password' => [
                'type' => 'TEXT'
            ],
            'char_database' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'characters'
            ],
            'char_port' => [
                'type' => 'SMALLINT',
                'constraint' => 6,
                'unsigned' => TRUE,
                'default' => 3306
            ],
            'console_hostname' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'console_username' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'console_password' => [
                'type' => 'TEXT'
            ],
            'console_port' => [
                'type' => 'SMALLINT',
                'constraint' => 6,
                'unsigned' => TRUE,
                'default' => 7878
            ],
            'realm_hostname' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'realm_port' => [
                'type' => 'SMALLINT',
                'constraint' => 6,
                'unsigned' => TRUE,
                'default' => 8085
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('realms', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->dbforge->drop_table('realms');
    }
}
