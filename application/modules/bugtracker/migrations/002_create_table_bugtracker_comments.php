<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_bugtracker_comments extends CI_Migration
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
			'bug_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'commentary' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('bug_id');
		$this->dbforge->add_key('user_id');
		$this->dbforge->create_table('bugtracker_comments');
	}

	public function down()
	{
		$this->dbforge->drop_table('bugtracker_comments');
	}
}
