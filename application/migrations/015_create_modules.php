<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_modules extends CI_Migration {

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
              'status' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE,
                      'default' => '1'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('modules');
      $data = array(
        array('name' => 'Discord', 'status' => '1'),
        array('name' => 'reCaptcha', 'status' => '0'),
        array('name' => 'Slideshow', 'status' => '1'),
        array('name' => 'Realm Status', 'status' => '1'),
        array('name' => 'Register', 'status' => '1'),
        array('name' => 'Login', 'status' => '1'),
        array('name' => 'Recovery', 'status' => '0'),
        array('name' => 'User Panel', 'status' => '1'),
        array('name' => 'Admin Panel', 'status' => '1'),
        array('name' => 'News', 'status' => '1'),
        array('name' => 'Forum', 'status' => '1'),
        array('name' => 'Store', 'status' => '1'),
        array('name' => 'Donation', 'status' => '1'),
        array('name' => 'Vote', 'status' => '1'),
        array('name' => 'PvP', 'status' => '1'),
        array('name' => 'Bugtracker', 'status' => '1'),
        array('name' => 'Changelogs', 'status' => '1'),
        array('name' => 'Download', 'status' => '1'),
     );
     $this->db->insert_batch('modules', $data);

    }

    public function down()
    {
      $this->dbforge->drop_table('modules');
    }
}
