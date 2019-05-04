<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_menu extends CI_Migration {

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
              'url' => array(
                      'type' => 'TEXT',
                      'null' => FALSE
              ),
              'icon' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
              ),
              'main' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'child' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '0'
              ),
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'default' => '1'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('menu');
      $data = array(
        array('name' => 'More', 'url' => '#', 'icon' => 'fas fa-bars', 'main' => '2', 'child' => '0', 'type' => '1'),
        array('name' => 'Changelogs', 'url' => 'changelogs', 'icon' => 'fas fa-scroll', 'main' => '1', 'child' => '1', 'type' => '1'),
        array('name' => 'PvP', 'url' => 'pvp', 'icon' => 'fas fa-fist-raised', 'main' => '1', 'child' => '1', 'type' => '1'),
        array('name' => 'Forums', 'url' => 'forum', 'icon' => 'fas fa-comments', 'main' => '1', 'child' => '0', 'type' => '1'),
        array('name' => 'Store', 'url' => 'store', 'icon' => 'fas fa-store', 'main' => '1', 'child' => '0', 'type' => '1'),
      );
     $this->db->insert_batch('menu', $data);
    }

    public function down()
    {
      $this->dbforge->drop_table('menu');
    }
}
