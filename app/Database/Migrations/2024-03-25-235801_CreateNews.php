<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use App\Models\News;


class CreateNews extends Migration
{

    /**
     * @inheritDoc
     */
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'content' => [
                'type' => 'LONGTEXT',
            ],
            'author_id' => [
                'type' => 'BIGINT',
                'constraint' => '20'
            ],
            'category_id' => [
                'type' => 'BIGINT',
                'constraint' => '20'
            ],
            'image_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tags' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'published_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'view' => [
                'type' => 'INT',
                'constraint' => 25
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['publish', 'pending', 'draft'],
                'default'    => 'pending',
            ],
            'comments_enabled' => [
                'type'       => 'ENUM',
                'constraint' => ['enabled', 'disabled'],
                'default'    => 'disabled',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('news', false, ['ENGINE' => 'InnoDB']);

    }

    /**
     * @inheritDoc
     */
    public function down()
    {
        $this->forge->dropTable('news');
    }
}