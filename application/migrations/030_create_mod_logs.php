<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_mod_logs extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'userid' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'idtopic' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'function' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255',
                      'unsigned' => TRUE
              ),
              'annotation' => array(
                      'type' => 'TEXT',
              ),
              'datetime' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('mod_logs');
    }

    public function down()
    {
      $this->dbforge->drop_table('mod_logs');
    }
}
