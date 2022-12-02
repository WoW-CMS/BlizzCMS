<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_pageviews extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'uri' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'platform' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'browser' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'is_mobile' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->create_table('pageviews', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->dbforge->drop_table('pageviews');
    }
}
