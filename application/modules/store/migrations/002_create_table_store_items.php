<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_store_items extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'store_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
			),
			'realm_id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'unsigned' => TRUE
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
			'image' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'price_type' => array(
				'type' => 'ENUM("vp","dp")',
				'default' => 'vp',
				'null' => FALSE
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
			'top' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'unsigned' => TRUE,
				'default' => 0
			),
			'command' => array(
				'type' => 'TEXT',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('store_id');
		$this->dbforge->add_key('realm_id');
		$this->dbforge->create_table('store_items');
	}

	public function down()
	{
		$this->dbforge->drop_table('store_items');
	}
}
