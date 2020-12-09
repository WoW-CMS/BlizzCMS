<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_store_top extends CI_Migration
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
			'store_item' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'unique' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('store_top');
	}

	public function down()
	{
		$this->dbforge->drop_table('store_top');
	}
}
