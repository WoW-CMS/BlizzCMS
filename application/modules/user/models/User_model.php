<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	/**
	 * User_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->load->database('auth', TRUE);
	}

	public function changePassword($oldpass, $newpass, $renewpass)
	{
		$passnobnet = $this->auth->Account($this->session->userdata('username'), $oldpass);
		$passbnet = $this->auth->Battlenet($this->session->userdata('email'), $oldpass);
		$newaccpass = $this->auth->Account($this->session->userdata('username'), $newpass);
		$newaccbnetpass = $this->auth->Battlenet($this->session->userdata('email'), $newpass);

		if($this->base->getExpansionAction() == 1) {
			if($this->base->getEmulatorAction() == 1) {
				if ($this->auth->getPasswordBnetID($this->session->userdata('id')) == strtoupper($passbnet)) {
					if ($newaccbnetpass == $this->auth->getPasswordBnetID($this->session->userdata('id'))) {
						return 'samePass';
					}
					else
						if(strlen($newpass) >= 5 && strlen($newpass) <= 16) {
							if($newpass == $renewpass) {
								$change = array(
									'sha_pass_hash' => $newaccpass,
									'sessionkey' => '',
									'v' => '',
									's' => ''
								);
	
								$this->auth->where('id', $this->session->userdata('id'))->update('account', $change);
	
								$this->auth->set('sha_pass_hash', $newaccbnetpass)->where('id', $this->session->userdata('id'))->update('battlenet_accounts');
								return true;
							}
							else
								return 'noMatch';
						}
						else
							return 'lengError';
				}
				else
					return 'passnotMatch';
			}
			else
			{
				if ($this->auth->getPasswordAccountID($this->session->userdata('id')) == strtoupper($passnobnet)) {
					if($newaccpass == $this->auth->getPasswordAccountID($this->session->userdata('id'))) {
						return 'samePass';
					}
					else
						if(strlen($newpass) >= 5 && strlen($newpass) <= 16) {
							if ($newpass == $renewpass) {
									$change = array(
										'sha_pass_hash' => $newaccpass,
										'sessionkey' => '',
										'v' => '',
										's' => ''
									);
	
									$this->auth->where('id', $this->session->userdata('id'))->update('account', $change);
									return true;
							}
							else
								return 'noMatch';
						}
						else
							return 'lengError';
				}
				else
					return 'passnotMatch';
			}
		}
		elseif($this->base->getExpansionAction() == 2) {
			if ($this->auth->getPasswordBnetID($this->session->userdata('id')) == strtoupper($passbnet)) {
				if ($newaccbnetpass == $this->auth->getPasswordBnetID($this->session->userdata('id'))) {
					return 'samePass';
				}
				else
					if(strlen($newpass) >= 5 && strlen($newpass) <= 16) {
						if($newpass == $renewpass) {
							$change = array(
								'sha_pass_hash' => $newaccpass,
								'sessionkey' => '',
								'v' => '',
								's' => ''
							);

							$this->auth->where('id', $this->session->userdata('id'))->update('account', $change);

							$this->auth->set('sha_pass_hash', $newaccbnetpass)->where('id', $this->session->userdata('id'))->update('battlenet_accounts');
							return true;
						}
						else
							return 'noMatch';
					}
					else
						return 'lengError';
			}
			else
				return 'passnotMatch';
		}
		else
			return 'expError';
	}

	public function changeEmail($newemail, $renewemail, $password)
	{
		$nobnet = $this->auth->Account($this->session->userdata('username'), $password);
		$bnet = $this->auth->Battlenet($this->session->userdata('email'), $password);
		$newbnetpass = $this->auth->Battlenet($newemail, $password);

		if($this->base->getExpansionAction() == 1) {
			if($this->base->getEmulatorAction() == 1) {
				if ($this->auth->getPasswordBnetID($this->session->userdata('id')) == strtoupper($bnet)) {
					if($newemail == $renewemail) {
						if($this->getExistEmail(strtoupper($newemail)) > 0) {
							return 'usedEmail';
						}
						else
							$this->auth->set('email', $newemail)->where('id', $this->session->userdata('id'))->update('account');
	
							$this->db->set('email', $newemail)->where('id', $this->session->userdata('id'))->update('users');
	
							$update = array(
								'sha_pass_hash' => $newbnetpass,
								'email' => $newemail
							);
	
							$this->auth->where('id', $this->session->userdata('id'))->update('battlenet_accounts', $update);
							return true;
					}
					else
						return 'enoMatch';
				}
				else
					return 'epassnotMatch';
			}
			else
			{
				if ($this->auth->getPasswordAccountID($this->session->userdata('id')) == strtoupper($nobnet)) {
					if($newemail == $renewemail) {
						if($this->getExistEmail(strtoupper($newemail)) > 0) {
							return 'usedEmail';
						}
						else
							$this->auth->set('email', $newemail)->where('id', $this->session->userdata('id'))->update('account');

							$this->db->set('email', $newemail)->where('id', $this->session->userdata('id'))->update('users');
							return true;
					}
					else
						return 'enoMatch';
				}
				else
					return 'epassnotMatch';
			}
		}
		elseif($this->base->getExpansionAction() == 2) {
			if ($this->auth->getPasswordBnetID($this->session->userdata('id')) == strtoupper($bnet)) {
				if($newemail == $renewemail) {
					if($this->getExistEmail(strtoupper($newemail)) > 0) {
						return 'usedEmail';
					}
					else
						$this->auth->set('email', $newemail)->where('id', $this->session->userdata('id'))->update('account');

						$this->db->set('email', $newemail)->where('id', $this->session->userdata('id'))->update('users');

						$update = array(
							'sha_pass_hash' => $newbnetpass,
							'email' => $newemail
						);

						$this->auth->where('id', $this->session->userdata('id'))->update('battlenet_accounts', $update);
						return true;
				}
				else
					return 'enoMatch';
			}
			else
				return 'epassnotMatch';
		}
		else
			return 'expaError';
	}

	public function getExistEmail($email)
	{
		return $this->auth->select('email')->where('email', $email)->get('account')->num_rows();
	}

	public function getAllAvatars()
	{
		return $this->db->order_by('id ASC')->get('avatars');
	}

	public function changeAvatar($avatar)
	{
		$this->db->set('profile', $avatar)->where('id', $this->session->userdata('id'))->update('users');
		return true;
	}

	public function getDateMember($id)
	{
		$qq = $this->db->select('joindate')->where('id', $id)->get('users');

		if ($qq->num_rows())
			return $qq->row('joindate');
		else
			return 'Unknow';
	}

	public function getExpansion($id)
	{
		$qq = $this->db->select('expansion')->where('id', $id)->get('users');

		if ($qq->num_rows())
			return $qq->row('expansion');
		else
			return 'Unknow';
	}

	public function getLastIp($id)
	{
		return $this->auth->select('last_ip')->where('id', $id)->get('account')->row('last_ip');
	}

	public function checklogin($username, $password)
	{
		$id = $this->auth->getIDAccount($username);

		if ($id == "0")
			return 'uspErr';
		else
		{
			$password = $this->auth->Account($username, $password);

			if (strtoupper($this->auth->getPasswordAccountID($id)) == strtoupper($password))
				return $this->auth->arraySession($id);
			else
				return 'uspErr';
		}
	}

	public function checkloginbattle($email, $password)
	{
		$id = $this->auth->getIDEmail($email);

		if ($id == "0")
			return 'empErr';
		else
		{
			$password = $this->auth->Battlenet($email, $password);

			if (strtoupper($this->auth->getPasswordBnetID($id)) == strtoupper($password))
				return $this->auth->arraySession($id);
			else
				return 'empErr';
		}
	}

	public function insertRegister($username, $email, $password, $repassword)
	{
		$date = now();
		$expansion = $this->base->getRealExpansionDB();
		$passwordAc = $this->auth->Account($username, $password);
		$passwordBn = $this->auth->Battlenet($email, $password);

		$checkuser = $this->auth->getIDAccount($username);
		$checkemail = $this->auth->getIDEmail($email);
		$pendinguser = $this->getIDPendingUsername($username);
		$pendingemail = $this->getIDPendingEmail($email);

		if($checkuser == "0" && $pendinguser == "0") {
			if($checkemail == "0" && $pendingemail == "0") {
				if(strlen($password) >= 5 && strlen($password) <= 16 || strlen($repassword) >= 5 && strlen($repassword) <= 16) {
					if($password == $repassword)
					{
						if(config_item('account_activation_required') == TRUE)
						{
							$data = array(
								'username' => $username,
								'email' => $email,
								'password' => $passwordAc,
								'password_bnet' => $passwordBn,
								'expansion' => $expansion,
								'joindate' => $date,
								'key' => sha1($username.$email.$date)
							);

							$this->db->insert('pending_users', $data);

							$link = base_url().'activate/'.$data['key'];

							$mail_message = 'Hi, You have created the account <span style="font-weight: bold;text-transform: uppercase;">'.$username.'</span> please use this link to activate your account: <a target="_blank" href="'.$link.'" class="font-weight: bold;">Activate Now</a><br>';
							$mail_message .= 'Kind regards,<br>';
							$mail_message .= config_item('email_settings_sender_name').' Support.';

							$this->base->smtpSendEmail($email, lang('email_account_activation'), $mail_message);
							return 'regAct';
						}
						else
						{
							if ($this->base->getExpansionAction() == 1)
							{
								if($this->base->getEmulatorAction() == 1)
								{
									$data = array(
										'username' => $username,
										'sha_pass_hash' => $passwordAc,
										'email' => $email,
										'expansion' => $expansion,
										'battlenet_index' => '1',
									);
	
									$this->auth->insert('account', $data);
	
									$id = $this->auth->getIDAccount($username);
	
									$data1 = array(
										'id' => $id,
										'email' => $email,
										'sha_pass_hash' => $passwordBn,
									);
	
									$this->auth->insert('battlenet_accounts', $data1);
	
									$this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
								}
								else
								{
									$data = array(
										'username' => $username,
										'sha_pass_hash' => $passwordAc,
										'email' => $email,
										'expansion' => $expansion,
									);
	
									$this->auth->insert('account', $data);
								}

							}
							else
							{
								$data = array(
									'username' => $username,
									'sha_pass_hash' => $passwordAc,
									'email' => $email,
									'expansion' => $expansion,
									'battlenet_index' => '1',
								);

								$this->auth->insert('account', $data);

								$id = $this->auth->getIDAccount($username);

								$data1 = array(
									'id' => $id,
									'email' => $email,
									'sha_pass_hash' => $passwordBn,
								);

								$this->auth->insert('battlenet_accounts', $data1);

								$this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
							}

							$id = $this->auth->getIDAccount($username);

							$data3 = array(
								'id' => $id,
								'username' => $username,
								'email' => $email,
								'joindate' => $date
							);

							$this->db->insert('users', $data3);
							return true;
						}
					}
					else
						return 'regPass';
				}
				else
					return 'regLeng';
			}
			else
				return 'regEmail';
		}
		else
			return 'regUser';
	}

	public function checkuserid($username)
	{
		return $this->auth->select('id')->where('username', $username)->get('account')->row('id');
	}

	public function checkemailid($email)
	{
		return $this->auth->select('id')->where('email', $email)->get('account')->row('id');
	}

	public function sendpassword($username, $email)
	{
		$ucheck = $this->checkuserid($username);
		$echeck = $this->checkemailid($email);

		if ($ucheck == $echeck)
		{
			$allowed_chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$password_generated = "";
			$password_generated = substr(str_shuffle($allowed_chars), 0, 14);
			$newpass = $password_generated;
			$newpassI = $this->auth->Account($username, $newpass);
			$newpassII = $this->auth->Battlenet($email, $newpass);

			if ($this->base->getExpansionAction() == 1)
			{
				$accupdate = array(
					'sha_pass_hash' => $newpassI,
					'sessionkey' => '',
					'v' => '',
					's' => ''
				);

				$this->auth->where('id', $ucheck)->update('account', $accupdate);
			}
			else
			{
				$accupdate = array(
					'sha_pass_hash' => $newpassI,
					'sessionkey' => '',
					'v' => '',
					's' => ''
				);

				$this->auth->where('id', $ucheck)->update('account', $accupdate);

				$this->auth->set('sha_pass_hash', $newpassII)->where('id', $echeck)->update('battlenet_accounts');
			}

			$mail_message = 'Hi, <span style="font-weight: bold;text-transform: uppercase;">'.$username.'</span> You have sent a request for your account password to be reset.<br>';
			$mail_message .= 'Your new password is: <span style="font-weight: bold;">'.$password_generated.'</span><br>';
			$mail_message .= 'Please change your password again as soon as you log in!<br>';
			$mail_message .= 'Kind regards,<br>';
			$mail_message .= config_item('email_settings_sender_name').' Support.';

			return $this->base->smtpSendEmail($email, lang('email_password_recovery'), $mail_message);
		}
		else
			return 'sendErr';
	}

	public function getIDPendingUsername($account)
	{
		return $this->db->select('id')->where('username', $account)->get('pending_users')->num_rows();
	}

	public function getIDPendingEmail($email)
	{
		return $this->db->select('id')->where('email', $email)->get('pending_users')->num_rows();
	}

	public function checkPendingUser($key)
	{
		return $this->db->select('id')->where('key', $key)->get('pending_users')->num_rows();
	}

	public function getTempUser($key)
	{
		return $this->db->where('key', $key)->get('pending_users')->row_array();
	}

	public function removeTempUser($key)
	{
		return $this->db->where('key', $key)->delete('pending_users');
	}

	public function activateAccount($key)
	{

		$check = $this->checkPendingUser($key);
		$temp = $this->getTempUser($key);

		if($check == "1") {
			if ($this->base->getExpansionAction() == 1)
			{
				$data = array(
					'username' => $temp['username'],
					'sha_pass_hash' => $temp['password'],
					'email' => $temp['email'],
					'expansion' => $temp['expansion'],
				);

				$this->auth->insert('account', $data);
			}
			else
			{
				$data = array(
					'username' => $temp['username'],
					'sha_pass_hash' => $temp['password'],
					'email' => $temp['email'],
					'expansion' => $temp['expansion'],
					'battlenet_index' => '1',
				);

				$this->auth->insert('account', $data);

				$id = $this->auth->getIDAccount($temp['username']);

				$data1 = array(
					'id' => $id,
					'email' => $temp['email'],
					'sha_pass_hash' => $temp['password_bnet']
				);

				$this->auth->insert('battlenet_accounts', $data1);

				$this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
			}

			$id = $this->auth->getIDAccount($temp['username']);

			$data3 = array(
				'id' => $id,
				'username' => $temp['username'],
				'email' => $temp['email'],
				'joindate' => $temp['joindate']
			);

			$this->db->insert('users', $data3);

			$this->removeTempUser($key);

			$this->session->set_flashdata('account_activation','true');
			redirect(base_url('login'));
		}
		else
			$this->session->set_flashdata('account_activation','false');
			redirect(base_url('login'));
	}


	/**
	 * Change UserName for website
	 */

	 public function changeUsername($newusername, $renewusername, $password)
	 {
		$nobnet = $this->auth->Account($this->session->userdata('username'), $password);
		$bnet = $this->auth->Battlenet($this->session->userdata('email'), $password);

		if($this->base->getExpansionAction() == 1) {
			if($this->base->getEmulatorAction() == 1) {
				if ($this->auth->getPasswordBnetID($this->session->userdata('id')) == strtoupper($bnet)) {
					if($newusername == $renewusername) {
						$this->db->set('username', $newusername)->where('id', $this->session->userdata('id'))->update('users');
						return true;
					}
					else
						return 'enoMatch';
				}
				else
					return 'epassnotMatch';
			}
			else
			{
				if ($this->auth->getPasswordAccountID($this->session->userdata('id')) == strtoupper($nobnet)) {
					if($newusername == $renewusername) {
						$this->db->set('username', $newusername)->where('id', $this->session->userdata('id'))->update('users');
						return true;
					}
					else
						return 'enoMatch';
				}
				else
					return 'epassnotMatch';
			}
		}
		else
		{
			if ($this->auth->getPasswordBnetID($this->session->userdata('id')) == strtoupper($bnet)) {
				if($newusername == $renewusername) {
					$this->db->set('username', $newusername)->where('id', $this->session->userdata('id'))->update('users');
					return true;
				}
				else
					return 'enoMatch';
			}
			else
				return 'epassnotMatch';
		}
	 }
}
