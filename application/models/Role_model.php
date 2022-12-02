<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends BS_Model
{
    protected $table = 'roles';

    /**
     * Roles
     *
     * @var int
     */
    public const ROLE_GUEST  = 1;
    public const ROLE_BANNED = 2;
    public const ROLE_USER   = 3;
    public const ROLE_GM     = 4;
    public const ROLE_ADMIN  = 5;

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
        self::ROLE_ADMIN
    ];

    /**
     * Restricted roles
     *
     * @var array
     */
    public const RESTRICTED_ROLES = [
        self::ROLE_GUEST,
        self::ROLE_BANNED
    ];

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a limit of rows to display per page
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function paginate($limit, $offset)
    {
        return $this->db->from($this->table)
            ->order_by('id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    /**
     * Count total rows to paginate
     *
     * @return int
     */
    public function total_paginate()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Get all roles without the internal restricted roles
     *
     * @return array
     */
    public function unrestricted_roles()
    {
        return $this->db->from($this->table)
            ->where_not_in('id', self::RESTRICTED_ROLES)
            ->get()
            ->result();
    }

    /**
     * Get role name
     *
     * @param int $id
     * @return string
     */
    public function get_name($id)
    {
        $cache = $this->cache->get('roles');

        if ($cache !== false) {
            if (! array_key_exists($id, $cache)) {
                return null;
            }

            return $cache[$id];
        }

        $list = [];

        foreach ($this->find_all() as $role) {
            $list[$role->id] = $role->name;
        }

        $this->cache->save('roles', $list, 604800);

        if (! array_key_exists($id, $list)) {
            return null;
        }

        return $list[$id];
    }
}
