<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'username' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
              ),
              'email' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
              ),
              'joindate' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'profile' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '1'
              ),
              'dp' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'vp' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('users');
    }

    public function down()
    {
      $this->dbforge->drop_table('users');
    }
}
