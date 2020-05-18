<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

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
        $passnobnet = $this->wowauth->Account($this->session->userdata('wow_sess_username'), $oldpass);
        $passbnet = $this->wowauth->Battlenet($this->session->userdata('wow_sess_email'), $oldpass);
        $newaccpass = $this->wowauth->Account($this->session->userdata('wow_sess_username'), $newpass);
        $newaccbnetpass = $this->wowauth->Battlenet($this->session->userdata('wow_sess_email'), $newpass);

        $change = array(
            'sha_pass_hash' => $newaccpass,
            'sessionkey' => '',
            'v' => '',
            's' => ''
        );

        if (strlen($newpass) < 5 && strlen($newpass) > 16) {
            return 'lengError';
        }

        if ($newpass != $renewpass) {
            return 'noMatch';
        }

        if ($this->wowgeneral->getExpansionAction() == 1) {
            if (strtoupper($this->wowauth->getPasswordAccountID($this->session->userdata('wow_sess_id'))) != strtoupper($passnobnet)) {
                return 'passnotMatch';
            }

            if ($newaccpass == strtoupper($this->wowauth->getPasswordAccountID($this->session->userdata('wow_sess_id')))) {
                return 'samePass';
            }

            $this->auth->where('id', $this->session->userdata('wow_sess_id'))->update('account', $change);
            return true;
        }

        if ($this->wowgeneral->getExpansionAction() == 2) {
            if (strtoupper($this->wowauth->getPasswordBnetID($this->session->userdata('wow_sess_id'))) != strtoupper($passbnet)) {
                return 'passnotMatch';
            }

            if ($newaccbnetpass == strtoupper($this->wowauth->getPasswordBnetID($this->session->userdata('wow_sess_id')))) {
                return 'samePass';
            }

            $this->auth->where('id', $this->session->userdata('wow_sess_id'))->update('account', $change);
            $this->auth->set('sha_pass_hash', $newaccbnetpass)->where('id', $this->session->userdata('wow_sess_id'))->update('battlenet_accounts');
            return true;
        }

        return 'expError';
    }

    public function changeEmail($newemail, $renewemail, $password)
    {
        $nobnet = $this->wowauth->Account($this->session->userdata('wow_sess_username'), $password);
        $bnet = $this->wowauth->Battlenet($this->session->userdata('wow_sess_email'), $password);
        $newbnetpass = $this->wowauth->Battlenet($newemail, $password);

        if ($newemail != $renewemail) {
            return 'enoMatch';
        }

        if ($this->getExistEmail(strtoupper($newemail)) > 0) {
            return 'usedEmail';
        }

        if ($this->wowgeneral->getExpansionAction() == 1) {
            if (strtoupper($this->wowauth->getPasswordAccountID($this->session->userdata('wow_sess_id'))) != strtoupper($nobnet)) {
                return 'epassnotMatch';
            }

            $this->auth->set('email', $newemail)->where('id', $this->session->userdata('wow_sess_id'))->update('account');

            $this->db->set('email', $newemail)->where('id', $this->session->userdata('wow_sess_id'))->update('users');

            return true;
        }

        if ($this->wowgeneral->getExpansionAction() == 2) {
            if (strtoupper($this->wowauth->getPasswordBnetID($this->session->userdata('wow_sess_id'))) != strtoupper($bnet)) {
                return 'epassnotMatch';
            }

            $this->auth->set('email', $newemail)->where('id', $this->session->userdata('wow_sess_id'))->update('account');

            $this->db->set('email', $newemail)->where('id', $this->session->userdata('wow_sess_id'))->update('users');

            $update = array(
                'sha_pass_hash' => $newbnetpass,
                'email' => $newemail
            );

            $this->auth->where('id', $this->session->userdata('wow_sess_id'))->update('battlenet_accounts', $update);
            return true;
        }

        return 'expaError';
    }

    public function getExistEmail($email)
    {
        return $this->auth->select('email')->where('email', $email)->get('account')->num_rows();
    }

    public function getAllAvatars()
    {
        return $this->db->select('*')->order_by('id ASC')->get('avatars');
    }

    public function changeAvatar($avatar)
    {
        $this->db->set('profile', $avatar)->where('id', $this->session->userdata('wow_sess_id'))->update('users');
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
        $id = $this->wowauth->getIDAccount($username);
        $password = $this->wowauth->Account($username, $password);

        if ($id == 0) {
            return 'uspErr';
        }

        if (strtoupper($this->wowauth->getPasswordAccountID($id)) == strtoupper($password))
            return $this->wowauth->arraySession($id);
        else
            return 'uspErr';
    }

    public function checkloginbattle($email, $password)
    {
        $id = $this->wowauth->getIDEmail($email);
        $password = $this->wowauth->Battlenet($email, $password);

        if ($id == 0) {
            return 'empErr';
        }

        if (strtoupper($this->wowauth->getPasswordBnetID($id)) == strtoupper($password))
            return $this->wowauth->arraySession($id);
        else
            return 'empErr';
    }

    public function insertRegister($username, $email, $password, $repassword)
    {
        $date = $this->wowgeneral->getTimestamp();
        $expansion = $this->wowgeneral->getRealExpansionDB();
        $passwordAc = $this->wowauth->Account($username, $password);
        $passwordBn = $this->wowauth->Battlenet($email, $password);

        $checkuser = $this->wowauth->getIDAccount($username);
        $checkemail = $this->wowauth->getIDEmail($email);
        $pendinguser = $this->getIDPendingUsername($username);
        $pendingemail = $this->getIDPendingEmail($email);

        if ($checkuser != 0 && $pendinguser != 0) {
            return 'regUser';
        }

        if ($checkemail != 0 && $pendingemail != 0) {
            return 'regEmail';
        }

        if (strlen($password) < 5 && strlen($password) > 16 || strlen($repassword) < 5 && strlen($repassword) > 16) {
            return 'regLeng';
        }

        if ($password != $repassword) {
            return 'regPass';
        }

        if ($this->config->item('account_activation_required') == TRUE) {

            $key = sha1($username.$email.$date);
            $link = base_url('activate/'.$key);

            $this->db->insert('pending_users', array(
                'username' => $username,
                'email' => $email,
                'password' => $passwordAc,
                'password_bnet' => $passwordBn,
                'expansion' => $expansion,
                'joindate' => $date,
                'key' => $key
            ));

            $mail_message = 'Hi, You have created the account <span style="font-weight: bold;text-transform: uppercase;">'.$username.'</span> please use this link to activate your account: <a target="_blank" href="'.$link.'" class="font-weight: bold;">Activate Now</a><br>';
            $mail_message .= 'Kind regards,<br>';
            $mail_message .= $this->config->item('email_settings_sender_name').' Support.';

            $this->wowgeneral->smtpSendEmail($email, $this->lang->line('email_account_activation'), $mail_message);
            return 'regAct';
        }

        if ($this->wowgeneral->getExpansionAction() == 1) {
            $this->auth->insert('account', array(
                'username' => $username,
                'sha_pass_hash' => $passwordAc,
                'email' => $email,
                'expansion' => $expansion,
            ));
        }
        else
        {
            $this->auth->insert('account', array(
                'username' => $username,
                'sha_pass_hash' => $passwordAc,
                'email' => $email,
                'expansion' => $expansion,
                'battlenet_index' => '1'
            ));

            $id = $this->wowauth->getIDAccount($username);

            $this->auth->insert('battlenet_accounts', array(
                'id' => $id,
                'email' => $email,
                'sha_pass_hash' => $passwordBn
            ));

            $this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
        }

        $id = $this->wowauth->getIDAccount($username);

        $this->db->insert('users', array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'joindate' => $date
        ));

        return true;
    }

    public function checkuserid($username)
    {
        return $this->auth->select('id')->where('username', $username)->get('account')->row('id');
    }

	public function checkRankWeb($id)
	{
		$db = $this->db->select('rank')->where('id', $id)->get('users')->row('rank');

		return $this->db->select('name')->where('id', $db)->get('permissions_groups')->row('name');

	}

    public function checkemailid($email)
    {
        return $this->auth->select('id')->where('email', $email)->get('account')->row('id');
    }

    public function sendpassword($username, $email)
    {
        $ucheck = $this->checkuserid($username);
        $echeck = $this->checkemailid($email);

        if ($ucheck != $echeck) {
            return 'sendErr';
        }

        $this->load->helper('string');

        $newpass = random_string('alnum', 14);
        $newpassI = $this->wowauth->Account($username, $newpass);
        $newpassII = $this->wowauth->Battlenet($email, $newpass);

        if ($this->wowgeneral->getExpansionAction() == 1) {
            $this->auth->where('id', $ucheck)->update('account', array(
                'sha_pass_hash' => $newpassI,
                'sessionkey' => '',
                'v' => '',
                's' => ''
            ));
        }
        else
        {
            $this->auth->where('id', $ucheck)->update('account', array(
                'sha_pass_hash' => $newpassI,
                'sessionkey' => '',
                'v' => '',
                's' => ''
            ));

            $this->auth->set('sha_pass_hash', $newpassII)->where('id', $echeck)->update('battlenet_accounts');
        }

        $mail_message = 'Hi, <span style="font-weight: bold;text-transform: uppercase;">'.$username.'</span> You have sent a request for your account password to be reset.<br>';
        $mail_message .= 'Your new password is: <span style="font-weight: bold;">'.$password_generated.'</span><br>';
        $mail_message .= 'Please change your password again as soon as you log in!<br>';
        $mail_message .= 'Kind regards,<br>';
        $mail_message .= $this->config->item('email_settings_sender_name').' Support.';

        return $this->wowgeneral->smtpSendEmail($email, $this->lang->line('email_password_recovery'), $mail_message);
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
        return $this->db->select('*')->where('key', $key)->get('pending_users')->row_array();
    }

    public function removeTempUser($key)
    {
        return $this->db->where('key', $key)->delete('pending_users');
    }

    public function activateAccount($key)
    {
        $check = $this->checkPendingUser($key);
        $temp = $this->getTempUser($key);

        if ($check == 1) {
            if ($this->wowgeneral->getExpansionAction() == 1)
            {
                $this->auth->insert('account', array(
                    'username' => $temp['username'],
                    'sha_pass_hash' => $temp['password'],
                    'email' => $temp['email'],
                    'expansion' => $temp['expansion']
                ));
            }
            else
            {
                $this->auth->insert('account', array(
                    'username' => $temp['username'],
                    'sha_pass_hash' => $temp['password'],
                    'email' => $temp['email'],
                    'expansion' => $temp['expansion'],
                    'battlenet_index' => '1'
                ));

                $id = $this->wowauth->getIDAccount($temp['username']);

                $this->auth->insert('battlenet_accounts', array(
                    'id' => $id,
                    'email' => $temp['email'],
                    'sha_pass_hash' => $temp['password_bnet']
                ));

                $this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
            }

            $id = $this->wowauth->getIDAccount($temp['username']);

            $this->db->insert('users', array(
                'id' => $id,
                'username' => $temp['username'],
                'email' => $temp['email'],
                'joindate' => $temp['joindate']
            ));

            $this->removeTempUser($key);

            $this->session->set_flashdata('account_activation','true');
            redirect(base_url('login'));
        }
        else {
            $this->session->set_flashdata('account_activation','false');
            redirect(base_url('login'));
        }
    }


    /**
     * Change UserName for website
     */

     public function changeUsername($newusername, $password)
     {
        $nobnet = $this->wowauth->Account($this->session->userdata('wow_sess_username'), $password);
        $bnet = $this->wowauth->Battlenet($this->session->userdata('wow_sess_email'), $password);

        if ($this->wowgeneral->getExpansionAction() == 1) {
            if (strtoupper($this->wowauth->getPasswordAccountID($this->session->userdata('wow_sess_id'))) != strtoupper($nobnet)) {
                return 'epassnotMatch';
            }

            $this->db->set('username', $newusername)->where('id', $this->session->userdata('wow_sess_id'))->update('users');
            return true;
        }
        else
        {
            if (strtoupper($this->wowauth->getPasswordBnetID($this->session->userdata('wow_sess_id'))) != strtoupper($bnet)) {
                return 'epassnotMatch';
            }

            $this->db->set('username', $newusername)->where('id', $this->session->userdata('wow_sess_id'))->update('users');
            return true;
        }
     }
}
