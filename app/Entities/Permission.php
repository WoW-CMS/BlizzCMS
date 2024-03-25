<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Permission extends Entity
{
    protected $attributes = [
        'id'            => null,
        'key'           => null,
        'module'        => null,
        'description'   => null,
    ];

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
