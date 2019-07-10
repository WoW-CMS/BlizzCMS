<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_store_categories extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_column('store_categories', array(
              'route' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '150',
                      'null' => FALSE,
                      'unique' => TRUE,
                      'after' => 'name'
              ),
              'realmid' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0',
                      'after' => 'route'
              ),
      ));
    }

    public function down()
    {
      $this->dbforge->drop_column('store_categories', 'route');
      $this->dbforge->drop_column('store_categories', 'realmid');
    }
}
