<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_forum_posts extends CI_Migration
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
            'topic_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'forum_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'commentary' => [
                'type' => 'TEXT',
                'null' => FALSE
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
        $this->dbforge->add_key('topic_id');
        $this->dbforge->add_key('forum_id');
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('forum_posts');
    }

    public function down()
    {
        $this->dbforge->drop_table('forum_posts');
    }
}
