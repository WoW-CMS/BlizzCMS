<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Article extends Entity
{
    protected $attributes = [
        'id' => null,
        'title' => null,
        'slug' => null,
        'content' => null,
        'author_id' => null,
        'category_id' => null,
        'tags' => null,
        'image_url' => null,
        'status' => null,
        'comments_enabled' => 'enabled',
        'view' => 0,
    ];

    protected $dates   = ['created_at', 'updated_at', 'published_at'];
    protected $casts   = [];
}