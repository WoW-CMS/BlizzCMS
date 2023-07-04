<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_model extends CI_Model
{
    private $_limit,
            $_pageNumber,
            $_offset;
    /**
     * Mod_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

    /**
     * @return mixed
     */
    public function getLogs()
    {
      return $this->db->get('mod_logs');
    }

    /**
     * @return mixed
     */
    public function getReports()
    {
      return $this->db->get('mod_reports');
    }
}
