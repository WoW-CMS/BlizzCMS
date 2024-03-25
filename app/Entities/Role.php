<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Role extends Entity
{
    protected $attributes = [
        'id'          => null,
        'name'        => null,
        'description' => null,
    ];

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
