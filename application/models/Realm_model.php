<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realm_model extends CI_Model {

    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
    }

    public function getRealms()
    {
        return $this->db->select('*')->get('realms');
    }

    public function getRealm($id)
    {
        return $this->db->select('*')->where('id', $id)->get('realms');
    }

    public function getRealmPort($id)
    {
        return $this->auth->select('port')->where('id', $id)->get('realmlist')->row('port');
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

    public function getRealmName($id)
    {
        return $this->auth->select('name')->where('id', $id)->get('realmlist')->row_array()['name'];
    }

    public function realmGetHostname($id)
    {
        return $this->auth->select('address')->where('id', $id)->get('realmlist')->row_array()['address'];
    }

    public function getGeneralCharactersSpecifyAcc($multiRealm, $id)
    {
        $this->multiRealm = $multiRealm;
        return $this->multiRealm->select('*')->where('account', $id)->get('characters');
    }

    public function getGuidCharacterSpecifyName($multiRealm, $name)
    {
        $this->multiRealm = $multiRealm;
        return $this->multiRealm->select('guid')->where('name', $name)->get('characters')->row('guid');
    }

    public function getGeneralCharactersSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('*')->where('guid', $id)->get('characters');
    }

    public function getNameCharacterSpecifyGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')->where('guid', $id)->get('characters')->row_array()['name'];
    }

    public function getCharNameAlreadyExist($name, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')->where('name', $name)->get('characters');
    }

    public function getCharBanSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('guid')->where('guid', $id)->where('active', '1')->get('character_banned');
    }

    public function getCharName($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')->where('guid', $id)->get('characters')->row_array()['name'];
    }

    public function getCharLevel($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('level')->where('guid', $id)->get('characters')->row('level');
    }

    public function getCharActive($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('online')->where('guid', $id)->get('characters')->row('online');
    }

    public function getCharRace($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('race')->where('guid', $id)->get('characters')->row('race');
    }

    public function getCharClass($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('class')->where('guid', $id)->get('characters')->row('class');
    }

    public function getCharactersOnlineAlliance($multiRealm)
    {
        $this->multiRealm = $multiRealm;
        $races = array('1','3','4','7','11','22','25');

        return $this->multiRealm->select('guid')->where_in('race', $races)->where('online', '1')->get('characters')->num_rows();
    }

    public function getCharactersOnlineHorde($multiRealm)
    {
        $this->multiRealm = $multiRealm;
        $races = array('2','5','6','8','10','9','26');

        return $this->multiRealm->select('guid')->where_in('race', $races)->where('online', '1')->get('characters')->num_rows();
    }

    public function getAllCharactersOnline($multiRealm)
    {
        $this->multiRealm = $multiRealm;

        return $this->multiRealm->select('online')->where('online', '1')->get('characters')->num_rows();
    }

    public function getInformationCharacter($MultiRealm, $id)
    {
        $this->multirealm = $MultiRealm;
        
        return $this->multirealm->select('*')->where('guid', $id)->get('characters');
    }

    public function connect($soapUser, $soapPass, $soapHost, $soapPort, $soap_uri)
    {
        $this->client = new SoapClient(NULL, array(
            "location"      => "http://".$soapHost.":".$soapPort."/",
            "uri"           => "urn:". $soap_uri ."",
            "style"         => SOAP_RPC,
            "login"         => $soapUser,
            "password"      => $soapPass,
            "trace"         => 1,
            "exceptions"    => 0
            )
        );

        if (is_soap_fault($this->client))
        {
            return 'Soap not found';
        }
        return $this->client;
    }

    public function commandSoap($command, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri)
    {
        $client = $this->connect($soapUser, $soapPass, $soapHost, $soapPort, $soap_uri);
        return $client->executeCommand(new SoapParam($command, "command"));
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
            return true;
        }
    }
}
