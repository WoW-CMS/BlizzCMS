<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model
{
    /**
     * Page_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $uri
     * @return mixed
     */
    public function getName($uri)
    {
        return $this->db->where('uri_friendly', $uri)
            ->get('pages')
            ->row('title');
    }

    /**
     * @param string $uri
     * @return mixed
     */
    public function getDesc($uri)
    {
        return $this->db->where('uri_friendly', $uri)
            ->get('pages')
            ->row('description');
    }

    /**
     * @param string $uri
     * @return mixed
     */
    public function getDate($uri)
    {
        return $this->db->where('uri_friendly', $uri)
            ->get('pages')
            ->row('date');
    }

    /**
     * @param string $uri
     * @return int
     */
    public function getVerifyExist($uri)
    {
        return $this->db->where('uri_friendly', $uri)
            ->get('pages')
            ->num_rows();
    }
}
