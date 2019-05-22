<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

    /**
     * Page_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getName($uri)
    {
        return $this->db->select('title')->where('uri_friendly', $uri)->get('pages')->row('title');
    }

    public function getDesc($uri)
    {
        return $this->db->select('description')->where('uri_friendly', $uri)->get('pages')->row('description');
    }

    public function getDate($uri)
    {
        return $this->db->select('date')->where('uri_friendly', $uri)->get('pages')->row('date');
    }

    public function getVerifyExist($uri)
    {
        return $this->db->select('uri_friendly')->where('uri_friendly', $uri)->get('pages')->num_rows();
    }
}
