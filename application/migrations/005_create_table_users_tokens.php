<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_users_tokens extends CI_Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'chooser' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'type' => [
                'type' => 'ENUM("validation","password")',
                'default' => 'validation',
                'null' => FALSE
            ],
            'data' => [
                'type' => 'JSON',
                'default' => '\'\''
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'expired_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('users_tokens');
    }

    public function down()
    {
        $this->dbforge->drop_table('users_tokens');
    }
}
