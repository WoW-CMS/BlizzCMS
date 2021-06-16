<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_store_items extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_column('store_items', array(
              'item_set' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'default' => '0',
                      'null' => TRUE
              ),
      ));
    }

    public function down()
    {
      $this->dbforge->drop_column('store_items', 'item_set');
    }
}
