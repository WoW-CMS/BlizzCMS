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
}
