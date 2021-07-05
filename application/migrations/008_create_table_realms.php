<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_realms extends CI_Migration
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
            'max_cap' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 100
            ],
            'char_hostname' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => '127.0.0.1'
            ],
            'char_username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'char_password' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'char_database' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'characters'
            ],
            'char_port' => [
                'type' => 'SMALLINT',
                'constraint' => '6',
                'unsigned' => TRUE,
                'default' => 3306
            ],
            'console_hostname' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'console_username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'console_password' => [
                'type' => 'TEXT',
                'null' => FALSE
            ],
            'console_port' => [
                'type' => 'SMALLINT',
                'constraint' => '6',
                'unsigned' => TRUE,
                'default' => 7878
            ],
            'realm_hostname' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'realm_port' => [
                'type' => 'SMALLINT',
                'constraint' => '6',
                'unsigned' => TRUE,
                'default' => 8085
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('realms');
    }

    public function down()
    {
        $this->dbforge->drop_table('realms');
    }
}
