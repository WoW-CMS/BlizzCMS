<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model {

	protected const MODULES_TABLE = 'modules';

    /**
     * Module_model constructor.
     */
    public function __construct()
	{

    }

	/**
	 * @param $module
	 * @return mixed
	 */
	protected function _getModules($module)
	{
		$qq = $this->db->select('id')->where('name', $module)->get(self::MODULES_TABLE)->row('id');

		return $qq;
	}

	public function getStatusModule($module): bool
	{
		$moduleID = $this->_getModules($module);

		$qq = $this->db->select('status')->where('id', $moduleID)->get(self::MODULES_TABLE)->row('status');

		if($qq == '1') return true;

		return false;
	}
}
