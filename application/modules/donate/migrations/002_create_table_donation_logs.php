<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_donation_logs extends CI_Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ],
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'reference_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'payment_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'payment_status' => [
                'type' => 'ENUM("DECLINED","PENDING","COMPLETED")',
                'default' => 'PENDING',
                'null' => FALSE
            ],
            'payment_gateway' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'points' => [
                'type' => 'FLOAT',
                'constraint' => '10,2',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'amount' => [
                'type' => 'FLOAT',
                'constraint' => '10,2',
                'unsigned' => TRUE,
                'default' => 0
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'rewarded' => [
                'type' => 'ENUM("YES","NO")',
                'default' => 'NO',
                'null' => FALSE
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
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
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('donation_logs');
    }

    public function down()
    {
        $this->dbforge->drop_table('donation_logs');
    }
}
