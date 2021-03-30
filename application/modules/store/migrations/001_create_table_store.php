<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_store extends CI_Migration
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
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'unique' => TRUE
			),
			'type' => array(
				'type' => 'ENUM("default","accordion")',
				'default' => 'default',
				'null' => FALSE
			),
			'parent' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('store');
	}

	public function down()
	{
		$this->dbforge->drop_table('store');
	}
}
