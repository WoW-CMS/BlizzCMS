<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_users extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_column('users', array(
			'rank' => array(
				'type' => 'INT',
				'constraint' => '10',
				'default' => '1',
				'after' => 'joindate'
			)
		));
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'rank');
	}
}
