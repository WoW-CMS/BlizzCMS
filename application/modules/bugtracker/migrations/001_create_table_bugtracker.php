<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_bugtracker extends CI_Migration
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
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'description' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE
			),
			'url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 1
			),
			'type' => array(
				'type' => 'INT',
				'constraint' => '10',
				'default' => 1
			),
			'priority' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 1
			),
			'date' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			),
			'author' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE
			),
			'close' => array(
				'type' => 'INT',
				'constraint' => '1',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('bugtracker');
	}

	public function down()
	{
		$this->dbforge->drop_table('bugtracker');
	}
}
