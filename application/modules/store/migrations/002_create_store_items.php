<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_store_items extends CI_Migration {

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
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'category' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'price_type' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			),
			'type' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 1
			),
			'dp' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			),
			'vp' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => 0
			),
			'icon' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'command' => array(
				'type' => 'TEXT',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('store_items');
	}

	public function down()
	{
		$this->dbforge->drop_table('store_items');
	}
}
