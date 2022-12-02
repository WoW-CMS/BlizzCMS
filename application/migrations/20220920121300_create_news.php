<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_news extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'summary' => [
                'type' => 'TEXT'
            ],
            'content' => [
                'type' => 'MEDIUMTEXT'
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'image' => [
                'type' => 'TEXT'
            ],
            'comments' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'views' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'meta_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => ''
            ],
            'meta_robots' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'index, follow'
            ],
            'discuss' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('news', false, ['ENGINE' => 'InnoDB']);

        $this->news_model->insert_batch([
            ['title' => 'Hello world!', 'summary' => 'Welcome to your new website with BlizzCMS. To edit or delete this first news article sign in with your account and go to the admin panel.', 'content' => '<p>Welcome to your new website with <strong>BlizzCMS</strong>. To edit or delete this first news article sign in with your account and go to the admin panel. Don\'t forget that if you have any problems you can open an <a href="https://github.com/WoW-CMS/BlizzCMS/issues">issue</a> in our repository or contact us in our <a href="https://discord.wow-cms.com">discord</a>.</p>', 'slug' => 'hello-world', 'image' => '2022/11/410943a905e887277d0d803bdee2e2f5.jpg', 'meta_robots' => 'index, follow', 'discuss' => 1]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('news');
    }
}
