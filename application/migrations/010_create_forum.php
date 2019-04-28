<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_forum extends CI_Migration {

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
              'name' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'category' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'null' => FALSE
              ),
              'description' => array(
                      'type' => 'TEXT',
                      'null' => FALSE
              ),
              'icon' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100',
                      'null' => FALSE
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE,
                      'comment' => '1 = everyone | 2 = staff | 3 = staff post + everyone see',
                      'null' => FALSE,
                      'default' => '1'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('forum');
    }

    public function down()
    {
      $this->dbforge->drop_table('forum');
    }
}
