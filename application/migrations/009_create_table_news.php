<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_news extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'description' => [
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'comments' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('news');

        $this->db->insert_batch('news', [
            ['title' => 'Welcome to your new website!', 'description' => '<p>Your site has been installed successfully. To continue, sign in with your account and go to the administration panel to have access to all the features provided. don\'t forget that if you have problems you can contact us on <a href="https://wow-cms.com">WoW-CMS</a></p>', 'image' => 'news.jpg', 'comments' => 1, 'created_at' => current_date()]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('news');
    }
}
