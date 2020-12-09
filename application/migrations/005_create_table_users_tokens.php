<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_users_tokens extends CI_Migration
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
			'chooser' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'hash' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'type' => array(
				'type' => 'ENUM("validation","password")',
				'default' => 'validation',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			),
			'expired_at' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users_tokens');
	}

	public function down()
	{
		$this->dbforge->drop_table('users_tokens');
	}
}
