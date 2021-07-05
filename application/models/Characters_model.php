<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Characters_model extends CI_Model
{
    /**
     * Return connection to the characters database of a realm
     *
     * @param int $realm
     * @return object
     */
    public function connect($realm)
    {
        $row = $this->realms->find(['id' => $realm]);

        if (empty($row)) {
            show_error(lang('characters_db_notfound'));
        }

        $db = $this->load->database([
            'hostname' => $row->char_hostname,
            'username' => $row->char_username,
            'password' => decrypt($row->char_password),
            'database' => $row->char_database,
            'port'     => $row->char_port,
            'dbdriver' => 'mysqli',
            'pconnect' => FALSE
        ], true);

        if ($db->conn_id === false) {
            show_error(lang('characters_connection_error'));
        }

        return $db;
    }

    /**
     * Check if character exists
     *
     * @param int $realm
     * @param int $guid
     * @return bool
     */
    public function character_exists($realm, $guid)
    {
        $query = $this->connect($realm)
                    ->where('guid', $guid)
                    ->get('characters')
                    ->num_rows();

        return $query == 1;
    }

    /**
     * Check if the character is linked to the account
     *
     * @param int $realm
     * @param int $account
     * @param int $guid
     * @return bool
     */
    public function character_linked($realm, $account, $guid)
    {
        $query = $this->connect($realm)
                    ->where(['guid' => $guid, 'account' => $account])
                    ->get('characters')
                    ->num_rows();

        return $query == 1;
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
        return $this->connect($realm)
                    ->where('guid', $guid)
                    ->get('characters')
                    ->row('name');
    }

    /**
     * Get character guid
     *
     * @param int $realm
     * @param string $name
     * @return int
     */
    public function character_guid($realm, $name)
    {
        return $this->connect($realm)
                    ->where('name', $name)
                    ->get('characters')
                    ->row('guid');
    }

    /**
     * Get character class
     *
     * @param int $realm
     * @param int $guid
     * @return int
     */
    public function character_class($realm, $guid)
    {
        return $this->connect($realm)
                    ->where('guid', $guid)
                    ->get('characters')
                    ->row('class');
    }

    /**
     * Get character race
     *
     * @param int $realm
     * @param int $guid
     * @return int
     */
    public function character_race($realm, $guid)
    {
        return $this->connect($realm)
                    ->where('guid', $guid)
                    ->get('characters')
                    ->row('race');
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
        return $this->connect($realm)
                    ->where('account', $account)
                    ->get('characters')
                    ->result();
    }

    /**
     * Count characters online
     *
     * @param int $realm
     * @param string|null $faction
     * @return int
     */
    public function online_characters($realm, $faction = null)
    {
        $query = $this->connect($realm)->from('characters')->where('online', 1);

        switch ($faction) {
            case 'horde':
                $query = $query->where_in('race', [2, 5, 6, 8, 9, 10, 26, 27, 28, 31, 35, 36]);
                break;
            case 'alliance':
                $query = $query->where_in('race', [1, 3, 4, 7, 11, 22, 25, 29, 30, 32, 34, 37]);
                break;
        }

        return $query->count_all_results();
    }
}