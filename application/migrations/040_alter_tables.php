<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_tables extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_column('users', array(
			'nickname' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'after' => 'id'
			)
		));
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'nickname');
	}
}
