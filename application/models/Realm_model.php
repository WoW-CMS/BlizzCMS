<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realm_model extends CI_Model
{
	protected $status;
	protected $online;
	protected $faction_online;

	public function __construct()
	{
		$this->status         = null;
		$this->online         = null;
		$this->faction_online = [];
	}

	/**
	 * Get all realms
	 *
	 * @return array
	 */
	public function get_realms()
	{
		return $this->db->get('realms')->result();
	}

	/**
	 * Get realm
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_realm($id)
	{
		return $this->db->where('id', $id)->get('realms')->row();
	}

	/**
	 * Get realm name
	 *
	 * @param int $id
	 * @return string
	 */
	public function realm_name($id)
	{
		return $this->db->where('id', $id)->get('realms')->row('name');
	}

	/**
	 * Return connection to the characters database of a realm
	 *
	 * @param int $realm
	 * @return object
	 */
	public function char_connect($realm)
	{
		$data = $this->get_realm($realm);

		$dsn = [
			'hostname' => $data->char_hostname,
			'username' => $data->char_username,
			'password' => decrypt($data->char_password),
			'database' => $data->char_database,
			'port'     => $data->char_port,
			'dbdriver' => 'mysqli',
			'pconnect' => FALSE
		];

		return $this->load->database($dsn, TRUE);
	}

	/**
	 * Check if a realm is online
	 *
	 * @param int $realm
	 * @return boolean
	 */
	public function is_online($realm, $cache = true)
	{
		$data = $this->get_realm($realm);

		if (! is_null($this->status))
		{
			return $this->status;
		}

		if ($cache)
		{
			$get_data = $this->cache->file->get('status_' . $realm);

			if ($get_data !== false)
			{
				return ($get_data == 'on') ? true : false;
			}
		}

		if (@fsockopen($data->realm_hostname, $data->realm_port, $errno, $errstr, 1.5))
		{
			$this->status = true;
		}
		else
		{
			$this->status = false;
		}

		$this->cache->file->save('status_' . $realm, $this->status ? 'on' : 'off', 300);

		return $this->status;
	}

	/**
	 * Count characters of a realm
	 *
	 * @param int $realm
	 * @param string|null $faction
	 * @param bool $cache
	 * @return int
	 */
	public function count_online($realm, $faction = null, $cache = true)
	{
		if (empty($faction))
		{
			if (! empty($this->online))
			{
				return $this->online;
			}

			// if the cache is enabled
			if ($cache)
			{
				$get_data = $this->cache->file->get('online_' . $realm);

				if ($get_data !== false)
				{
					return $get_data;
				}
			}

			// Count all characters online
			$this->online = $this->_count_characters($realm);
			$this->cache->file->save('online_' . $realm, $this->online, 300);

			return $this->online;
		}
		else
		{
			if (! empty($this->faction_online[$faction]))
			{
				return $this->faction_online[$faction];
			}

			// if the cache is enabled
			if ($cache)
			{
				$get_data = $this->cache->file->get('online_' . $faction . '_' . $realm);

				if ($get_data !== false)
				{
					return $get_data;
				}
			}

			// Count characters of a faction online
			$this->faction_online[$faction] = $this->_count_characters($realm, $faction);
			$this->cache->file->save('online_' . $faction . '_' . $realm, $this->faction_online[$faction], 300);

			return $this->faction_online[$faction];
		}
	}

	/**
	 * Count characters online
	 *
	 * @param int $realm
	 * @param string|null $faction
	 * @return int
	 */
	private function _count_characters($realm, $faction = null)
	{
		$query = $this->char_connect($realm)->where('online', 1);

		switch ($faction)
		{
			case 'horde':
				$query = $query->where_in('race', [2, 5, 6, 8, 10, 9, 26]);
				break;
			case 'alliance':
				$query = $query->where_in('race', [1, 3, 4, 7, 11, 22, 25]);
				break;
		}

		return $query->from('characters')->count_all_results();
	}

	/**
	 * Calculate the percentage of online characters
	 *
	 * @param int $realm
	 * @param string|null $faction
	 * @param bool $cache
	 * @return mixed
	 */
	public function percentage_online($realm, $faction = null, $cache = true)
	{
		$data    = $this->get_realm($realm);
		$count   = empty($faction) ? $this->count_online($realm, null, $cache) : $this->count_online($realm, $faction, $cache);
		$maximum = empty($faction) ? $data->max_cap : $this->count_online($realm, null, $cache);

		// Prevent division
		if ($count == 0 || $maximum == 0)
		{
			return 0;
		}

		// if count exceeded the cap return 100 as maximum percentage
		if ($count > $maximum)
		{
			return 100;
		}

		return round(($count / $maximum) * 100);
	}

	/**
	 * Check if character exists
	 *
	 * @param int $realm
	 * @param int $guid
	 * @return boolean
	 */
	public function character_exists($realm, $guid)
	{
		$query = $this->char_connect($realm)->where('guid', $guid)->get('characters')->num_rows();

		return ($query == 1);
	}

	/**
	 * Check if the character is linked to the account
	 *
	 * @param int $realm
	 * @param int $account
	 * @param int $guid
	 * @return boolean
	 */
	public function character_linked($realm, $account, $guid)
	{
		$query = $this->char_connect($realm)->where(['guid' => $guid, 'account' => $account])->get('characters')->num_rows();

		return ($query == 1);
	}

	/**
	 * Get character name
	 *
	 * @param int $realm
	 * @param int $guid
	 * @return string
	 */
	public function character_name($realm, $guid)
	{
		return $this->char_connect($realm)->where('guid', $guid)->get('characters')->row('name');
	}

	/**
	 * Get character guid
	 *
	 * @param int $realm
	 * @param string $name
	 * @return string
	 */
	public function character_guid($realm, $name)
	{
		return $this->char_connect($realm)->where('name', $name)->get('characters')->row('guid');
	}

	/**
	 * Get the account characters of a realm
	 *
	 * @param int $realm
	 * @param int $account
	 * @return array
	 */
	public function account_characters($realm, $account)
	{
		return $this->char_connect($realm)->where('account', $account)->get('characters')->result();
	}

	/**
	 * Send command to realm
	 *
	 * @param int $realm
	 * @param string $command
	 * @return mixed
	 */
	public function send_command($realm, $command)
	{
		$data     = $this->get_realm($realm);
		$emulator = config_item('emulator');
		$urns     = config_item('emulator_urn');

		$client = new SoapClient(NULL, [
			'location'   => "http://" . $data->console_hostname . ":" . $data->console_port . "/",
			'uri'        => 'urn:' . $urns[$emulator],
			'style'      => SOAP_RPC,
			'login'      => $data->console_username,
			'password'   => decrypt($data->console_password),
			'trace'      => 1,
			'exceptions' => 0
		]);

		if (is_soap_fault($client))
		{
			return 'Soap not found';
		}

		return $client->executeCommand(new SoapParam($command, "command"));
	}
}
