<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_pages extends CI_Migration
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
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE,
				'unique' => TRUE
			),
			'date' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('pages');
	}

	public function down()
	{
		$this->dbforge->drop_table('pages');
	}
}
