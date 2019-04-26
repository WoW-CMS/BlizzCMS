<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_donate_logs extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE,
                      'null' => FALSE
              ),
              'user_id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'null' => FALSE
              ),
              'payment_id' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'hash' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'total' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '10',
                      'null' => FALSE
              ),
              'points' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'null' => FALSE,
                      'default' => '0'
              ),
              'create_time' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'status' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE,
                      'null' => FALSE,
                      'default' => '0'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('donate_logs');
    }

    public function down()
    {
      $this->dbforge->drop_table('donate_logs');
    }
}
