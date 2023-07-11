<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realm_model extends CI_Model
{
    private $realmStatus;

    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->realmStatus = null;
    }

    /**
     * @return array
     */
    public function getRealms()
    {
        return $this->db->get('realms')
            ->result();
    }

    /**
     * @param int $id
     * @return object
     */
    public function getRealm($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row();
    }

    /**
     * @param int $realmid
     * @param bool $cache
     * @return bool
     */
    public function RealmStatus($realmid, $cache = true)
    {
        if ($this->realmStatus != null) {
            return $this->realmStatus;
        }

        if ($cache) {
            $status = $this->cache->file->get('realmstatus_' . $realmid);

            if ($status !== false) {
                return ($status == 'online') ? true : false;
            }
        }

        $realmlist = $this->getRealmlist($realmid);

        if (empty($realmlist)) {
            return false;
        }

        $host = config_item('check_realm_local') ? $realmlist->localAddress : $realmlist->address;

        $this->realmStatus = fsockopen($host, $realmlist->port, $errno, $errstr, 1.5) === false ? false : true;

        $this->cache->file->save('realmstatus_' . $realmid, $this->realmStatus ? 'online' : 'offline', 180);
        return $this->realmStatus;
    }

    /**
     * @param int $id
     * @return object
     */
    public function getRealmConnectionData($id)
    {
        $data = $this->getRealm($id);

        return $this->realmConnection(
            $data->username,
            $data->password,
            $data->hostname,
            $data->char_database
        );
    }

    /**
     * @param int $id
     * @return object
     */
    public function realmConnection($username, $password, $hostname, $database)
    {
        $dsn = 'mysqli://'.
            $username.':'.
            $password.'@'.
            $hostname.'/'.
            $database.'?char_set=utf8&dbcollat=utf8_general_ci&cache_on=true&cachedir=/path/to/cache';

        return $this->load->database($dsn, TRUE);
    }

    /**
     * @param int $realmid
     * @return object
     */
    public function getRealmlist($realmid)
    {
        return $this->wowauth->auth_database()
            ->where('id', $realmid)
            ->get('realmlist')
            ->row();
    }

    /**
     * @param int $realmid
     * @return mixed
     */
    public function getRealmName($realmid)
    {
        return $this->wowauth->auth_database()
            ->where('id', $realmid)
            ->get('realmlist')
            ->row('name');
    }

    /**
     * @param object $multirealm
     * @param int $account
     * @return array
     */
    public function getGeneralCharactersSpecifyAcc($multirealm, $account)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('account', $account)
            ->get('characters')
            ->result();
    }

    /**
     * @param object $multirealm
     * @param string $name
     * @return mixed
     */
    public function getGuidCharacterSpecifyName($multirealm, $name)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('name', $name)
            ->get('characters')
            ->row('guid');
    }

    /**
     * @param object $multirealm
     * @param int $guid
     * @return object
     */
    public function getGeneralCharactersSpecifyGuid($multirealm, $guid)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row();
    }

    /**
     * @param object $multirealm
     * @param int $guid
     * @return mixed
     */
    public function getNameCharacterSpecifyGuid($multirealm, $guid)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('name');
    }

    /**
     * @param string $name
     * @param object $multirealm
     * @return bool
     */
    public function getCharNameAlreadyExist($name, $multirealm)
    {
        $this->multirealm = $multirealm;

        $query = $this->multirealm->where('name', $name)
            ->get('characters')
            ->num_rows();

        if ($query === 1) {
            return true;
        }

        return false;
    }

    /**
     * @param object $multirealm
     * @param int $guid
     * @return bool
     */
    public function getCharExistGuid($multirealm, $guid)
    {
        $this->multirealm = $multirealm;

        $query = $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->num_rows();

        if ($query === 1) {
            return true;
        }

        return false;
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getAccountCharGuid($multirealm, $guid)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('account');
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getCharBanSpecifyGuid($guid, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('guid')
            ->where('guid', $guid)
            ->where('active', '1')
            ->get('character_banned')
            ->num_rows();
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getCharName($guid, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('name');
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getCharLevel($guid, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('level');
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getCharActive($guid, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('online');
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getCharRace($guid, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('race');
    }

    /**
     * @param int $guid
     * @param object $multirealm
     * @return mixed
     */
    public function getCharClass($guid, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $guid)
            ->get('characters')
            ->row('class');
    }

    /**
     * @param object $multirealm
     * @return int
     */
    public function getCharactersOnlineAlliance($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where_in('race', General_model::ALLIANCE_RACES)
            ->where('online', 1)
            ->get('characters')
            ->num_rows();
    }

    /**
     * @param object $multirealm
     * @return int
     */
    public function getCharactersOnlineHorde($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where_in('race', General_model::HORDE_RACES)
            ->where('online', 1)
            ->get('characters')
            ->num_rows();
    }

    /**
     * @param object $multirealm
     * @return int
     */
    public function getAllCharactersOnline($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('online', 1)
            ->get('characters')
            ->num_rows();
    }

    /**
     * @param string $command
     * @param string $soapUser
     * @param string $soapPass
     * @param string $soapHost
     * @param string $soapPort
     * @param string $soapUri
     * @return mixed
     */
    public function commandSoap($command, $soapUser, $soapPass, $soapHost, $soapPort, $soapUri)
    {
        try {
            $client = new SoapClient(NULL, [
                'location'   => 'http://' . $soapHost . ':' . $soapPort . '/',
                'uri'        => 'urn:' . $soapUri,
                'style'      => SOAP_RPC,
                'login'      => $soapUser,
                'password'   => $soapPass,
                'trace'      => 1,
                'exceptions' => 0
            ]);

            $response = $client->executeCommand(new SoapParam($command, "command"));
        } catch (\SoapFault $fault) {
            $response = $fault->getMessage();
        }

        return $response;
    }
}
