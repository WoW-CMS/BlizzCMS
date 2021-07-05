<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_bugtracker_categories extends CI_Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('bugtracker_categories');

        $this->db->insert_batch('bugtracker_categories', [
            ['name' => 'Achievements'],
            ['name' => 'Arena'],
            ['name' => 'Battle Pets'],
            ['name' => 'Battlegrounds'],
            ['name' => 'Classes'],
            ['name' => 'Creatures'],
            ['name' => 'Exploits'],
            ['name' => 'Garrison'],
            ['name' => 'Guilds'],
            ['name' => 'Instances'],
            ['name' => 'Items'],
            ['name' => 'Other'],
            ['name' => 'Professions'],
            ['name' => 'Quests'],
            ['name' => 'Website']
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('bugtracker_categories');
    }
}
