<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_ranks_default extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'comment' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE,
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('ranks_default');
      $data = array(
        array('comment' => 'Rank Admin'),
        array('comment' => 'Rank Visitor'),
        array('comment' => 'Rank User'),
      );
      $this->db->insert_batch('ranks_default', $data);
    }

    public function down()
    {
      $this->dbforge->drop_table('ranks_default');
    }
}
