<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class RolePermission extends Entity
{
    protected $attributes = [
        'role_id'       => null,
        'permission_id' => null,
    ];

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
