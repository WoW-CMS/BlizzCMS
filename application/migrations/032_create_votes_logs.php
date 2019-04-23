<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_votes_logs extends CI_Migration {

    public function up()
    {
      $this->dbforge->add_field(array(
              'id' => array(
                      'type' => 'INT',
                      'constraint' => '10',
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
              ),
              'idaccount' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'idvote' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'points' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'lasttime' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
              'expired_at' => array(
                      'type' => 'INT',
                      'constraint' => '10',
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('votes_logs');
    }

    public function down()
    {
      $this->dbforge->drop_table('votes_logs');
    }
}
