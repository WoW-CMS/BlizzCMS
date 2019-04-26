<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_bugtracker_priority extends CI_Migration {

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
                      'constraint' => '100'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('bugtracker_priority');
      $data = array(
        array('title' => 'High'),
        array('title' => 'Medium'),
        array('title' => 'Low'),
     );
     $this->db->insert_batch('bugtracker_priority', $data);

    }

    public function down()
    {
      $this->dbforge->drop_table('bugtracker_priority');
    }
}
