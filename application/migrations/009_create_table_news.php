<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_news extends CI_Migration
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
			'image' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'comments' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'unsigned' => TRUE,
				'default' => 0
			),
			'created_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('news');

		$data = array(
			array('title' => 'Welcome to your new website!', 'description' => '<p>Your site has been installed successfully. To continue, sign in with your account and go to the administration panel to have access to all the features provided. don\'t forget that if you have problems you can contact us on <a href="https://wow-cms.com">WoW-CMS</a></p>', 'image' => 'news.jpg', 'comments' => 1, 'created_at' => '2021-05-23 12:00:00')
		);
		$this->db->insert_batch('news', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('news');
	}
}
