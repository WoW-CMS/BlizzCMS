<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Laizerox\Wowemu\SRP\UserClient;

class Auth_model extends CI_Model
{
	/**
	 * Return connection to auth DB
	 *
	 * @return object
	 */
	public function connect()
	{
		$auth_db = $this->load->database('auth', TRUE);

		if ($auth_db->conn_id === FALSE)
		{
			show_error(lang('auth_connection_error'));
		}

		return $auth_db;
	}

	/**
	 * Validate password
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function valid_password($username, $password)
	{
		$account  = $this->connect()->where('username', $username)->or_where('email', $username)->get('account')->row();
		$emulator = config_item('emulator');

		if (empty($account))
		{
			return false;
		}

		switch ($emulator)
		{
			case 'trinity':
				$validate = ($account->verifier === $this->game_hash($account->username, $password, 'srp6', $account->salt));
				break;
			case 'cmangos':
				$validate = (strtoupper($account->v) === $this->game_hash($account->username, $password, 'hex', $account->s));
				break;
			case 'azeroth':
			case 'old_trinity':
			case 'mangos':
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
	 * Generate hashed password for game account
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $type
	 * @param mixed $salt
	 * @return mixed
	 */
	public function game_hash($username, $password, $type = null, $salt = null)
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
	 * Get auth account
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_account($id)
	{
		return $this->connect()->where('id', $id)->get('account')->row();
	}

	/**
	 * Get account id from a column value (username/email)
	 *
	 * @param mixed $value
	 * @param string $column
	 * @return int
	 */
	public function account_id($value, $column = 'username')
	{
		if (! in_array($column, ['username', 'email'], true))
		{
			return 0;
		}

		return $this->connect()->where($column, $value)->get('account')->row('id');
	}

	/**
	 * Check if username and email is unique in auth
	 *
	 * @param string $data
	 * @param string $column
	 * @return bool
	 */
	public function account_unique($data, $column = 'username')
	{
		$query = $this->connect()->where($column, $data)->get('account')->num_rows();

		return ($query == 0);
	}

	/**
	 * Get gmlevel of account
	 *
	 * @param int|null $id
	 * @return int
	 */
	public function get_gmlevel($id = null)
	{
		$id       = $id ?? $this->session->userdata('id');
		$emulator = config_item('emulator');

		if (in_array($emulator, ['trinity'], true))
		{
			$query = $this->connect()->where('AccountID', $id)->get('account_access')->row('SecurityLevel');		
		}
		elseif (in_array($emulator, ['mangos', 'cmangos'], true))
		{
			$query = $this->connect()->where('id', $id)->get('account')->row('gmlevel');		
		}
		elseif (in_array($emulator, ['azeroth', 'old_trinity'], true))
		{
			$query = $this->connect()->where('id', $id)->get('account_access')->row('gmlevel');
		}

		return ! empty($query) ? $query : 0;
	}

	/**
	 * Check if account is banned
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function is_banned($id = null)
	{
		$id = $id ?? $this->session->userdata('id');

		$query = $this->connect()->where(['id' => $id, 'active' => 1])->get('account_banned')->num_rows();

		return ($query >= 1);
	}

	/**
	 * Check if account has admin access
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function is_admin($id = null)
	{
		$config = config_item('admin_access_level');
		$access = $this->get_gmlevel($id);

		return ($access >= (int) $config);
	}

	/**
	 * Check if account has moderator access
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function is_moderator($id = null)
	{
		$config = config_item('mod_access_level');
		$access = $this->get_gmlevel($id);

		return ($access >= (int) $config);
	}
}