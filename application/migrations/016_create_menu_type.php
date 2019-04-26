<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_menu_type extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'title' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('menu_type');
      $data = array(
        array('title' => 'Internal URL'),
        array('title' => 'External URL'),
     );
     $this->db->insert_batch('menu_type', $data);

    }

    public function down()
    {
      $this->dbforge->drop_table('menu_type');
    }
}
