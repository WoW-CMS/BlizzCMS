<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_mod_logs extends CI_Migration
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
			'topic_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'type' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE
			),
			'function' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'annotation' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE
			),
			'created_at' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('mod_logs');
	}

	public function down()
	{
		$this->dbforge->drop_table('mod_logs');
	}
}
