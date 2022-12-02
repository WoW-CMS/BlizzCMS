<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_news_comments extends CI_Migration
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
            'news_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE
            ],
            'comment_content' => [
                'type' => 'MEDIUMTEXT'
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
        $this->dbforge->add_key('news_id');
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('news_comments', false, ['ENGINE' => 'InnoDB']);

        $this->db->query(add_foreign_key($this->db->dbprefix('news_comments'), 'news_id', $this->db->dbprefix('news'), 'id', 'CASCADE'));
    }

    public function down()
    {
        $this->db->query(drop_foreign_key($this->db->dbprefix('news_comments'), 'news_id'));

        $this->dbforge->drop_table('news_comments');
    }
}
