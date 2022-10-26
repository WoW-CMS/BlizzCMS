<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_model extends CI_Model {

    private $_limit,
            $_pageNumber,
            $_offset;
    /**
     * Mod_model constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!$this->wowmodule->getStatusModule('Admin Panel'))
            redirect(base_url(),'refresh');
    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
    }

    public function setPageNumber($pageNumber)
    {
        $this->_pageNumber = $pageNumber;
    }

    public function setOffset($offset)
    {
        $this->_offset = $offset;
    }

    public function getLogs()
    {
      return $this->db->select('*')->get('mod_logs');
    }

    public function getReports()
    {
      return $this->db->select('*')->get('mod_reports');
    }
}
