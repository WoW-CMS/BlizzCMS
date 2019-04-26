<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_changelogs extends CI_Migration {

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
              'description' => array(
                      'type' => 'TEXT'
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              )
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('changelogs');
    }

    public function down()
    {
      $this->dbforge->drop_table('changelogs');
    }
}
