<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_auth_model extends CI_Model
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
     * Connect to auth DB
     *
     * @return object
     */
    public function connect()
    {
        $database = $this->load->database('auth', true);

        if ($database->conn_id === false) {
            show_error(lang('error_auth_connection'));
        }

        return $database;
    }

    /**
     * Create account
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return int
     */
    public function create_account($username, $email, $password)
    {
        $emulator = config_item('app_emulator');
        $database = $this->connect();

        $account = [
            'username'  => $username,
            'email'     => $email,
            'expansion' => config_item('app_expansion')
        ];

        switch ($emulator) {
            case 'azeroth':
            case 'trinity':
                $salt = random_bytes(32);
                $account['salt'] = $salt;
                $account['verifier'] = client_pwd_hash($username, $password, 'srp6', $salt);
                break;

            case 'cmangos':
                $salt = bin2hex(random_bytes(32));
                $account['v'] = client_pwd_hash($username, $password, 'hex', $salt);
                $account['s'] = $salt;
                break;

            case 'mangos':
            case 'trinity_sha':
                $account['sha_pass_hash'] = client_pwd_hash($username, $password);
                break;
        }

        $database->insert('account', $account);

        $id = $this->account_id($username);

        // Create an BNET account if BNET is enabled and the table exists
        if (config_item('app_emulator_bnet') && $database->table_exists('battlenet_accounts')) {
            $database->insert('battlenet_accounts', [
                'id'            => $id,
                'email'         => $email,
                'sha_pass_hash' => client_pwd_hash($email, $password, 'bnet')
            ]);

            $database->update('account', [
                'battlenet_account' => $id,
                'battlenet_index'   => 1
            ], ['id' => $id]);
        }

        return $id;
    }

    /**
     * Get account
     *
     * @param int $id
     * @return mixed
     */
    public function account($id)
    {
        return $this->connect()
            ->where('id', $id)
            ->get('account')
            ->row();
    }

    /**
     * Get the account id by searching a value in a column
     *
     * @param string $value
     * @param string $column
     * @return int
     */
    public function account_id($value, $column = 'username')
    {
        if (! in_array($column, ['username', 'email'], true)) {
            return 0;
        }

        $query = $this->connect()
            ->where($column, $value)
            ->get('account')
            ->row('id');

        return empty($query) ? 0 : (int) $query;
    }

    /**
     * Check if an account with a column value exists
     *
     * @param string $value
     * @param string $column
     * @return bool
     */
    public function account_exists($value, $column = 'username')
    {
        if (! in_array($column, ['username', 'email'], true)) {
            return false;
        }

        $query = $this->connect()
            ->where($column, $value)
            ->get('account')
            ->num_rows();

        return $query === 1;
    }

    /**
     * Get the gmlevel of an account
     *
     * @param int|null $id
     * @return int
     */
    public function account_gmlevel($id = null)
    {
        $id ??= $this->session->userdata('id');
        $emulator = config_item('app_emulator');
        $database = $this->connect();

        switch ($emulator) {
            case 'trinity':
                $query = $database->where('AccountID', $id)
                    ->get('account_access')
                    ->row('SecurityLevel');
                break;

            case 'cmangos':
            case 'mangos':
                $query = $database->where('id', $id)
                    ->get('account')
                    ->row('gmlevel');
                break;

            case 'azeroth':
            case 'trinity_sha':
                $query = $database->where('id', $id)
                    ->get('account_access')
                    ->row('gmlevel');
                break;
        }

        if (! isset($query) || empty($query)) {
            return 0;
        }

        return (int) $query;
    }

    /**
     * Check if an account is banned
     *
     * @param int|null $id
     * @return bool
     */
    public function is_banned($id = null)
    {
        $id ??= $this->session->userdata('id');
        $database = $this->connect();

        $column = $database->field_exists('account_id', 'account_banned') ? 'account_id' : 'id';
        $query  = $database->from('account_banned')
            ->where([
                $column  => $id,
                'active' => 1
            ])
            ->count_all_results();

        return $query >= 1;
    }

    /**
     * Password verify
     *
     * @param string $password
     * @param int $account
     * @return bool
     */
    public function password_verify($password, $account)
    {
        $emulator = config_item('app_emulator');
        $row      = $this->account($account);

        if (empty($row)) {
            return false;
        }

        switch ($emulator) {
            case 'azeroth':
            case 'trinity':
                $validate = ($row->verifier === client_pwd_hash($row->username, $password, 'srp6', $row->salt));
                break;

            case 'cmangos':
                $validate = (strtoupper($row->v) === client_pwd_hash($row->username, $password, 'hex', $row->s));
                break;

            case 'mangos':
            case 'trinity_sha':
                $validate = hash_equals(strtoupper($row->sha_pass_hash), client_pwd_hash($row->username, $password));
                break;
        }

        if (! isset($validate)) {
            return false;
        }

        return $validate;
    }
}
