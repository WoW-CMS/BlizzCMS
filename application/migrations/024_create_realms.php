<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_realms extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'hostname' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'default' => '127.0.0.1'
              ),
              'username' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'null' => FALSE
              ),
              'password' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'null' => TRUE
              ),
              'char_database' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'null' => FALSE
              ),
              'realmID' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'console_hostname' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'default' => '127.0.0.1'
              ),
              'console_username' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'null' => FALSE
              ),
              'console_password' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'null' => FALSE
              ),
              'console_port' => array(
                      'type' => 'INT',
                      'constraint' => '6',
                      'unsigned' => TRUE,
                      'default' => '7878'
              ),
              'emulator' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'default' => 'TC'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('realms');
    }

    public function down()
    {
      $this->dbforge->drop_table('realms');
    }
}
