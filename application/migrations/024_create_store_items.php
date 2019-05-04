<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_store_items extends CI_Migration {

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
                      'constraint' => '150'
              ),
              'category' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'null' => FALSE
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'null' => FALSE
              ),
              'price_dp' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'price_vp' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'itemid' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'icon' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
              ),
              'image' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'default' => 'item1.jpg'
              ),
              'qquery' => array(
                      'type' => 'TEXT',
                      'null' => TRUE
              )

      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('store_items');
    }

    public function down()
    {
      $this->dbforge->drop_table('store_items');
    }
}
