<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_bugtracker_status extends CI_Migration {

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
      $this->dbforge->create_table('bugtracker_status');
      $data = array(
        array('title' => 'New Report'),
        array('title' => 'Waiting more information'),
        array('title' => 'Report confirmed'),
        array('title' => 'In progress'),
        array('title' => 'Fix need test'),
        array('title' => 'Fix need review'),
        array('title' => 'Invalid'),
        array('title' => 'Resolved'),
     );
     $this->db->insert_batch('bugtracker_status', $data);

    }

    public function down()
    {
      $this->dbforge->drop_table('bugtracker_status');
    }
}
