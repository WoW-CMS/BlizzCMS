<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_avatars extends CI_Migration
{
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
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('avatars');

		$data = array(
			array('name' => 'default.png'),
			array('name' => 'arthas.png'),
			array('name' => 'deathwing.png'),
			array('name' => 'garrosh.png'),
			array('name' => 'ghoul.png'),
			array('name' => 'hogger.png'),
			array('name' => 'illidan.png'),
			array('name' => 'kelthuzad.png'),
			array('name' => 'kiljeaden.png'),
			array('name' => 'lurker.png'),
			array('name' => 'maiev.png'),
			array('name' => 'malfurion.png'),
			array('name' => 'neptulon.png'),
			array('name' => 'nerzhul.png'),
			array('name' => 'velen.png'),
			array('name' => 'worgen.png'),
			array('name' => 'imp.png'),
			array('name' => 'vault_guardian.png')
		);
		$this->db->insert_batch('avatars', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('avatars');
	}
}
