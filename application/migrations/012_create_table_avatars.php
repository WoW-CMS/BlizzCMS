<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_table_avatars extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('avatars');

        $this->db->insert_batch('avatars', [
            ['image' => 'default.png'],
            ['image' => 'arthas.png'],
            ['image' => 'deathwing.png'],
            ['image' => 'garrosh.png'],
            ['image' => 'ghoul.png'],
            ['image' => 'hogger.png'],
            ['image' => 'illidan.png'],
            ['image' => 'kelthuzad.png'],
            ['image' => 'kiljeaden.png'],
            ['image' => 'lurker.png'],
            ['image' => 'maiev.png'],
            ['image' => 'malfurion.png'],
            ['image' => 'neptulon.png'],
            ['image' => 'nerzhul.png'],
            ['image' => 'velen.png'],
            ['image' => 'worgen.png'],
            ['image' => 'imp.png'],
            ['image' => 'vault_guardian.png']
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('avatars');
    }
}
