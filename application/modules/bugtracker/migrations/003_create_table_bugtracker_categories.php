<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_bugtracker_categories extends CI_Migration
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
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('bugtracker_categories');

		$data = array(
			array('name' => 'Achievements'),
			array('name' => 'Battle Pets'),
			array('name' => 'Battlegrounds - Arena'),
			array('name' => 'Classes'),
			array('name' => 'Creatures'),
			array('name' => 'Exploits/Usebugs'),
			array('name' => 'Garrison'),
			array('name' => 'Guilds'),
			array('name' => 'Instances'),
			array('name' => 'Items'),
			array('name' => 'Other'),
			array('name' => 'Professions'),
			array('name' => 'Quests'),
			array('name' => 'Website')
		);
		$this->db->insert_batch('bugtracker_categories', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('bugtracker_categories');
	}
}
