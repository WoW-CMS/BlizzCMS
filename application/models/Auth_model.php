<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Laizerox\Wowemu\SRP\UserClient;

class Auth_model extends CI_Model
{
    /**
     * Auth_model constructor.
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
    public function auth_database()
    {
        return $this->load->database('auth', TRUE);
    }

    /**
     * @return int
     */
    public function randomUTF()
    {
        return rand(0, 999999999);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUsernameID($id)
    {
        return $this->auth_database()
            ->where('id', $id)
            ->get('account')
            ->row('username');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSiteUsernameID($id)
    {
        return $this->db->where('id', $id)
            ->get('users')
            ->row('username');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getEmailID($id)
    {
        return $this->auth_database()
            ->where('id', $id)
            ->get('account')
            ->row('email');
    }

    /**
     * Validate password
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function valid_password($username, $password): bool
    {
        $account = $this->auth_database()
            ->where('username', $username)
            ->or_where('email', $username)
            ->get('account')
            ->row();

        $emulator = config_item('emulator');

        if (empty($account)) {
            return false;
        }

        switch ($emulator) {
            case 'srp6':
                $validate = ($account->verifier === $this->game_hash($account->username, $password, 'srp6', $account->salt));
                break;

            case 'hex':
                $validate = (strtoupper($account->v) === $this->game_hash($account->username, $password, 'hex', strtoupper($account->s)));
                break;

            case 'old-trinity':
                $validate = hash_equals(strtoupper($account->sha_pass_hash), $this->game_hash($account->username, $password));
                break;

            default:
                break;
        }

        if (! isset($validate)) {
            return false;
        }

        return $validate;
    }

    /**
     * @param string $account
     * 
     * @return [type]
     */
    public function getSpecifyAccount($account)
    {
        return $this->auth_database()
            ->select('id')
            ->where('username', $account)
            ->get('account');
    }

    /**
     * @param string $email
     * 
     * @return [type]
     */
    public function getSpecifyEmail($email)
    {
        return $this->auth_database()
            ->select('id')
            ->where('email', $email)
            ->get('account');
    }

    /**
     * @param string $account
     * @return int
     */
    public function getIDAccount($account)
    {
        $query = $this->auth_database()
            ->where('username', $account)
            ->get('account')
            ->row('id');

        if (! empty($query)) {
            return (int) $query;
        }

        return 0;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getImageProfile($id)
    {
        return $this->db->where('id', $id)
            ->get('users')
            ->row('profile');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNameAvatar($id)
    {
        return $this->db->where('id', $id)
            ->get('avatars')
            ->row('name');
    }

    /**
     * @param string $email
     * @return int
     */
    public function getIDEmail($email)
    {
        $query = $this->auth_database()
            ->where('email', $email)
            ->get('account')
            ->row('id');

        if (! empty($query)) {
            return (int) $query;
        }

        return 0;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getExpansionID($id)
    {
        return $this->auth_database()
            ->where('id', $id)
            ->get('account')
            ->row('expansion');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getLastIPID($id)
    {
        $emulator = config_item('emulator');
        $authdb   = $this->auth_database();

        switch ($emulator) {
            case 'srp6':
                return $authdb->where('id', $id)->get('account')->row('last_ip');

            case 'hex':
                return $authdb->where('id', $id)->get('account_logons')->row('ip');

            case 'old-trinity':
                return $authdb->where('id', $id)->get('account')->row('last_ip');

            default:
                return 'Unknown';
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getLastLoginID($id)
    {
        $emulator = config_item('emulator');
        $authdb   = $this->auth_database();

        switch ($emulator) {
            case 'srp6':
                return $authdb->where('id', $id)->get('account')->row('last_login');

            case 'hex':
                return $authdb->where('id', $id)->get('account_logons')->row('loginTime');

            case 'old-trinity':
                return $authdb->where('id', $id)->get('account')->row('last_login');

            default:
                return 'Unknown';
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getJoinDateID($id)
    {
        return $this->auth_database()
            ->where('id', $id)
            ->get('account')
            ->row('joindate');
    }

    /**
     * @param int|null $id
     * @return int
     */
    public function getRank($id = null): int
    {
        $id ??= $this->session->userdata('wow_sess_id');
        $emulator = config_item('emulator');
        $authdb   = $this->auth_database();

        switch ($emulator) {
            case 'srp6':
                $value = ($authdb->field_exists('SecurityLevel', 'account_access')) ? $authdb->where('AccountID', $id)->get('account_access')->row('SecurityLevel') : 
                    (($authdb->field_exists('gmlevel', 'account'))  ? $authdb->where('id', $id)->get('account')->row('gmlevel') : 
                        $authdb->where('id', $id)->get('account_access')->row('gmlevel'));
                break;

            case 'hex':
                $value = $authdb->where('id', $id)->get('account')->row('gmlevel');
                break;

            case 'old-trinity':
                $value = ($authdb->field_exists('SecurityLevel', 'account_access')) ? $authdb->where('AccountID', $id)->get('account_access')->row('SecurityLevel') : 
                    (($authdb->field_exists('gmlevel', 'account'))  ? $authdb->where('id', $id)->get('account')->row('gmlevel') : 
                        $authdb->where('id', $id)->get('account_access')->row('gmlevel'));
                break;

            default:
                break;
        }

        if (! isset($value) || empty($value)) {
            return 0;
        }

        return (int) $value;
    }

    /**
     * @param mixed $id
     * @return bool
     */
    public function getBanStatus($id): bool
    {
        $query = $this->auth_database()
            ->where('id', $id)
            ->where('active', '1')
            ->get('account_banned')
            ->num_rows();

        if ($query >= 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        if ($this->session->userdata('wow_sess_id') && $this->session->logged_in) {
            return true;
        }

        return false;
    }

    /**
     * @param string $username
     * @param string $password
     * @param string|null $type
     * @param mixed $salt
     * @return string
     */
    public function game_hash($username, $password, $type = null, $salt = null): string
    {
        switch ($type) {
            case 'bnet':
                return strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($username)) . ':' . strtoupper($password))))))));

            case 'hex':
                $client = new UserClient($username, $salt);
                return strtoupper($client->generateVerifier($password));

            case 'srp6':
                // Constants
                $g = gmp_init(7);
                $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
                // Calculate first hash
                $h1 = sha1(strtoupper($username.':'.$password), TRUE);
                // Calculate second hash
                $h2 = sha1($salt.$h1, TRUE);
                // Convert to integer (little-endian)
                $h2 = gmp_import($h2, 1, GMP_LSW_FIRST);
                // g^h2 mod N
                $verifier = gmp_powm($g, $h2, $N);
                // Convert back to a byte array (little-endian)
                $verifier = gmp_export($verifier, 1, GMP_LSW_FIRST);
                // Pad to 32 bytes, remember that zeros go on the end in little-endian!
                $verifier = str_pad($verifier, 32, chr(0), STR_PAD_RIGHT);
                return $verifier;

            default:
                return strtoupper(sha1(strtoupper($username) . ':' . strtoupper($password)));
        }
    }

    /**
     * Check if username and email is unique in auth
     *
     * @param string $data
     * @param string $column
     * @return bool
     */
    public function account_unique($data, $column = 'username'): bool
    {
        $query = $this->auth_database()
            ->where($column, $data)
            ->get('account')
            ->num_rows();

        return ($query == 0);
    }
}
