<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_store_logs extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'accountid' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'charid' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'item_name' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '150'
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'price_type' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
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
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('store_logs');
    }

    public function down()
    {
      $this->dbforge->drop_table('store_logs');
    }
}
