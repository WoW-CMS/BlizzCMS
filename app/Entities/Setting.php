<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Setting extends Entity
{
    protected $attributes = [
        'key' => null,
        'value' => null,
        'type' => null,
    ];

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
