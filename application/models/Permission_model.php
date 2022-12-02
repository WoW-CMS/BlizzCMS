<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends BS_Model
{
    protected $table = 'permissions';

    /**
     * Internal names used as modules
     * for the permissions
     *
     * @var array
     */
    public const INTERNAL_NAMES = [
        ':base:',
        ':menu-item:',
        ':page:'
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
     * Get all permissions keys for a role
     *
     * @param int $role
     * @param string $module
     * @return array
     */
    public function permissions_keys($role, $module)
    {
        $query = $this->db->from($this->table)
            ->join('roles_permissions', 'roles_permissions.permission_id = permissions.id')
            ->where('roles_permissions.role_id', $role)
            ->where('permissions.module', $module)
            ->get()
            ->result_array();

        if (empty($query)) {
            return [];
        }

        return array_column($query, 'key');
    }

    /**
     * Get all modules names related to permissions
     *
     * @return array
     */
    public function module_list()
    {
        $query = $this->db->distinct()
            ->select('module')
            ->get($this->table)
            ->result_array();

        if (empty($query)) {
            return [];
        }

        return array_column($query, 'module');
    }

    /**
     * Check if the user has specific permission from the module
     *
     * @param string $key
     * @param string $module
     * @param int|null $id
     * @return bool
     */
    public function has_permission($key, $module, $id = null)
    {
        $role  = is_logged_in() ? user('role', $id) : '1';
        $cache = $this->cache->get('permission_' . $role);

        if ($cache !== false) {
            if (array_key_exists($module, $cache)) {
                return in_array($key, $cache[$module], true);
            }

            return false;
        }

        $list  = $this->module_list();
        $perms = [];

        foreach ($list as $item) {
            $perms[$item] = $this->permissions_keys($role, $item);
        }

        $this->cache->save('permission_'. $role, $perms, 86400);

        if (array_key_exists($module, $perms)) {
            return in_array($key, $perms[$module], true);
        }

        return false;
    }
}
