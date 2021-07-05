<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_bugtracker_comments extends CI_Migration
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
            'report_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'commentary' => [
                'type' => 'TEXT',
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('report_id');
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('bugtracker_comments');
    }

    public function down()
    {
        $this->dbforge->drop_table('bugtracker_comments');
    }
}
