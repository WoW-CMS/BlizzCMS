<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_chars_annotations extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'idchar' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'null' => FALSE,
              ),
              'annotation' => array(
                      'type' => 'TEXT',
                      'null' => FALSE,
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'realmid' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'null' => FALSE,
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('chars_annotations');
    }

    public function down()
    {
      $this->dbforge->drop_table('chars_annotations');
    }
}
