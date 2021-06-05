<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realms_model extends CI_Model
{
    protected $realms = 'realms';

    /**
     * Count all realms
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->realms);
    }

    /**
     * Get all realms
     *
     * @return array
     */
    public function get_all()
    {
        return $this->db->get($this->realms)->result();
    }

    /**
     * Get realm
     *
     * @param int $id
     * @return array
     */
    public function get($id)
    {
        return $this->db->where('id', $id)->get($this->realms)->row();
    }

    /**
     * Check if realm exists
     *
     * @param int $id
     * @return boolean
     */
    public function find_id($id)
    {
        $result = $this->db->where('id', $id)->get($this->realms)->num_rows();

        return ($result == 1);
    }
}