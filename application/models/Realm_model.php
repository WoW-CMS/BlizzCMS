<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realm_model extends CI_Model {

    private $RealmStatus;
    
    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->RealmStatus = null;
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

    public function RealmStatus($MultiRealm, $status = false)
    {
        $port = $this->getRealmPort($MultiRealm);

        if ($this->config->item('check_realm_local'))
        {
            $host = $this->realmGetHostnameLocal($MultiRealm);
        }
        else
        {
            $host = $this->realmGetHostname($MultiRealm);
        }

        if ($this->RealmStatus != null)
        {
            return $this->RealmStatus;
        }
        else
        {
            if (!$status)
            {
                $cachestatus = $this->cache->file->get('realmstatus_'.$MultiRealm);

                if($cachestatus !== false)
                {
                    return ($cachestatus == "online") ? true : false;
                }
            }

            if (fsockopen($host, $port, $errno, $errstr, 1.5))
            {
                $this->RealmStatus = true;
            }
            else
            {
                $this->RealmStatus = false;
            }

            $this->cache->file->save('realmstatus_'.$MultiRealm, ($this->RealmStatus) ? "online" : "offline", 180);
            return $this->RealmStatus;
        }
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
        return $this->auth->select('name')->where('id', $id)->get('realmlist')->row('name');
    }

    public function realmGetHostname($id)
    {
        return $this->auth->select('address')->where('id', $id)->get('realmlist')->row('address');
    }

    public function realmGetHostnameLocal($id)
    {
        return $this->auth->select('localAddress')->where('id', $id)->get('realmlist')->row('localAddress');
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
        return $this->multirealm->select('name')->where('guid', $id)->get('characters')->row('name');
    }

    public function getCharNameAlreadyExist($name, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')->where('name', $name)->get('characters');
    }

    public function getCharExistGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('guid')->where('guid', $id)->get('characters')->num_rows();
    }

    public function getAccountCharGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('account')->where('guid', $id)->get('characters')->row('account');
    }

    public function getCharBanSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('guid')->where('guid', $id)->where('active', '1')->get('character_banned');
    }

    public function getCharName($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')->where('guid', $id)->get('characters')->row('name');
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

        $qq = $this->multiRealm->select('guid')->where_in('race', $races)->where('online', '1')->get('characters');

        if($qq->num_rows())
            return $qq->num_rows();
        else
            return '0';
    }


    public function getCharactersOnlineHorde($multiRealm)
    {
        $this->multiRealm = $multiRealm;
        $races = array('2','5','6','8','10','9','26');

        $qq = $this->multiRealm->select('guid')->where_in('race', $races)->where('online', '1')->get('characters');

        if($qq->num_rows())
            return $qq->num_rows();
        else
            return '0';
    }

    public function getAllCharactersOnline($multiRealm)
    {
        $this->multiRealm = $multiRealm;

        $qq = $this->multiRealm->select('online')->where('online', '1')->get('characters');

        if($qq->num_rows())
            return $qq->num_rows();
        else
            return '0';
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

	/**
	 * @param $command
	 * @param $soapUser
	 * @param $soapPass
	 * @param $soapHost
	 * @param $soapPort
	 * @param $soap_uri
	 * @return void
	 */
	public function commandSoap($command, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri)
    {
        $client = $this->connect($soapUser, $soapPass, $soapHost, $soapPort, $soap_uri);

		try {
			$result = $client->executeCommand(new SoapParam($command, "command"));

			return $result;
		}
		catch (Exception $e)
		{
			echo "Command failed! Reason:<br />\n";
			echo $e->getMessage();
		}
    }
}
