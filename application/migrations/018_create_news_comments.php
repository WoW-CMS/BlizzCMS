<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_news_comments extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'id_new' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'commentary' => array(
                      'type' => 'TEXT',
                      'null' => FALSE
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'author' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('news_comments');
    }

    public function down()
    {
      $this->dbforge->drop_table('news_comments');
    }
}
