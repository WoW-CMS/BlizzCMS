<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_slides extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'title' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'description' => array(
                      'type' => 'TEXT',
                      'null' => FALSE
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE
              ),
              'route' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('slides');
      $data = array(
        array('title' => 'BlizzCMS', 'description' => 'Check our constant updates!', 'type' => '1', 'route' => 'slide1.jpg'),
        array('title' => 'Vote Now', 'description' => 'Each vote will be rewarded!', 'type' => '1', 'route' => 'slide2.jpg'),
      );
      $this->db->insert_batch('slides', $data);
    }

    public function down()
    {
      $this->dbforge->drop_table('slides');
    }
}
