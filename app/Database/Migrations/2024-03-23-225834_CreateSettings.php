<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettings extends Migration
{
    public function up()
    {
        $model = new \App\Models\Setting();
        $this->forge->addField([
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM("bool", "int", "float", "string")',
                'default' => 'string',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('key', true);
        $this->forge->createTable('settings', false, ['ENGINE' => 'InnoDB']);

        $model->insertBatch([
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
        $this->forge->dropTable('settings');
    }
}
