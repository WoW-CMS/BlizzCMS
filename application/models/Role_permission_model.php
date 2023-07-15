<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_permission_model extends BS_Model
{
    protected $table = 'roles_permissions';

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
     * Get a list of permissions ids for a role
     *
     * @param int $role
     * @return array
     */
    public function permissions_ids($role)
    {
        $query = $this->find_all(['role_id' => $role], 'array');

        if (empty($query)) {
            return [];
        }

        return array_column($query, 'permission_id');
    }

    /**
     * Get a list of roles ids for a permission
     *
     * @param int $permission
     * @return array
     */
    public function roles_ids($permission)
    {
        $query = $this->find_all(['permission_id' => $permission], 'array');

        if (empty($query)) {
            return [];
        }

        return array_column($query, 'role_id');
    }
}
