<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_slides extends CI_Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'type' => [
                'type' => 'ENUM("image","video","iframe")',
                'default' => 'image'
            ],
            'path' => [
                'type' => 'TEXT'
            ],
            'sort' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'default' => 0
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('slides', false, ['ENGINE' => 'InnoDB']);

        $this->slide_model->insert_batch([
            ['title' => 'BlizzCMS', 'description' => 'Check our constant updates!', 'type' => 'image', 'path' => '2022/11/95897962ade4959153b9d29b2528947b.jpg', 'sort' => 1],
            ['title' => 'Vote Now', 'description' => 'Each vote will be rewarded!', 'type' => 'image', 'path' => '2022/11/3e0af6fc9ce5a60ca50dba3869cbc716.jpg', 'sort' => 2]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('slides');
    }
}
