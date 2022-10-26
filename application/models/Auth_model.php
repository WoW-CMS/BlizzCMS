<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Laizerox\Wowemu\SRP\UserClient;

class Auth_model extends CI_Model {

    /**
     * Auth_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function arraySession($id)
    {
        $data = array(
            'wow_sess_username'  => $this->getUsernameID($id),
            'blizz_sess_username' => $this->getSiteUsernameID($id),
            'wow_sess_email'     => $this->getEmailID($id),
            'wow_sess_id'        => $id,
            'wow_sess_expansion'	=> $this->getExpansionID($id),
            'wow_sess_last_ip'   => $this->getLastIPID($id),
            'wow_sess_last_login'=> $this->getLastLoginID($id),
            'wow_sess_gmlevel'   => $this->getRank($id),
            'wow_sess_ban_status'=> $this->getBanStatus($id),
            'logged_in' => TRUE
        );

        return $this->sessionConnect($data);
    }

    /**
     * @return [type]
     */
    public function randomUTF()
    {
        return rand(0, 999999999);
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getUsernameID($id)
    {
        return $this->auth->select('username')->where('id', $id)->get('account')->row('username');
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getSiteUsernameID($id)
    {
        return $this->db->select('username')->where('id', $id)->get('users')->row('username');
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getEmailID($id)
    {
        return $this->auth->select('email')->where('id', $id)->get('account')->row('email');
    }

    /**
	 * Validate password
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function valid_password($username, $password): bool
	{
		$account  = $this->auth->where('username', $username)->or_where('email', $username)->get('account')->row();
		$emulator = config_item('emulator');

		if (empty($account))
		{
			return false;
		}

		switch ($emulator)
		{
			case 'srp6':
				$validate = ($account->verifier === $this->game_hash($account->username, $password, 'srp6', $account->salt));
				break;
			case 'hex':
				$validate = (strtoupper($account->v) === $this->game_hash($account->username, $password, 'hex', $account->s));
				break;
			case 'old-trinity':
				$validate = hash_equals(strtoupper($account->sha_pass_hash), $this->game_hash($account->username, $password));
				break;
		}

		if (! isset($validate))
		{
			return false;
		}

		return $validate;
	}


    /**
     * @param mixed $account
     * 
     * @return [type]
     */
    public function getSpecifyAccount($account)
    {
        $account = strtoupper($account);

        return $this->auth->select('id')->where('username', $account)->get('account');
    }

    /**
     * @param mixed $email
     * 
     * @return [type]
     */
    public function getSpecifyEmail($email)
    {
        return $this->auth->select('id')->where('email', $email)->get('account');
    }


	/**
	 * @param $account
	 * @return string
	 */
	public function getIDAccount($account): string
	{
        $account = strtoupper($account);

        $qq = $this->auth->select('id')->where('username', $account)->get('account');
        
        if($qq->num_rows())
            return $qq->row('id');
        else
            return '0';
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getImageProfile($id)
    {
        return $this->db->select('profile')->where('id', $id)->get('users')->row('profile');
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getNameAvatar($id)
    {
        return $this->db->select('name')->where('id', $id)->get('avatars')->row('name');
    }


	/**
	 * @param $email
	 * @return string
	 */
	public function getIDEmail($email): string
	{
        $email = strtoupper($email);

        $qq = $this->auth->select('id')->where('email', $email)->get('account');

        if($qq->num_rows())
            return $qq->row('id');
        else
            return '0';
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getExpansionID($id)
    {
        return $this->auth->select('expansion')->where('id', $id)->get('account')->row('expansion');
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getLastIPID($id)
    {
        return $this->auth->select('last_ip')->where('id', $id)->get('account')->row('last_ip');
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getLastLoginID($id)
    {
        return $this->auth->select('last_login')->where('id', $id)->get('account')->row('last_login');
    }


	/**
	 * @param $id
	 * @return mixed
	 */
	public function getJoinDateID($id)
    {
        return $this->auth->select('joindate')->where('id', $id)->get('account')->row('joindate');
    }


	/**
	 * @param $id
	 * @return int
	 */
	public function getRank($id = null): int
	{
        $account = ($id) ?? $this->session->userdata('wow_sess_id');

        $value = ($this->auth->field_exists('SecurityLevel', 'account_access')) ? $this->auth->where('AccountID', $account)->get('account_access')->row('SecurityLevel') : 
            (($this->auth->field_exists('gmlevel', 'account'))  ? $this->auth->where('id', $account)->get('account')->row('gmlevel') : 
            $this->auth->where('id', $account)->get('account_access')->row('gmlevel'));

        if (! empty($value))
        {
            return $value;
        }

        return 0;
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getBanStatus($id): bool
	{
        $qq = $this->auth->select('*')->where('id', $id)->where('active', '1')->get('account_banned');

        if ($qq->num_rows())
            return true;
        else
            return false;
    }

    /**
     * @return [type]
     */
    public function isLogged(): bool
	{
        if ($this->session->userdata('wow_sess_username'))
            return true;
        else
            return false;
    }

    /**
     * @param mixed $data
     * 
     * @return [type]
     */
    public function sessionConnect($data): bool
	{
        $this->session->set_userdata($data);
        return true;
    }

    /**
     * @return [type]
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(),'refresh');
    }

    /**
     * @param mixed $username
     * @param mixed $password
     * @param null $type
     * @param null $salt
     * 
     * @return [type]
     */
    public function game_hash($username, $password, $type = null, $salt = null): string
	{
        switch ($type)
		{
			case 'bnet':
				return strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($username)) . ':' . strtoupper($password))))))));
				break;
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
				break;
			default:
				return strtoupper(sha1(strtoupper($username) . ':' . strtoupper($password)));
				break;
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
		$query = $this->auth->where($column, $data)->get('account')->num_rows();

		return ($query == 0);
	}
}
