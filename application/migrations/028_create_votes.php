<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_votes extends CI_Migration {

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
                      'constraint' => '100'
              ),
              'url' => array(
                      'type' => 'TEXT'
              ),
              'time' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'points' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'image' => array(
                      'type' => 'TEXT'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('votes');
    }

    public function down()
    {
      $this->dbforge->drop_table('votes');
    }
}
