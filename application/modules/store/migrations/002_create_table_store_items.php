<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_store_items extends CI_Migration {

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
            'realm_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
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
            'top' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'command' => [
                'type' => 'TEXT',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('store_id');
        $this->dbforge->add_key('realm_id');
        $this->dbforge->create_table('store_items');
    }

    public function down()
    {
        $this->dbforge->drop_table('store_items');
    }
}
