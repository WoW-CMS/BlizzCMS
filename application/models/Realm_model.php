<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realm_model extends BS_Model
{
    protected $table = 'realms';

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a limit of rows to display per page
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function paginate($limit, $offset)
    {
        return $this->db->from($this->table)
            ->order_by('id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    /**
     * Count total rows to paginate
     *
     * @return int
     */
    public function total_paginate()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Get realm name
     *
     * @param int $realm
     * @return string
     */
    public function get_name($realm)
    {
        $row = $this->find(['id' => $realm]);

        if (empty($row)) {
            return '';
        }

        return $row->realm_name;
    }

    /**
     * Check if the realm exists
     *
     * @param int $realm
     * @return bool
     */
    public function exists($realm)
    {
        $rows = $this->count_all(['id' => $realm]);

        return $rows === 1;
    }

    /**
     * Check if the realm is online
     *
     * @param int $realm
     * @param bool $saved
     * @return bool
     */
    public function is_online($realm, $saved = true)
    {
        if ($saved) {
            $cache = $this->cache->get('realm_' . $realm);

            if ($cache !== false) {
                return $cache === 'on' ? true : false;
            }
        }

        $row = $this->find(['id' => $realm]);

        $fp = @fsockopen(
            gethostbyname($row->realm_hostname),
            $row->realm_port,
            $errno,
            $errstr,
            1
        );

        if ($fp === false) {
            $status = false;
        } else {
            fclose($fp);

            $status = true;
        }

        $this->cache->save('realm_' . $realm, $status ? 'on' : 'off', 300);

        return $status;
    }

    /**
     * Count all online characters in a realm
     *
     * @param int $realm
     * @param string|null $faction
     * @param bool $saved
     * @return int
     */
    public function count_online($realm, $faction = null, $saved = true)
    {
        if ($faction === null) {
            if ($saved) {
                $cache = $this->cache->get('realm_on_' . $realm);

                if ($cache !== false) {
                    return $cache;
                }
            }

            // Count online characters
            $characters = $this->is_online($realm) ? $this->server_characters_model->characters_online($realm) : 0;

            $this->cache->save('realm_on_' . $realm, $characters, 300);

            return $characters;
        }

        if ($saved) {
            $cache = $this->cache->get('realm_on_' . $faction . '_' . $realm);

            if ($cache !== false) {
                return $cache;
            }
        }

        // Count online characters of a faction
        $characters = $this->is_online($realm) ? $this->server_characters_model->characters_online($realm, $faction) : 0;

        $this->cache->save('realm_on_' . $faction . '_' . $realm, $characters, 300);

        return $characters;
    }

    /**
     * Calculate the percentage of online characters in a realm
     *
     * @param int $realm
     * @param string|null $faction
     * @param bool $saved
     * @return int
     */
    public function percentage_online($realm, $faction = null, $saved = true)
    {
        $row     = $this->find(['id' => $realm]);
        $count   = $faction === null ? $this->count_online($realm, null, $saved) : $this->count_online($realm, $faction, $saved);
        $maximum = $faction === null ? (int) $row->realm_capacity : $this->count_online($realm, null, $saved);

        // Prevent division
        if ($count === 0 || $maximum === 0) {
            return 0;
        }

        // If the count exceeded the cap return 100 as a maximum percentage
        if ($count > $maximum) {
            return 100;
        }

        return round(($count / $maximum) * 100);
    }

    /**
     * Execute a command in a realm through SOAP
     *
     * @param int $realm
     * @param string $command
     * @param bool $return Whether to return the command response
     * @return bool|string
     */
    public function execute_command($realm, $command, $return = false)
    {
        $row       = $this->find(['id' => $realm]);
        $emulators = config_item('emulators');
        $emulator  = config_item('app_emulator');

        $client = new \SoapClient(null, [
            'location' => 'http://' . $row->console_hostname . ':' . $row->console_port . '/',
            'uri'      => 'urn:' . $emulators[$emulator]['urn'],
            'style'    => SOAP_RPC,
            'login'    => $row->console_username,
            'password' => decrypt($row->console_password),
            'trace'    => true
        ]);

        try {
            $response = $client->executeCommand(new \SoapParam($command, 'command'));

            if ($return) {
                return $response;
            }

            return true;
        } catch (\SoapFault $fault) {
            if ($return) {
                return $fault->faultstring;
            }

            return false;
        }
    }
}
