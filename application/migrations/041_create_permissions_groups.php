<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_permissions_groups extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'default' => 0
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('permissions_groups');

		$data = array(
			array('id' => 0, 'name' => 'Guest'),
			array('id' => 1, 'name' => 'Player'),
			array('id' => 2, 'name' => 'Game Master'),
			array('id' => 3, 'name' => 'Administrator')
		);
		$this->db->insert_batch('permissions_groups', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('permissions_groups');
	}
}
