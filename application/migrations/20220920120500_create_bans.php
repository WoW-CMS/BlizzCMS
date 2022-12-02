<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_bans extends CI_Migration
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
            'type' => [
                'type' => 'ENUM("email","ip","user")'
            ],
            'value' => [
                'type' => 'TEXT'
            ],
            'reason' => [
                'type' => 'MEDIUMTEXT'
            ],
            'start_at' => [
                'type' => 'DATETIME',
                'default' => '0000-00-00 00:00:00'
            ],
            'end_at' => [
                'type' => 'DATETIME',
                'default' => '0000-00-00 00:00:00'
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('value');
        $this->dbforge->create_table('bans', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->dbforge->drop_table('bans');
    }
}
