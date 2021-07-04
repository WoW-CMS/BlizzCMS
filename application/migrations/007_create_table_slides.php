<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_slides extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'type' => array(
                'type' => 'ENUM("image","video","iframe")',
                'default' => 'image',
                'null' => FALSE
            ),
            'route' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'sort' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('slides');

        $data = array(
            array('title' => 'BlizzCMS', 'description' => 'Check our constant updates!', 'type' => 'image', 'route' => 'slide1.jpg', 'sort' => 1),
            array('title' => 'Vote Now', 'description' => 'Each vote will be rewarded!', 'type' => 'image', 'route' => 'slide2.jpg', 'sort' => 2)
        );
        $this->db->insert_batch('slides', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('slides');
    }
}
