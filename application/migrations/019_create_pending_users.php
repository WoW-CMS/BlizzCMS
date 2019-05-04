<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_pending_users extends CI_Migration {

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
                      'null' => FALSE
              ),
              'email' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'password' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'password_bnet' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'expansion' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'joindate' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('pending_users');
    }

    public function down()
    {
      $this->dbforge->drop_table('pending_users');
    }
}
