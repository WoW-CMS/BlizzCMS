<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs_model extends CI_Model {

    /**
     * Changelogs_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->select('id')->get('changelogs');
    }

    public function getChangelogs()
    {
        return $this->db->select('*')->order_by('id', 'DESC')->limit('20')->get('changelogs');
    }

    public function getLastID()
    {
        return $this->db->select('id')->order_by('id', 'DESC')->limit('1')->get('changelogs')->row('id');
    }
}
