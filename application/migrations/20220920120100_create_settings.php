<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_settings extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'type' => [
                'type' => 'ENUM("bool","float","int","string")',
                'default' => 'string'
            ]
        ]);
        $this->dbforge->add_key('key', true);
        $this->dbforge->create_table('settings', false, ['ENGINE' => 'InnoDB']);

        $this->setting_model->insert_batch([
            ['key' => 'app_name', 'value' => 'BlizzCMS', 'type' => 'string'],
            ['key' => 'app_theme', 'value' => NULL, 'type' => 'string'],
            ['key' => 'app_language', 'value' => 'english', 'type' => 'string'],
            ['key' => 'app_supported_languages', 'value' => '[]', 'type' => 'string'],
            ['key' => 'app_expansion', 'value' => '0', 'type' => 'int'],
            ['key' => 'app_emulator', 'value' => NULL, 'type' => 'string'],
            ['key' => 'app_emulator_bnet', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'app_realmlist', 'value' => NULL, 'type' => 'string'],
            ['key' => 'social_discord', 'value' => NULL, 'type' => 'string'],
            ['key' => 'social_facebook', 'value' => NULL, 'type' => 'string'],
            ['key' => 'social_twitter', 'value' => NULL, 'type' => 'string'],
            ['key' => 'social_youtube', 'value' => NULL, 'type' => 'string'],
            ['key' => 'show_register_page', 'value' => 'true', 'type' => 'bool'],
            ['key' => 'show_forgot_page', 'value' => 'true', 'type' => 'bool'],
            ['key' => 'avatar_max_size', 'value' => '2048', 'type' => 'int'],
            ['key' => 'avatar_api_background', 'value' => '#0d77d5', 'type' => 'string'],
            ['key' => 'avatar_api_color', 'value' => '#ffffff', 'type' => 'string'],
            ['key' => 'captcha_login_page', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'captcha_register_page', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'captcha_forgot_page', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'captcha_type', 'value' => NULL, 'type' => 'string'],
            ['key' => 'captcha_size', 'value' => NULL, 'type' => 'string'],
            ['key' => 'captcha_theme', 'value' => NULL, 'type' => 'string'],
            ['key' => 'captcha_sitekey', 'value' => NULL, 'type' => 'string'],
            ['key' => 'captcha_secretkey', 'value' => NULL, 'type' => 'string'],
            ['key' => 'comments_per_page', 'value' => '25', 'type' => 'int'],
            ['key' => 'comments_min_length', 'value' => '10', 'type' => 'int'],
            ['key' => 'comments_max_length', 'value' => '1000', 'type' => 'int'],
            ['key' => 'articles_max_recently', 'value' => '5', 'type' => 'int'],
            ['key' => 'articles_per_page', 'value' => '25', 'type' => 'int'],
            ['key' => 'mailer_protocol', 'value' => 'mail', 'type' => 'string'],
            ['key' => 'mailer_hostname', 'value' => NULL, 'type' => 'string'],
            ['key' => 'mailer_username', 'value' => NULL, 'type' => 'string'],
            ['key' => 'mailer_password', 'value' => NULL, 'type' => 'string'],
            ['key' => 'mailer_port', 'value' => '25', 'type' => 'int'],
            ['key' => 'mailer_encryption', 'value' => NULL, 'type' => 'string'],
            ['key' => 'mailer_from_email', 'value' => NULL, 'type' => 'string'],
            ['key' => 'mailer_from_name', 'value' => NULL, 'type' => 'string'],
            ['key' => 'mailer_account_confirmation', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'seo_tags', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'seo_og_tags', 'value' => 'false', 'type' => 'bool'],
            ['key' => 'seo_description_tag', 'value' => NULL, 'type' => 'string'],
            ['key' => 'seo_image_tag', 'value' => NULL, 'type' => 'string']
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('settings');
    }
}
