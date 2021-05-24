<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_logs extends CI_Migration
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
			'user_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'message' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE
			),
			'created_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('user_id');
		$this->dbforge->create_table('logs');
	}

	public function down()
	{
		$this->dbforge->drop_table('logs');
	}
}
