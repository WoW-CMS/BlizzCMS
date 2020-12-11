<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getLogs()
	{
		return $this->db->get('mod_logs')->result();
	}
}
