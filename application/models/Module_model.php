<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model
{
    /**
     * Module_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $module
     * @return bool
     */
    public function getStatusModule(string $module): bool
    {
        $query = $this->db->where('name', $module)
            ->get('modules')
            ->row('status');

        if ($query === '1') {
            return true;
        }

        return false;
    }
}
