<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_store_top extends CI_Migration {

    public function up()
    {
      $this->dbforge->modify_column('store_top', array(
              'id_store' => array(
                      'name' => 'store_item',
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'unique' => TRUE
              ),
      ));
    }

    public function down()
    {
      $this->dbforge->modify_column('store_top', array(
              'store_item' => array(
                      'name' => 'id_store',
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'unique' => FALSE
              ),
      ));
    }
}
