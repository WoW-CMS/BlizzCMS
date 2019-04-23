<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_bugtracker extends CI_Migration {

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
              ),
              'description' => array(
                      'type' => 'TEXT',
              ),
              'url' => array(
                      'type' => 'TEXT',
              ),
              'status' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'default' => '1',
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'default' => '1',
              ),
              'priority' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'default' => '1',
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'author' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'close' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'default' => '0',
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('bugtracker');
    }

    public function down()
    {
      $this->dbforge->drop_table('bugtracker');
    }
}
