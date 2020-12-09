<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_modules extends CI_Migration
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
				'null' => FALSE,
				'unique' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('modules');
	}

	public function down()
	{
		$this->dbforge->drop_table('modules');
	}
}
