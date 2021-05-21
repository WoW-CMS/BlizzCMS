<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	/**
	 * User_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->load->database('auth', true);
	}
	
	/**
	 * @param mixed $email
	 *
	 * @return [type]
	 */
	public function getExistEmail($email)
	{
		return $this->auth->select('email')->where('email', $email)->get('account')->num_rows();
	}

	/**
	 * @return [type]
	 */
	public function getAllAvatars()
	{
		return $this->db->select('*')->order_by('id ASC')->get('avatars');
	}

	/**
	 * @param mixed $avatar
	 *
	 * @return [type]
	 */
	public function changeAvatar($avatar)
	{
		$this->db->set('profile', $avatar)->where('id', $this->session->userdata('wow_sess_id'))->update('users');
		return true;
	}

	/**
	 * @param mixed $id
	 *
	 * @return [type]
	 */
	public function getDateMember($id)
	{
		$qq = $this->db->select('joindate')->where('id', $id)->get('users');

		if ($qq->num_rows()) {
			return $qq->row('joindate');
		} else {
			return 'Unknow';
		}
	}

	/**
	 * @param mixed $id
	 *
	 * @return [type]
	 */
	public function getExpansion($id)
	{
		$qq = $this->db->select('expansion')->where('id', $id)->get('users');

		if ($qq->num_rows()) {
			return $qq->row('expansion');
		} else {
			return 'Unknow';
		}
	}

	/**
	 * @param mixed $id
	 *
	 * @return [type]
	 */
	public function getLastIp($id)
	{
		return $this->auth->select('last_ip')->where('id', $id)->get('account')->row('last_ip');
	}

	/**
	 * Check if user exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_user($id)
	{
		$query = $this->db->where('id', $id)->get('users')->num_rows();

		return ($query == 1);
	}


	/**
	 * @param mixed $username
	 * @param mixed $password
	 *
	 * @return [type]
	 */
	public function authentication($username, $password)
	{
		$accgame =  $this->auth->where('username', $username)->or_where('email', $username)->get('account')->row();
		$emulator = $this->config->item('emulator');

		if (empty($accgame)) {
			return false;
		}

		switch ($emulator) {
			case 'srp6':
				if ($this->auth->field_exists('verifier', 'account')):
					$validate = ($accgame->verifier === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
				else:
					$validate = ($accgame->v === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->s));
				endif;
				break;
			case 'hex':
				$validate = (strtoupper($accgame->v) === $this->wowauth->game_hash($accgame->username, $password, 'hex', $accgame->s));
				break;
			case 'old-trinity':
				$validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->wowauth->game_hash($accgame->username, $password));
				break;
		}

		if (!isset($validate) || !$validate) {
			return false;
		}

		// if account on website don't exist sync values from game account
		if (!$this->find_user($accgame->id)) {
			$this->db->insert('users', [
				'id'        => $accgame->id,
				'username'  => $accgame->username,
				'email'     => $accgame->email,
				'joindate' => strtotime($accgame->joindate)
			]);
		}

		$this->wowauth->arraySession($accgame->id);

		return true;
	}

	/**
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @param mixed $emulator
	 *
	 * @return [type]
	 */
	public function insertRegister($username, $email, $password, $emulator)
	{
		$date = $this->wowgeneral->getTimestamp();
		$expansion = $this->wowgeneral->getRealExpansionDB();
		$emulator = $this->config->item('emulator');

		if ($emulator == "srp6") {
			$salt = random_bytes(32);

			if ($this->auth->field_exists('session_key', 'account')):
				$data = [
					'username'  => $username,
					'salt'      => $salt,
					'verifier' => $this->wowauth->game_hash($username, $password, 'srp6', $salt),
					'email'     => $email,
					'expansion' => $expansion,
					'session_key' => null
				];
			else:
				$data = [
					'username'  => $username,
					'salt'      => $salt,
					'verifier' => $this->wowauth->game_hash($username, $password, 'srp6', $salt),
					'email'     => $email,
					'expansion' => $expansion,
					'session_key_auth' => null,
					'session_key_bnet' => null
				];
			endif;

			$this->auth->insert('account', $data);

		} elseif ($emulator == "hex") {
			$salt = strtoupper(bin2hex(random_bytes(32)));

			$data = [
				'username'  => $username,
				'v'          => $this->wowauth->game_hash($username, $password, 'hex', $salt),
				's'          => $salt,
				'email'     => $email,
				'expansion' => $expansion,
				'last_ip' => '127.0.0.1'
			];

			$this->auth->insert('account', $data);
		} elseif ($emulator == "old-trinity") {
			$data = [
				'username'  => $username,
				'sha_pass_hash' => $this->wowauth->game_hash($username, $password),
				'email'     => $email,
				'expansion' => $expansion,
				'sessionkey'    => '',
			];

			$this->auth->insert('account', $data);
		}

		$id = $this->wowauth->getIDAccount($username);

		if ($this->config->item('bnet_enabled')) {
			$data1 = [
				'id' => $id,
				'email' => $email,
				'sha_pass_hash' => $this->wowauth->game_hash($email, $password, 'bnet')
			];

			$this->auth->insert('battlenet_accounts', $data1);

			$this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
			$this->auth->set('battlenet_index', '1')->where('id', $id)->update('account');
		}

		$website = [
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'joindate' => $date,
			'dp' => 0,
			'vp' => 0
		];

		$this->db->insert('users', $website);

		return true;
	}

	/**
	 * @param mixed $username
	 *
	 * @return [type]
	 */
	public function checkuserid($username)
	{
		return $this->auth->select('id')->where('username', $username)->get('account')->row('id');
	}

	/**
	 * @param mixed $email
	 *
	 * @return [type]
	 */
	public function checkemailid($email)
	{
		return $this->auth->select('id')->where('email', $email)->get('account')->row('id');
	}

	/**
	 * @param mixed $username
	 * @param mixed $email
	 *
	 * @return [type]
	 */
	public function sendpassword($username, $email)
	{
		$ucheck = $this->checkuserid($username);
		$echeck = $this->checkemailid($email);

		if ($ucheck == $echeck) {
			$allowed_chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$password_generated = "";
			$password_generated = substr(str_shuffle($allowed_chars), 0, 14);
			$newpass = $password_generated;
			$newpassI = $this->wowauth->Account($username, $newpass);
			$newpassII = $this->wowauth->Battlenet($email, $newpass);

			if ($this->wowgeneral->getExpansionAction() == 1) {
				$accupdate = [
					'sha_pass_hash' => $newpassI,
					'sessionkey' => '',
					'v' => '',
					's' => ''
				];

				$this->auth->where('id', $ucheck)->update('account', $accupdate);
			} else {
				$accupdate = [
					'sha_pass_hash' => $newpassI,
					'sessionkey' => '',
					'v' => '',
					's' => ''
				];

				$this->auth->where('id', $ucheck)->update('account', $accupdate);

				$this->auth->set('sha_pass_hash', $newpassII)->where('id', $echeck)->update('battlenet_accounts');
			}

			$mail_message = 'Hi, <span style="font-weight: bold;text-transform: uppercase;">' . $username . '</span> You have sent a request for your account password to be reset.<br>';
			$mail_message .= 'Your new password is: <span style="font-weight: bold;">' . $password_generated . '</span><br>';
			$mail_message .= 'Please change your password again as soon as you log in!<br>';
			$mail_message .= 'Kind regards,<br>';
			$mail_message .= $this->config->item('email_settings_sender_name') . ' Support.';

			return $this->wowgeneral->smtpSendEmail($email, $this->lang->line('email_password_recovery'), $mail_message);
		} else {
			return 'sendErr';
		}
	}

	/**
	 * @param mixed $account
	 *
	 * @return [type]
	 */
	public function getIDPendingUsername($account)
	{
		return $this->db->select('id')->where('username', $account)->get('pending_users')->num_rows();
	}

	/**
	 * @param mixed $email
	 *
	 * @return [type]
	 */
	public function getIDPendingEmail($email)
	{
		return $this->db->select('id')->where('email', $email)->get('pending_users')->num_rows();
	}

	/**
	 * @param mixed $key
	 *
	 * @return [type]
	 */
	public function checkPendingUser($key)
	{
		return $this->db->select('id')->where('key', $key)->get('pending_users')->num_rows();
	}

	/**
	 * @param mixed $key
	 *
	 * @return [type]
	 */
	public function getTempUser($key)
	{
		return $this->db->select('*')->where('key', $key)->get('pending_users')->row_array();
	}

	/**
	 * @param mixed $key
	 *
	 * @return [type]
	 */
	public function removeTempUser($key)
	{
		return $this->db->where('key', $key)->delete('pending_users');
	}

	/**
	 * @param mixed $key
	 *
	 * @return [type]
	 */
	public function activateAccount($key)
	{
		$check = $this->checkPendingUser($key);
		$temp = $this->getTempUser($key);

		if ($check == "1") {
			if ($this->wowgeneral->getExpansionAction() == 1) {
				$data = [
					'username' => $temp['username'],
					'sha_pass_hash' => $temp['password'],
					'email' => $temp['email'],
					'expansion' => $temp['expansion'],
				];

				$this->auth->insert('account', $data);
			} else {
				$data = [
					'username' => $temp['username'],
					'sha_pass_hash' => $temp['password'],
					'email' => $temp['email'],
					'expansion' => $temp['expansion'],
					'battlenet_index' => '1',
				];

				$this->auth->insert('account', $data);

				$id = $this->wowauth->getIDAccount($temp['username']);

				$data1 = [
					'id' => $id,
					'email' => $temp['email'],
					'sha_pass_hash' => $temp['password_bnet']
				];

				$this->auth->insert('battlenet_accounts', $data1);

				$this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
			}

			$id = $this->wowauth->getIDAccount($temp['username']);

			$data3 = [
				'id' => $id,
				'username' => $temp['username'],
				'email' => $temp['email'],
				'joindate' => $temp['joindate']
			];

			$this->db->insert('users', $data3);

			$this->removeTempUser($key);

			$this->session->set_flashdata('account_activation', 'true');
			redirect(base_url('login'));
		} else {
			$this->session->set_flashdata('account_activation', 'false');
		}
		redirect(base_url('login'));
	}


	 /**
	  * @param mixed $username
	  * @param mixed $newusername
	  * @param mixed $password
	  * 
	  * @return [type]
	  */
	 public function changeUsername($username, $newusername, $password)
	 {
		$accgame =  $this->auth->where('username', $username)->or_where('email', $username)->get('account')->row();
		$id = $this->session->userdata('wow_sess_id');
		$emulator = $this->config->item('emulator');

		if (empty($accgame)) {
			return false;
		}

		switch ($emulator) {
			case 'srp6':
				$validate = ($accgame->verifier === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
				break;
			case 'hex':
				$validate = (strtoupper($accgame->v) === $this->wowauth->game_hash($accgame->username, $password, 'hex', $accgame->s));
				break;
			case 'old_trinity':
				$validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->wowauth->game_hash($accgame->username, $password));
				break;
		}

		if (!isset($validate) || !$validate) {
			return false;
		}

		$query = $this->db->set('username', $newusername)->where('id', $id)->or_where('username', $username)->update('users');

		if (empty($query))
			return false;
		else        
			$this->auth->set('username', $newusername)->where('id', $id)->or_where('username', $username)->update('account');
			if ($this->generateHash($emulator, $newusername, $password))
				return true;
			else
				return false;
	 }

	 /**
	  * @param mixed $oldpass
	  * @param mixed $newpass
	  * @param mixed $renewpass
	  * 
	  * @return [type]
	  */
	 public function changePassword($newpass)
	 {
		$accgame = $this->auth->where('id', $this->session->userdata('wow_sess_id'))->get('account')->row();
		$emulator = $this->config->item('emulator');

		if (empty($accgame)) {
			return false;
		}

		if ($this->generateHash($emulator, $accgame->username, $newpass)) {
				 return true;
		} else {
				 return false;
		}
	 }

	 /**
	  * @param mixed $email
	  * @param mixed $newemail
	  * @param mixed $password
	  * 
	  * @return [type]
	  */
	 public function changeEmail($email, $newemail, $password)
	 {
		$accgame =  $this->auth->where('email', $email)->get('account')->row();
		$id = $this->session->userdata('wow_sess_id');
		$emulator = $this->config->item('emulator');

		if (empty($accgame)) {
			return false;
		}

		switch ($emulator) {
			case 'srp6':
				$validate = ($accgame->verifier === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
				break;
			case 'hex':
				$validate = (strtoupper($accgame->v) === $this->wowauth->game_hash($accgame->username, $password, 'hex', $accgame->s));
				break;
			case 'old_trinity':
				$validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->wowauth->game_hash($accgame->username, $password));
				break;
		}

		if (!isset($validate) || !$validate) {
			return false;
		}

		$query = $this->db->set('email', $newemail)->where('id', $id)->or_where('email', $email)->update('users');

		if (empty($query))
			return false;
		else        
			$this->auth->set('email', $newemail)->where('id', $id)->or_where('email', $email)->update('account');
			if ($this->generateHash($emulator, $accgame->username, $password))
				return true;
			else
				return false;
	 }

	 /**
	  * @param mixed $emulator
	  * @param mixed $username
	  * @param mixed $password
	  * 
	  * @return [type]
	  */
	 public function generateHash($emulator, $username, $password)
	 {
		if ($emulator == "srp6") {
			$salt = random_bytes(32);

			$data = [
				'salt'      => $salt,
				'verifier' => $this->wowauth->game_hash($username, $password, 'srp6', $salt)
			];

			$this->auth->where('username', $username)->update('account', $data);

		} elseif ($emulator == "hex") {
			$salt = strtoupper(bin2hex(random_bytes(32)));

			$data = [
				'v'          => $this->wowauth->game_hash($username, $password, 'hex', $salt),
				's'          => $salt,
			];

			$this->auth->where('username', $username)->update('account', $data);
		} elseif ($emulator == "old-trinity") {
			$data = [
				'sha_pass_hash' => $this->wowauth->game_hash($username, $password),
			];

			$this->auth->where('username', $username)->update('account', $data);
		}
		
		return true;
	 }

}
