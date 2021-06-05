<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_forum_topics extends CI_Migration
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
            'forum_id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
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
            'views' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'lock' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'stick' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('forum_id');
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('forum_topics');
    }

    public function down()
    {
        $this->dbforge->drop_table('forum_topics');
    }
}
