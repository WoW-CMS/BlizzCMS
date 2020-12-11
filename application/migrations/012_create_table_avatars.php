<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_avatars extends CI_Migration
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
			'image' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('avatars');

		$data = array(
			array('image' => 'default.png'),
			array('image' => 'arthas.png'),
			array('image' => 'deathwing.png'),
			array('image' => 'garrosh.png'),
			array('image' => 'ghoul.png'),
			array('image' => 'hogger.png'),
			array('image' => 'illidan.png'),
			array('image' => 'kelthuzad.png'),
			array('image' => 'kiljeaden.png'),
			array('image' => 'lurker.png'),
			array('image' => 'maiev.png'),
			array('image' => 'malfurion.png'),
			array('image' => 'neptulon.png'),
			array('image' => 'nerzhul.png'),
			array('image' => 'velen.png'),
			array('image' => 'worgen.png'),
			array('image' => 'imp.png'),
			array('image' => 'vault_guardian.png')
		);
		$this->db->insert_batch('avatars', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('avatars');
	}
}
