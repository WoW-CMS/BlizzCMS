<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_settings extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('key', true);
        $this->dbforge->create_table('settings');

        $this->db->insert_batch('settings', [
            ['key' => 'app_name', 'value' => 'BlizzCMS'],
            ['key' => 'app_version', 'value' => '1.1.0'],
            ['key' => 'app_theme', 'value' => NULL],
            ['key' => 'facebook_url', 'value' => NULL],
            ['key' => 'twitter_url', 'value' => NULL],
            ['key' => 'youtube_url', 'value' => NULL],
            ['key' => 'discord_server_id', 'value' => NULL],
            ['key' => 'captcha_login', 'value' => 'false'],
            ['key' => 'captcha_register', 'value' => 'false'],
            ['key' => 'captcha_forgot', 'value' => 'false'],
            ['key' => 'captcha_type', 'value' => NULL],
            ['key' => 'captcha_theme', 'value' => NULL],
            ['key' => 'captcha_public', 'value' => NULL],
            ['key' => 'captcha_private', 'value' => NULL],
            ['key' => 'mail_validation', 'value' => 'false'],
            ['key' => 'mail_mailer', 'value' => NULL],
            ['key' => 'mail_hostname', 'value' => NULL],
            ['key' => 'mail_username', 'value' => NULL],
            ['key' => 'mail_password', 'value' => NULL],
            ['key' => 'mail_port', 'value' => NULL],
            ['key' => 'mail_encryption', 'value' => NULL],
            ['key' => 'mail_sender', 'value' => NULL],
            ['key' => 'emulator', 'value' => NULL],
            ['key' => 'emulator_bnet', 'value' => 'false'],
            ['key' => 'realmlist', 'value' => NULL],
            ['key' => 'expansion', 'value' => NULL],
            ['key' => 'admin_access_level', 'value' => '3'],
            ['key' => 'mod_access_level', 'value' => '2'],
            ['key' => 'seo_meta', 'value' => 'false'],
            ['key' => 'seo_meta_description', 'value' => NULL],
            ['key' => 'seo_meta_keywords', 'value' => NULL]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('settings');
    }
}