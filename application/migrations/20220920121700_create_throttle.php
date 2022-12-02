<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_throttle extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'attempts' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'unsigned' => TRUE,
                'default' => 0
            ],
            'reset_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'unlock_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
        ]);
        $this->dbforge->add_key('ip', true);
        $this->dbforge->create_table('throttle', false, ['ENGINE' => 'InnoDB']);

        $this->setting_model->insert_batch([
            ['key' => 'login_max_attempts', 'value' => '3', 'type' => 'int'],
            ['key' => 'login_lockout_interval', 'value' => '15M', 'type' => 'string'],
            ['key' => 'login_reset_interval', 'value' => '1H', 'type' => 'string']
        ]);
    }

    public function down()
    {
        $this->setting_model->delete_in('key', [
            'login_max_attempts',
            'login_lockout_interval',
            'login_reset_interval'
        ]);

        $this->dbforge->drop_table('throttle');
    }
}
