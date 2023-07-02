<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model
{
    protected const MODULES_TABLE = 'modules';

    /**
     * Module_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $module
     * @return mixed
     */
    protected function _getModules(string $module)
    {
        return $this->db->where('name', $module)->get(self::MODULES_TABLE)->row('id');
    }

    /**
     * @param string $module
     * @return bool
     */
    public function getStatusModule(string $module): bool
    {
        $query = $this->db->where('name', $module)
            ->get(self::MODULES_TABLE)
            ->row('status');

        if ($query === '1') {
            return true;
        }

        return false;
    }
}
