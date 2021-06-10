<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_donation_logs extends CI_Migration
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
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'unsigned' => TRUE
            ),
            'order_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'reference_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'payment_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'payment_status' => array(
                'type' => 'ENUM("DECLINED","PENDING","COMPLETED")',
                'default' => 'PENDING',
                'null' => FALSE
            ),
            'payment_gateway' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'points' => array(
                'type' => 'FLOAT',
                'constraint' => '10,2',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'amount' => array(
                'type' => 'FLOAT',
                'constraint' => '10,2',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'currency' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'rewarded' => array(
                'type' => 'ENUM("YES","NO")',
                'default' => 'NO',
                'null' => FALSE
            ),
            'ip' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
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
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('donation_logs');
    }

    public function down()
    {
        $this->dbforge->drop_table('donation_logs');
    }
}
