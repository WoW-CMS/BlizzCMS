<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_logs extends CI_Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'status' => [
                'type' => 'ENUM("failed","succeeded")',
                'default' => 'succeeded'
            ],
            'object' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'event' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'message' => [
                'type' => 'TEXT'
            ],
            'data' => [
                'type' => 'MEDIUMTEXT'
            ],
            'uri' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('logs', false, ['ENGINE' => 'InnoDB']);

        $this->setting_model->insert_batch([
            ['key' => 'logs_keep_interval', 'value' => '6M', 'type' => 'string'],
            ['key' => 'logs_purge_date', 'value' => add_timespan('now', 'P6M'), 'type' => 'string']
        ]);
    }

    public function down()
    {
        $this->setting_model->delete_in('key', [
            'logs_keep_interval',
            'logs_purge_date'
        ]);

        $this->dbforge->drop_table('logs');
    }
}
