<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_slides extends CI_Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'type' => [
                'type' => 'ENUM("image","video","iframe")',
                'default' => 'image',
                'null' => FALSE
            ],
            'route' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'sort' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('slides');

        $this->db->insert_batch('slides', [
            ['title' => 'BlizzCMS', 'description' => 'Check our constant updates!', 'type' => 'image', 'route' => 'slide1.jpg', 'sort' => 1],
            ['title' => 'Vote Now', 'description' => 'Each vote will be rewarded!', 'type' => 'image', 'route' => 'slide2.jpg', 'sort' => 2]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('slides');
    }
}
