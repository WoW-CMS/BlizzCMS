<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_bugtracker_replied extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'idlink' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
              'description' => array(
                      'type' => 'TEXT'
              ),
              'author' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('bugtracker_replied');
    }

    public function down()
    {
      $this->dbforge->drop_table('bugtracker_replied');
    }
}
