<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realm_model extends CI_Model
{
    private $RealmStatus;

    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->RealmStatus = null;
    }

    /**
     * @return mixed
     */
    public function getRealms()
    {
        return $this->db->get('realms');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealm($id)
    {
        return $this->db->where('id', $id)
            ->get('realms');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmPort($id)
    {
        return $this->wowauth->auth_database()
            ->where('id', $id)
            ->get('realmlist')
            ->row('port');
    }

    /**
     * @param object $multirealm
     * @param bool $status
     * @return bool
     */
    public function RealmStatus($multirealm, $status = false)
    {
        $port = $this->getRealmPort($multirealm);

        if (config_item('check_realm_local')) {
            $host = $this->realmGetHostnameLocal($multirealm);
        } else {
            $host = $this->realmGetHostname($multirealm);
        }

        if ($this->RealmStatus != null) {
            return $this->RealmStatus;
        } else {
            if (!$status) {
                $cachestatus = $this->cache->file->get('realmstatus_' . $multirealm);

                if ($cachestatus !== false) {
                    return ($cachestatus == 'online') ? true : false;
                }
            }

            if (fsockopen($host, $port, $errno, $errstr, 1.5)) {
                $this->RealmStatus = true;
            } else {
                $this->RealmStatus = false;
            }

            $this->cache->file->save('realmstatus_' . $multirealm, ($this->RealmStatus) ? 'online' : 'offline', 180);
            return $this->RealmStatus;
        }
    }

    /**
     * @param int $id
     * @return object
     */
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
     * @param int $id
     * @return mixed
     */
    public function getRealmName($id)
    {
        return $this->wowauth->auth_database()
            ->where('id', $id)
            ->get('realmlist')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function realmGetHostname($id)
    {
        return $this->wowauth->auth_database()
            ->where('id', $id)
            ->get('realmlist')
            ->row('address');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function realmGetHostnameLocal($id)
    {
        return $this->wowauth->auth_database()
            ->where('id', $id)
            ->get('realmlist')
            ->row('localAddress');
    }

    /**
     * @param object $multirealm
     * @param int $id
     * @return mixed
     */
    public function getGeneralCharactersSpecifyAcc($multirealm, $id)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('account', $id)
            ->get('characters');
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
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getGeneralCharactersSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters');
    }

    /**
     * @param object $multirealm
     * @param int $id
     * @return mixed
     */
    public function getNameCharacterSpecifyGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('name');
    }

    /**
     * @param string $name
     * @param object $multirealm
     * @return mixed
     */
    public function getCharNameAlreadyExist($name, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('name', $name)
            ->get('characters');
    }

    /**
     * @param object $multirealm
     * @param int $id
     * @return mixed
     */
    public function getCharExistGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->num_rows();
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getAccountCharGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('account');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getCharBanSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('guid')
            ->where('guid', $id)
            ->where('active', '1')
            ->get('character_banned');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getCharName($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('name');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getCharLevel($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('level');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getCharActive($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('online');
    }

    /**
     * @param object $multirealm
     * @param int $id
     * @return mixed
     */
    public function getCharRace($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('race');
    }

    /**
     * @param object $multirealm
     * @param int $id
     * @return mixed
     */
    public function getCharClass($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('class');
    }

    /**
     * @param object $multirealm
     * @return mixed
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
     * @return mixed
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
     * @return mixed
     */
    public function getAllCharactersOnline($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('online', 1)
            ->get('characters')
            ->num_rows();
    }

    /**
     * @param object $multirealm
     * @param int $id
     * @return mixed
     */
    public function getInformationCharacter($multirealm, $id)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters');
    }

    /**
     * @param $command
     * @param $soapUser
     * @param $soapPass
     * @param $soapHost
     * @param $soapPort
     * @param $soapUri
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
