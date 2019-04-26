<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_forum_replies extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'topic' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'author' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'commentary' => array(
                      'type' => 'TEXT'
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('forum_replies');
    }

    public function down()
    {
      $this->dbforge->drop_table('forum_replies');
    }
}
