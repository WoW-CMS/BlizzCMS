<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_model extends CI_Model {

    /**
     * Download_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
	
	public function getDownloads()
    {
        return $this->db->select('*')->order_by('id', 'ASC')->get('download');
    }

}