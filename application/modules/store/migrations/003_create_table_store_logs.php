<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_store_logs extends CI_Migration
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
            'store_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'item_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'guid' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'character' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'price_type' => [
                'type' => 'ENUM("vp","dp","and")',
                'default' => 'vp',
                'null' => FALSE
            ],
            'dp' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'vp' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'result' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('store_id');
        $this->dbforge->add_key('item_id');
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('store_logs');
    }

    public function down()
    {
        $this->dbforge->drop_table('store_logs');
    }
}
