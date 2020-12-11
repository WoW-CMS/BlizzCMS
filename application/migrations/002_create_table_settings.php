<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_settings extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'value' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('key', TRUE);
		$this->dbforge->create_table('settings');

		$data = array(
			array('key' => 'app_name', 'value' => 'BlizzCMS'),
			array('key' => 'app_version', 'value' => '0.0.0'),
			array('key' => 'app_theme', 'value' => NULL),
			array('key' => 'facebook_url', 'value' => NULL),
			array('key' => 'twitter_url', 'value' => NULL),
			array('key' => 'youtube_url', 'value' => NULL),
			array('key' => 'discord_server_id', 'value' => NULL),
			array('key' => 'captcha_login', 'value' => 'false'),
			array('key' => 'captcha_register', 'value' => 'false'),
			array('key' => 'captcha_forgot', 'value' => 'false'),
			array('key' => 'captcha_type', 'value' => 'recaptcha'),
			array('key' => 'captcha_public', 'value' => NULL),
			array('key' => 'captcha_private', 'value' => NULL),
			array('key' => 'register_validation', 'value' => 'false'),
			array('key' => 'email_protocol', 'value' => 'mail'),
			array('key' => 'email_hostname', 'value' => NULL),
			array('key' => 'email_username', 'value' => NULL),
			array('key' => 'email_password', 'value' => NULL),
			array('key' => 'email_port', 'value' => '25'),
			array('key' => 'email_crypto', 'value' => 'tls'),
			array('key' => 'email_sender', 'value' => NULL),
			array('key' => 'email_sender_name', 'value' => NULL),
			array('key' => 'emulator', 'value' => NULL),
			array('key' => 'emulator_bnet', 'value' => 'false'),
			array('key' => 'realmlist', 'value' => NULL),
			array('key' => 'expansion', 'value' => 0),
			array('key' => 'admin_access_level', 'value' => 3),
			array('key' => 'mod_access_level', 'value' => 2)
		);
		$this->db->insert_batch('settings', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('settings');
	}
}