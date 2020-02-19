<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_store_menu extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_column('store_categories', array(
              'main' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'default' => '1',
                      'after' => 'name'
              ),
              'father' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'null' => FALSE,
                      'after' => 'name'
              )
      ));
    }

    public function down()
    {
      $this->dbforge->drop_column('store_categories', 'main');
      $this->dbforge->drop_column('store_categories', 'father');
    }
}
