<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_store_categories extends CI_Migration
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
			),
			'father' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			),
			'main' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 1
			),
			'route' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'unique' => TRUE
			),
			'realmid' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('store_categories');
	}

	public function down()
	{
		$this->dbforge->drop_table('store_categories');
	}
}
