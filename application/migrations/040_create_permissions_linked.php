<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_permissions_linked extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'group_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'default' => 0
			),
			'permission_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('group_id', TRUE);
		$this->dbforge->add_key('permission_id', TRUE);
		$this->dbforge->create_table('permissions_linked');

		$data = array(
			array('group_id' => 3, 'permission_id' => 100),
			array('group_id' => 3, 'permission_id' => 101),
			array('group_id' => 3, 'permission_id' => 102),
			array('group_id' => 3, 'permission_id' => 103),
			array('group_id' => 3, 'permission_id' => 104),
			array('group_id' => 3, 'permission_id' => 105),
			array('group_id' => 3, 'permission_id' => 106),
			array('group_id' => 3, 'permission_id' => 107),
			array('group_id' => 3, 'permission_id' => 108),
			array('group_id' => 3, 'permission_id' => 109),
			array('group_id' => 3, 'permission_id' => 110),
			array('group_id' => 3, 'permission_id' => 111),
		);
		$this->db->insert_batch('permissions_linked', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('permissions_linked');
	}
}
