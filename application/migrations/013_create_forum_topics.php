<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_forum_topics extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'forums' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'title' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
              'author' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE
              ),
              'content' => array(
                      'type' => 'TEXT',
                      'null' => FALSE
              ),
              'locked' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'pinned' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('forum_topics');
    }

    public function down()
    {
      $this->dbforge->drop_table('forum_topics');
    }
}
