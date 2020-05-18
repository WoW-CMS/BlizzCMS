<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_permissions extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'permission' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE,
				'unique' => TRUE
			),
			'category' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => NULL
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('permissions');

		$data = array(
			array('id' => 100, 'permission' => 'ACP', 'key' => 'acp', 'category' => 'admin'),
			array('id' => 101, 'permission' => 'ACP Settings', 'key' => 'acp.settings', 'category' => 'admin'),
			array('id' => 102, 'permission' => 'ACP Realms', 'key' => 'acp.realms', 'category' => 'admin'),
			array('id' => 103, 'permission' => 'ACP Users', 'key' => 'acp.users', 'category' => 'admin'),
			array('id' => 104, 'permission' => 'ACP Menu', 'key' => 'acp.menu', 'category' => 'admin'),
			array('id' => 105, 'permission' => 'ACP Slides', 'key' => 'acp.slides', 'category' => 'admin'),
			array('id' => 106, 'permission' => 'ACP News', 'key' => 'acp.news', 'category' => 'admin'),
			array('id' => 107, 'permission' => 'ACP Pages', 'key' => 'acp.pages', 'category' => 'admin'),
			array('id' => 108, 'permission' => 'ACP Store', 'key' => 'acp.store', 'category' => 'admin'),
			array('id' => 109, 'permission' => 'ACP Donate', 'key' => 'acp.donate', 'category' => 'admin'),
			array('id' => 110, 'permission' => 'ACP Topsites', 'key' => 'acp.topsites', 'category' => 'admin'),
			array('id' => 111, 'permission' => 'ACP Forum', 'key' => 'acp.forum', 'category' => 'admin'),
			array('id' => 112, 'permission' => 'ACP Modules', 'key' => 'acp.modules', 'category' => 'admin'),
			array('id' => 113, 'permission' => 'ACP Changelogs', 'key' => 'acp.devlog', 'category' => 'admin'),
			array('id' => 114, 'permission' => 'MOD CP', 'key' => 'mod', 'category' => 'mod'),
			array('id' => 115, 'permission' => 'MOD Options', 'key' => 'mod.options', 'category' => 'mod')
		);
		$this->db->insert_batch('permissions', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('permissions');
	}
}
