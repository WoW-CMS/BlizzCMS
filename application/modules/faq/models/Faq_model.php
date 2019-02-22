<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->select('id')
            ->get('faq');
    }

    public function getFaqType()
    {
        return $this->db->select('*')
                ->get('faq_type')
                ->result();
    }

    public function getFaqList($type)
    {
        return $this->db->select('*')
                ->where('type', $type)
                ->get('faq')
                ->result();
    }
}
