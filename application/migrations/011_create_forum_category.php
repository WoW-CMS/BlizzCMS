<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_forum_category extends CI_Migration {

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
                      'constraint' => '100'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('forum_category');
    }

    public function down()
    {
      $this->dbforge->drop_table('forum_category');
    }
}
