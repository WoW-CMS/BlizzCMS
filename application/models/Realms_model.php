<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realms_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'realms';

    /**
     * Runtime
     *
     * @var mixed
     */
    protected $realm_status;
    protected $online_chars;
    protected $online_factions;

    function __construct()
    {
        $this->realm_status    = null;
        $this->online_chars    = null;
        $this->online_factions = [];
    }

    /**
     * Insert new record
     *
     * @param array $set
     * @return bool
     */
    public function create(array $set)
    {
        return $this->db->insert($this->table, $set);
    }

    /**
     * Update record
     *
     * @param array $set
     * @param array $where
     * @return bool
     */
    public function update(array $set, array $where)
    {
        return $this->db->update($this->table, $set, $where);
    }

    /**
     * Set record
     *
     * @param array $keys
     * @param array $where
     * @param bool $escape
     * @return bool
     */
    public function set(array $keys, array $where, $escape = null)
    {
        return $this->db->set($keys, '', $escape)
                    ->where($where)
                    ->update($this->table);
    }

    /**
     * Delete record
     *
     * @param array $where
     * @return mixed
     */
    public function delete(array $where)
    {
        return $this->db->delete($this->table, $where);
    }

    /**
     * Find record
     *
     * @param array $where
     * @return mixed
     */
    public function find(array $where)
    {
        return $this->db->where($where)->get($this->table)->row();
    }

    /**
     * Find all records
     *
     * @return array
     */
    public function find_all()
    {
        return $this->db->get($this->table)->result();
    }


    /**
     * Count all records
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Get realm name
     *
     * @param int $realm
     * @return string
     */
    public function name($realm)
    {
        $row = $this->find(['id' => $realm]);
        return $row->name;
    }

    /**
     * Check if a realm is online
     *
     * @param int $realm
     * @param bool $saved
     * @return bool
     */
    public function is_online($realm, $saved = true)
    {
        $row = $this->find(['id' => $realm]);

        if (! is_null($this->realm_status)) {
            return $this->realm_status;
        }

        if ($saved) {
            $cache = $this->cache->file->get('status_' . $realm);

            if ($cache !== false) {
                return ($cache == 'on') ? true : false;
            }
        }

        // Set the realm status
        $this->realm_status = (@fsockopen($row->realm_hostname, $row->realm_port, $errno, $errstr, 1.5) === false) ? false : true;

        $this->cache->file->save('status_' . $realm, $this->realm_status ? 'on' : 'off', 300);

        return $this->realm_status;
    }

    /**
     * Count characters of a realm
     *
     * @param int $realm
     * @param string|null $faction
     * @param bool $saved
     * @return int
     */
    public function count_online($realm, $faction = null, $saved = true)
    {
        if (is_null($faction))
        {
            if (! empty($this->online_chars)) {
                return $this->online_chars;
            }

            if ($saved) {
                $cache = $this->cache->file->get('online_' . $realm);

                if ($cache !== false) {
                    return $cache;
                }
            }

            // Set the counted number of online characters
            $this->online_chars = $this->characters->online_characters($realm);

            $this->cache->file->save('online_' . $realm, $this->online_chars, 300);

            return $this->online_chars;
        }
        else
        {
            if (! empty($this->online_factions[$faction])) {
                return $this->online_factions[$faction];
            }

            if ($saved) {
                $cache = $this->cache->file->get('online_' . $faction . '_' . $realm);

                if ($cache !== false) {
                    return $cache;
                }
            }

            // Set the counted number of online characters in the faction
            $this->online_factions[$faction] = $this->characters->online_characters($realm, $faction);

            $this->cache->file->save('online_' . $faction . '_' . $realm, $this->online_factions[$faction], 300);

            return $this->online_factions[$faction];
        }
    }

    /**
     * Calculate the percentage of online characters
     *
     * @param int $realm
     * @param string|null $faction
     * @param bool $saved
     * @return int
     */
    public function percentage_online($realm, $faction = null, $saved = true)
    {
        $row     = $this->find(['id' => $realm]);
        $count   = is_null($faction) ? $this->count_online($realm, null, $saved) : $this->count_online($realm, $faction, $saved);
        $maximum = is_null($faction) ? $row->max_cap : $this->count_online($realm, null, $saved);

        // Prevent division
        if ($count == 0 || $maximum == 0) {
            return 0;
        }

        // if count exceeded the cap return 100 as maximum percentage
        if ($count > $maximum) {
            return 100;
        }

        return round(($count / $maximum) * 100);
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
        $row      = $this->find(['id' => $realm]);
        $emulator = config_item('emulator');
        $urns     = config_item('emulator_urn');

        $client = new \SoapClient(NULL, [
            'location'   => 'http://' . $row->console_hostname . ':' . $row->console_port . '/',
            'uri'        => 'urn:' . $urns[$emulator],
            'style'      => SOAP_RPC,
            'login'      => $row->console_username,
            'password'   => decrypt($row->console_password)
        ]);

        try {
            $result = $client->executeCommand(new \SoapParam($command, 'command'));
        } catch (\SoapFault $e) {
            $result = $e->getMessage();
        }

        return $result;
    }
}