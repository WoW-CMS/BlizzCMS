<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->db->get('changelogs');
    }

    /**
     * @return mixed
     */
    public function getChangelogs()
    {
        return $this->db->order_by('id', 'DESC')
            ->limit('20')
            ->get('changelogs');
    }


    /**
     * @return mixed
     */
    public function getLastID()
    {
        return $this->db->order_by('id', 'DESC')
            ->limit('1')
            ->get('changelogs')
            ->row('id');
    }
}
