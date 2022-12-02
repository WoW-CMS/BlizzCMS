<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_characters_model extends CI_Model
{
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
     * Connect to characters DB
     *
     * @param int $realm
     * @return object
     */
    public function connect($realm)
    {
        $row = $this->realm_model->find(['id' => $realm]);

        if (empty($row)) {
            show_error(lang('error_characters_db_not_found'));
        }

        $database = $this->load->database([
            'hostname' => $row->char_hostname,
            'username' => $row->char_username,
            'password' => decrypt($row->char_password),
            'database' => $row->char_database,
            'port'     => $row->char_port,
            'dbdriver' => 'mysqli',
            'pconnect' => FALSE,
            'char_set' => 'utf8mb4',
            'dbcollat' => 'utf8mb4_unicode_ci'
        ], true);

        if ($database->conn_id === false) {
            show_error(lang('error_characters_connection'));
        }

        return $database;
    }

    /**
     * Get character
     *
     * @param int $realm
     * @param int $guid
     * @return mixed
     */
    public function character($realm, $guid)
    {
        return $this->connect($realm)
            ->where('guid', $guid)
            ->get('characters')
            ->row();
    }

    /**
     * Get character guid
     *
     * @param int $realm
     * @param string $name
     * @return mixed
     */
    public function character_guid($realm, $name)
    {
        return $this->connect($realm)
            ->where('name', $name)
            ->get('characters')
            ->row('guid');
    }

    /**
     * Get character name
     *
     * @param int $realm
     * @param int $guid
     * @return mixed
     */
    public function character_name($realm, $guid)
    {
        $character = $this->character($realm, $guid);

        return ! empty($character) ? $character->name : null;
    }

    /**
     * Get character class
     *
     * @param int $realm
     * @param int $guid
     * @return mixed
     */
    public function character_class($realm, $guid)
    {
        $character = $this->character($realm, $guid);

        return ! empty($character) ? $character->class : null;
    }

    /**
     * Get character race
     *
     * @param int $realm
     * @param int $guid
     * @return mixed
     */
    public function character_race($realm, $guid)
    {
        $character = $this->character($realm, $guid);

        return ! empty($character) ? $character->race : null;
    }

    /**
     * Get character money
     *
     * @param int $realm
     * @param int $guid
     * @return mixed
     */
    public function character_money($realm, $guid)
    {
        $character = $this->character($realm, $guid);

        return ! empty($character) ? $character->money : null;
    }

    /**
     * Check if the character exists
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

        return $query === 1;
    }

    /**
     * Check if the character is linked to the account
     *
     * @param int $realm
     * @param int $guid
     * @param int $account
     * @return bool
     */
    public function character_linked($realm, $guid, $account)
    {
        $query = $this->connect($realm)
            ->where([
                'guid'    => $guid,
                'account' => $account
            ])
            ->get('characters')
            ->num_rows();

        return $query === 1;
    }

    /**
     * Count characters online
     *
     * @param int $realm
     * @param string|null $faction
     * @return int
     */
    public function characters_online($realm, $faction = null)
    {
        $query = $this->connect($realm)
            ->from('characters')
            ->where('online', 1);

        switch ($faction) {
            case 'alliance':
                $query->where_in('race', config_item('alliance_races'));
                break;

            case 'horde':
                $query->where_in('race', config_item('horde_races'));
                break;
        }

        return $query->count_all_results();
    }

    /**
     * Get all account characters
     *
     * @param int $realm
     * @param int $account
     * @return array
     */
    public function all_characters($realm, $account)
    {
        return $this->connect($realm)
            ->where('account', $account)
            ->get('characters')
            ->result();
    }
}
