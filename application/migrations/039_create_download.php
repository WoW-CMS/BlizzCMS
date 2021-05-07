<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_download extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'fileName' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
              'type' => array(
                      'type' => 'VARCHAR',
					  'constraint' => '10',
                      'null' => FALSE
              ),
              'weight' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
              'category' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '1'
              ),
              'image' => array(
                      'type' => 'TEXT',
                      'unsigned' => TRUE
              ),
              'url' => array(
                      'type' => 'TEXT',
                      'unsigned' => TRUE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('download');
      
    }

    public function down()
    {
      $this->dbforge->drop_table('download');
    }
}