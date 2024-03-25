<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Role::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'description',
    ];
    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Roles
     * 
     * @var int
     */
    public const ROLE_GUEST     = 1;
    public const ROLE_BANNED    = 2;
    public const ROLE_USER      = 3;
    public const ROLE_GM        = 4;
    public const ROLE_ADMIN     = 5;

    /**
     * Default roles
     * 
     * @var array
     */
    public const DEFAULT_ROLES = [
        self::ROLE_GUEST,
        self::ROLE_BANNED,
        self::ROLE_USER,
        self::ROLE_GM,
        self::ROLE_ADMIN,
    ];


    /**
     * Restricted roles
     * 
     * @var array
     */
    public const RESTRICTED_ROLES = [
        self::ROLE_GUEST,
        self::ROLE_BANNED,
    ];
}
