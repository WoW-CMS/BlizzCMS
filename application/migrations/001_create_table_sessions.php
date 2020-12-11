<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_sessions extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '45'
			),
			'timestamp' => array(
				'type' => 'INT',
				'constraint' => '10'
			),
			'data' => array(
				'type' => 'BLOB'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('timestamp');
		$this->dbforge->create_table('sessions');
	}

	public function down()
	{
		$this->dbforge->drop_table('sessions');
	}
}
