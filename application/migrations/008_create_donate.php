<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_donate extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'name' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'price' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '10',
                      'null' => FALSE
              ),
              'tax' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '10',
                      'default' => '0.00',
                      'null' => FALSE
              ),
              'points' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'null' => FALSE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('donate');
      $data = array(
        array('name' => 'Simple', 'price' => '10.00', 'tax' => '0.00', 'points' => '20'),
        array('name' => 'Normal', 'price' => '20.00', 'tax' => '2.00', 'points' => '22'),
        array('name' => 'Professional', 'price' => '30.00', 'tax' => '0.00', 'points' => '40'),
     );
     $this->db->insert_batch('donate', $data);

    }

    public function down()
    {
      $this->dbforge->drop_table('donate');
    }
}
