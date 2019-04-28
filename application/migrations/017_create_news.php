<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_news extends CI_Migration {

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
              'description' => array(
                      'type' => 'TEXT',
                      'null' => FALSE
              ),
              'image' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
              'date' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('news');
      $data = array(
        array('title' => 'Welcome to your new website!', 'description' => '<!DOCTYPE html><html><head></head><body><p>Your site has been installed successfully. To continue, sign in with your account and go to the administration panel to have access to all the features provided. don\'t forget that if you have problems you can contact us by <a title=\"WoW-CMS\" href=\"https://discord.gg/vZG9vpS\" target=\"_blank\" rel=\"noopener\">Discord</a></p></body></html>', 'image' => 'news.jpg', 'date' => '1551283156'),
      );
     $this->db->insert_batch('news', $data);
    }

    public function down()
    {
      $this->dbforge->drop_table('news');
    }
}
