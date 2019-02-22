<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
    }

    public function arraySession($id)
    {
        $data = array(
            'fx_sess_username'  => $this->getUsernameID($id),
            'fx_sess_email'     => $this->getEmailID($id),
            'fx_sess_id'        => $id,
            'fx_sess_expansion'	=> $this->getExpansionID($id),
            'fx_sess_last_ip'   => $this->getLastIPID($id),
            'fx_sess_last_login'=> $this->getLastLoginID($id),
            'fx_sess_gmlevel'   => $this->getRank($id),
            'fx_sess_ban_status'=> $this->getBanStatus($id),
            'fx_sess_tag'       => $this->getTag($id),
            'logged_in' => TRUE
        );

        return $this->sessionConnect($data);
    }

    public function getGmSpecify($id)
    {
        return $this->auth->select('id')
                ->where('id', $id)
                ->get('account_access');
    }

    public function getTag($id)
    {
        $this->db = $this->load->database('default', TRUE);

        $qq = $this->db->select('tag')
                ->where('id', $id)
                ->get('tags');

        if ($qq->num_rows())
            return $qq->row()->tag;
        else
            return '0';
    }

    public function randomUTF()
    {
        return rand(0, 999999999);
    }

    public function getUsernameID($id)
    {
        return $this->auth->select('username')
                ->where('id', $id)
                ->get('account')
                ->row_array()['username'];
    }

    public function getEmailID($id)
    {
        return $this->auth->select('email')
                ->where('id', $id)
                ->get('account')
                ->row('email');
    }

    public function getPasswordAccountID($id)
    {
        return $this->auth->select('sha_pass_hash')
                ->where('id', $id)
                ->get('account')
                ->row('sha_pass_hash');
    }

    public function getPasswordBnetID($id)
    {
        return $this->auth->select('sha_pass_hash')
                ->where('id', $id)
                ->get('battlenet_accounts')
                ->row('sha_pass_hash');
    }

    public function getSpecifyAccount($account)
    {
        $account = strtoupper($account);

        return $this->auth->select('id')
                ->where('username', $account)
                ->get('account');
    }

    public function getSpecifyEmail($email)
    {
        return $this->auth->select('id')
                ->where('email', $email)
                ->get('account');
    }

    public function getIDAccount($account)
    {
        $account = strtoupper($account);

        $qq = $this->auth->select('id')
                ->where('username', $account)
                ->get('account');
        
        if($qq->num_rows())
            return $qq->row('id');
        else
            return '0';
    }

    public function getTimestamp()
    {
        $date = new DateTime();
        return $date->getTimestamp();
    }

    public function getImageProfile($id)
    {
        return $this->db->select('profile')
                ->where('id', $id)
                ->get('users')
                ->row_array()['profile'];
    }

    public function getNameAvatar($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('avatars')
                ->row_array()['name'];
    }

    public function getIDEmail($email)
    {
        $email = strtoupper($email);

        $qq = $this->auth->select('id')
                ->where('email', $email)
                ->get('account');

        if($qq->num_rows())
            return $qq->row('id');
        else
            return '0';
    }

    public function getExpansionID($id)
    {
        return $this->auth->select('expansion')
                ->where('id', $id)
                ->get('account')
                ->row('expansion');
    }

    public function getLastIPID($id)
    {
        return $this->auth->select('last_ip')
                ->where('id', $id)
                ->get('account')
                ->row('last_ip');
    }

    public function getLastLoginID($id)
    {
        return $this->auth->select('last_login')
                ->where('id', $id)
                ->get('account')
                ->row('last_login');
    }

    public function getRank($id)
    {
        $qq = $this->auth->select('gmlevel')
                ->where('id', $id)
                ->get('account_access');

        if($qq->num_rows())
            return $qq->row('gmlevel');
        else
            return '0';
    }

    public function getBanStatus($id)
    {
        $qq = $this->auth->select('*')
                ->where('id', $id)
                ->where('active', '1')
                ->get('account_banned');

        if ($qq->num_rows())
            return true;
        else
            return false;
    }

    public function isLogged()
    {
        if ($this->session->userdata('fx_sess_username'))
            return true;
        else
            return false;
    }

    public function sessionConnect($data)
    {
        $this->session->set_userdata($data);
        return true;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(),'refresh');
    }

    public function getRealmPort($id)
    {
        return $this->auth->select('port')
                ->where('id', $id)
                ->get('realmlist')
                ->row('port');
    }

    public function realm_status($MultiRealm, $host)
    {
        $port = $this->getRealmPort($MultiRealm);

        error_reporting(0);
        $etat = fsockopen($host,$port,$errno,$errstr,3);

        if (!$etat)
            return false;
        else
            return true;
    }

    public function getRealms()
    {
        return $this->db->select('*')
            ->get('realms');
    }

    public function getRealm($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('realms');
    }

    public function getRealmConnectionData($id)
    {
        $data = $this->getRealm($id)->row_array();

        return $this->realmConnection(
            $data['username'],
            $data['password'],
            $data['hostname'],
            $data['char_database']
        );
    }

    public function realmConnection($username, $password, $hostname, $database)
    {
        $dsn = 'mysqli://'.
            $username.':'.
            $password.'@'.
            $hostname.'/'.
            $database.'?char_set=utf8&dbcollat=utf8_general_ci&cache_on=true&cachedir=/path/to/cache';

        return $this->load->database($dsn, TRUE);
    }

    public function getAccountExist($id)
    {
        return $this->auth->select('*')
                ->where('id', $id)
                ->get('account');
    }

    public function getUsers()
    {
        return $this->db->select('*')
                ->get('users');
    }

    public function Battlenet($email, $password)
    {
        return strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($email)).":".strtoupper($password))))))));
    }

    public function Account($username, $password)
    {
        if (!is_string($username))
            $username = "";

        if (!is_string($password))
            $password = "";

        $sha_pass_hash = sha1(strtoupper($username).':'.strtoupper($password));

        return strtoupper($sha_pass_hash);
    }
}
