<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_modules extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getStatusDiscordExperimental()
    {
        $qq = $this->db->select('status')
                ->where('id', '1')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusDiscordClassic()
    {
        $qq = $this->db->select('status')
                ->where('id', '2')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusRegister()
    {
        $qq = $this->db->select('status')
                ->where('id', '3')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusLogin()
    {
        $qq = $this->db->select('status')
                ->where('id', '4')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusRealmStatus()
    {
        $qq = $this->db->select('status')
                ->where('id', '5')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusNews()
    {
        $qq = $this->db->select('status')
                ->where('id', '6')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusChangelogs()
    {
        $qq = $this->db->select('status')
                ->where('id', '7')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusForums()
    {
        $qq = $this->db->select('status')
                ->where('id', '8')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusStore()
    {
        $qq = $this->db->select('status')
                ->where('id', '9')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusSlides()
    {
        $qq = $this->db->select('status')
                ->where('id', '10')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusEvents()
    {
        $qq = $this->db->select('status')
                ->where('id', '11')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusLadPVP()
    {
        $qq = $this->db->select('status')
                ->where('id', '12')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusUCP()
    {
        $qq = $this->db->select('status')
                ->where('id', '13')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusGifts()
    {
        $qq = $this->db->select('status')
                ->where('id', '14')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getStatusLadBugtracker()
    {
        $qq = $this->db->select('status')
                ->where('id', '16')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getCaptcha()
    {
        $qq = $this->db->select('status')
                ->where('id', '17')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getDonation()
    {
        $qq = $this->db->select('status')
                ->where('id', '19')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getInstallation()
    {
        $qq = $this->db->select('status')
                ->where('id', '20')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getVote()
    {
        $qq = $this->db->select('status')
                ->where('id', '22')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getACP()
    {
        $qq = $this->db->select('status')
                ->where('id', '23')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getFaq()
    {
        $qq = $this->db->select('status')
                ->where('id', '24')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function getForgotPassword()
    {
        $qq = $this->db->select('status')
                ->where('id', '25')
                ->get('modules')
                ->row('status');
        if($qq == '1')
            return true;
        else
            return false;
    }

    public function insertRealm($hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport, $red = '')
    {
        $data = array(
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'char_database' => $database,
            'realmID' => $realm_id,
            'console_hostname' => $soaphost,
            'console_username' => $soapuser,
            'console_password' => $soappass,
            'console_port' => $soapport,
            'emulator' => 'TC'
        );

        $this->db->insert('realms', $data);

        if ($red == '1') {
            redirect(base_url('admin/managerealms'),'refresh');
        }
    }
}
