<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_slides extends CI_Migration
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
				'type' => 'TEXT',
				'null' => TRUE
			),
			'type' => array(
				'type' => 'ENUM("image","video","iframe")',
				'default' => 'image',
				'null' => FALSE
			),
			'route' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('slides');

		$data = array(
			array('title' => 'BlizzCMS', 'description' => 'Check our constant updates!', 'type' => 'image', 'route' => 'slide1.jpg'),
			array('title' => 'Vote Now', 'description' => 'Each vote will be rewarded!', 'type' => 'image', 'route' => 'slide2.jpg')
		);
		$this->db->insert_batch('slides', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('slides');
	}
}
