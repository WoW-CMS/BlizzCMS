<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_avatars extends CI_Migration {

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
              'type' => array(
                      'type' => 'INT',
                      'constraint' => '1',
                      'unsigned' => TRUE,
                      'default' => '1',
                      'comment' => '1 = User | 2 = staff'
              ),
      ));
      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->create_table('avatars');

      $data = array(
        array('name' => 'default.png', 'type' => '1'),
        array('name' => 'arthas.png', 'type' => '1'),
        array('name' => 'deathwing.png', 'type' => '1'),
        array('name' => 'garrosh.png', 'type' => '1'),
        array('name' => 'ghoul.png', 'type' => '1'),
        array('name' => 'hogger.png', 'type' => '1'),
        array('name' => 'illidan.png', 'type' => '1'),
        array('name' => 'kelthuzad.png', 'type' => '1'),
        array('name' => 'kiljeaden.png', 'type' => '1'),
        array('name' => 'lurker.png', 'type' => '1'),
        array('name' => 'maiev.png', 'type' => '1'),
        array('name' => 'malfurion.png', 'type' => '1'),
        array('name' => 'neptulon.png', 'type' => '1'),
        array('name' => 'nerzhul.png', 'type' => '1'),
        array('name' => 'velen.png', 'type' => '1'),
        array('name' => 'worgen.png', 'type' => '1'),
        array('name' => 'imp.png', 'type' => '1'),
        array('name' => 'vault_guardian.png', 'type' => '1'),
      );
      $this->db->insert_batch('avatars', $data);

    }

    public function down()
    {
      $this->dbforge->drop_table('avatars');
    }
}
