<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model {

    /**
     * Module_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getDiscordStatus()
    {
        $qq = $this->db->select('status')->where('id', '1')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getreCaptchaStatus()
    {
        $qq = $this->db->select('status')->where('id', '2')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getSlideshowStatus()
    {
        $qq = $this->db->select('status')->where('id', '3')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getRealmStatus()
    {
        $qq = $this->db->select('status')->where('id', '4')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getRegisterStatus()
    {
        $qq = $this->db->select('status')->where('id', '5')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getLoginStatus()
    {
        $qq = $this->db->select('status')->where('id', '6')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getRecoveryStatus()
    {
        $qq = $this->db->select('status')->where('id', '7')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getUCPStatus()
    {
        $qq = $this->db->select('status')->where('id', '8')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getACPStatus()
    {
        $qq = $this->db->select('status')->where('id', '9')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getNewsStatus()
    {
        $qq = $this->db->select('status')->where('id', '10')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getForumStatus()
    {
        $qq = $this->db->select('status')->where('id', '11')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStoreStatus()
    {
        $qq = $this->db->select('status')->where('id', '12')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getDonationStatus()
    {
        $qq = $this->db->select('status')->where('id', '13')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getVoteStatus()
    {
        $qq = $this->db->select('status')->where('id', '14')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getPVPStatus()
    {
        $qq = $this->db->select('status')->where('id', '15')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getBugtrackerStatus()
    {
        $qq = $this->db->select('status')->where('id', '16')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getChangelogsStatus()
    {
        $qq = $this->db->select('status')->where('id', '17')->get('modules')->row('status');

        if($qq == '1')
            return true;
        else
            return false;
    }
}
