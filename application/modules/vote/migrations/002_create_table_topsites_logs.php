<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_topsites_logs extends CI_Migration
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
			'topsite_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'points' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 1
			),
			'created_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			),
			'expired_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('topsite_id');
		$this->dbforge->add_key('user_id');
		$this->dbforge->create_table('topsites_logs');
	}

	public function down()
	{
		$this->dbforge->drop_table('topsites_logs');
	}
}
