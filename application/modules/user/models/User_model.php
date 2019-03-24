<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
    }

    public function changePasswordI($id, $password)
    {
        $change = array(
            'sha_pass_hash' => $password,
            'sessionkey' => '',
            'v' => '',
            's' => ''
        );

        $this->auth->where('id', $id)
                ->update('account', $change);

        redirect(base_url('logout'),'refresh');
    }

    public function changePasswordII($id, $password, $passbnet)
    {
        $change = array(
            'sha_pass_hash' => $password,
            'sessionkey' => '',
            'v' => '',
            's' => ''
        );

        $this->auth->where('id', $id)
                ->update('account', $change);

        $this->auth->set('sha_pass_hash', $passbnet)
             ->where('id', $id)
             ->update('battlenet_accounts');

        redirect(base_url('logout'),'refresh');
    }

    public function changeEmailI($id, $email)
    {
        $this->auth->set('email', $email)
             ->where('id', $id)
             ->update('account');

        $this->db->set('email', $email)
             ->where('id', $id)
             ->update('users');

        redirect(base_url('logout'),'refresh');
    }

    public function changeEmailII($id, $email, $password)
    {
        $this->auth->set('email', $email)
             ->where('id', $id)
             ->update('account');

        $this->db->set('email', $email)
             ->where('id', $id)
             ->update('users');

        $update = array(
        'sha_pass_hash' => $password,
        'email' => $email
        );

        $this->auth->where('id', $id)
             ->update('battlenet_accounts', $update);

        redirect(base_url('logout'),'refresh');
    }

    public function getExistEmail($email)
    {
        return $this->auth->select('email')
                ->where('email', $email)
                ->get('account')
                ->num_rows();
    }

    public function getAllAvatars()
    {
        return $this->db->select('*')
                ->order_by('id ASC')
                ->get('avatars');
    }

    public function insertAvatar($id)
    {
        $sessid = $this->session->userdata('fx_sess_id');

        $this->db->set('profile', $id)
             ->where('id', $sessid)
             ->update('users');

        redirect(base_url('panel'),'refresh');
    }

    public function getExistInfo()
    {
        $sessid = $this->session->userdata('fx_sess_id');

        return $this->db->select('id')
                ->where('id', $sessid)
                ->get('users');
    }

    public function updateInformation($id, $username, $email)
    {
        $this->db->where('id', $id)
             ->delete('users');

        $data = array(
            'id' => $id,
            'username' => $username,
            'email' => $email
        );

        $this->db->insert('users', $data);

        redirect(base_url('panel'),'refresh');
    }

    public function getBorn($id)
    {
        $qq = $this->db->select('year, month, day')
               ->where('id', $id)
               ->get('users');

        if ($qq->num_rows())
            return $qq->row('year').'/'.$qq->row('month').'/'.$qq->row('day');
        else
            return 'Unknow';
    }

    public function getDateMember($id)
    {
        $qq = $this->db->select('date')
               ->where('id', $id)
               ->get('users');

        if ($qq->num_rows())
            return $qq->row('date');
        else
            return 'Unknow';
    }

    public function getExpansion($id)
    {
        $qq = $this->db->select('expansion')
                ->where('id', $id)
                ->get('users');

        if ($qq->num_rows())
            return $qq->row('expansion');
        else
            return 'Unknow';
    }

    public function getLastIp($id)
    {
        return $this->auth->select('last_ip')
                ->where('id', $id)
                ->get('account')
                ->row_array()['last_ip'];
    }

    public function checklogin($username, $password)
    {
        $id = $this->m_data->getIDAccount($username);

        if ($id == "0")
            return 'uspErr';
        else
        {
            $password = $this->m_data->Account($username, $password);

            if (strtoupper($this->m_data->getPasswordAccountID($id)) == strtoupper($password))
                return $this->m_data->arraySession($id);
            else
                return 'uspErr';
        }
    }

    public function checkloginbattle($email, $password)
    {
        $id = $this->m_data->getIDEmail($email);

        if ($id == "0")
            return 'empErr';
        else
        {
            $password = $this->m_data->Battlenet($email, $password);

            if (strtoupper($this->m_data->getPasswordBnetID($id)) == strtoupper($password))
                return $this->m_data->arraySession($id);
            else
                return 'empErr';
        }
    }

    public function insertRegister($username, $email, $password, $repassword)
    {
        $date       = $this->m_data->getTimestamp();
        $expansion  = $this->m_general->getRealExpansionDB();
        $passwordAc = $this->m_data->Account($username, $password);
        $passwordBn = $this->m_data->Battlenet($email, $password);

        $checkuser = $this->m_data->getIDAccount($username);
        $checkemail = $this->m_data->getIDEmail($email);
        $pendinguser = $this->getIDPendingUsername($username);
        $pendingemail = $this->getIDPendingEmail($email);

        if($checkuser == "0" && $pendinguser == "0") {
            if($checkemail == "0" && $pendingemail == "0") {
                if(strlen($password) >= 5 && strlen($password) <= 16 || strlen($repassword) >= 5 && strlen($repassword) <= 16) {
                    if($password == $repassword)
                    {
                        if($this->config->item('account_activation_required') == TRUE)
                        {
                            $data = array(
                                'username' => $username,
                                'email' => $email,
                                'password' => $passwordAc,
                                'password_bnet' => $passwordBn,
                                'expansion' => $expansion,
                                'date' => $date,
                                'key' => sha1($username.$email.$date)
                            );

                            $this->db->insert('pending_users', $data);

                            $link = base_url().'activate/'.$data['key'];

                            $mail_message = 'Hi, You have created the account <span style="font-weight: bold;text-transform: uppercase;">'.$username.'</span> please use this link to activate your account: <a target="_blank" href="'.$link.'" class="font-weight: bold;">Activate Now</a><br>';
                            $mail_message .= 'Kind regards,<br>';
                            $mail_message .= $this->config->item('email_settings_sender_name').' Support.';

                            $this->m_general->smtpSendEmail($email, $this->lang->line('email_account_activation'), $mail_message);
                            return 'regAct';
                        }
                        else
                        {
                            if ($this->m_general->getExpansionAction($this->config->item('expansion_id')) == 1)
                            {
                                $data = array(
                                    'username' => $username,
                                    'sha_pass_hash' => $passwordAc,
                                    'email' => $email,
                                    'expansion' => $expansion,
                                );

                                $this->auth->insert('account', $data);
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

                                $id = $this->m_data->getIDAccount($username);

                                $data1 = array(
                                    'id' => $id,
                                    'email' => $email,
                                    'sha_pass_hash' => $passwordBn,
                                );

                                $this->auth->insert('battlenet_accounts', $data1);

                                $this->auth->set('battlenet_account', $id)
                                            ->where('id', $id)
                                            ->update('account');
                            }

                            $id = $this->m_data->getIDAccount($username);

                            $data3 = array(
                                'id' => $id,
                                'username' => $username,
                                'email' => $email,
                                'date' => $date
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
        return $this->auth->select('id')
                ->where('username', $username)
                ->get('account')
                ->row_array()['id'];
    }

    public function checkemailid($email)
    {
        return $this->auth->select('id')
                ->where('email', $email)
                ->get('account')
                ->row_array()['id'];
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
            $newpassI = $this->m_data->Account($username, $newpass);
            $newpassII = $this->m_data->Battlenet($email, $newpass);

            if ($this->m_general->getExpansionAction($this->config->item('expansion_id')) == 1)
            {
                $this->auth->set('sha_pass_hash', $newpassI)
                            ->where('id', $ucheck)
                            ->where('email', $email)
                            ->update('account');
            }
            else
            {
                $this->auth->set('sha_pass_hash', $newpassI)
                            ->where('id', $ucheck)
                            ->where('email', $email)
                            ->update('account');

                $this->auth->set('sha_pass_hash', $newpassII)
                            ->where('id', $ucheck)
                            ->where('email', $email)
                            ->update('battlenet_accounts');
            }

            $mail_message = 'Hi, <span style="font-weight: bold;text-transform: uppercase;">'.$username.'</span> You have sent a request for your account password to be reset.<br>';
            $mail_message .= 'Your new password is: <span style="font-weight: bold;">'.$password_generated.'</span><br>';
            $mail_message .= 'Please change your password again as soon as you log in!<br>';
            $mail_message .= 'Kind regards,<br>';
            $mail_message .= $this->config->item('email_settings_sender_name').' Support.';

            $this->m_general->smtpSendEmail($email, $this->lang->line('email_password_recovery'), $mail_message);
            return true;
        }
        else
            return 'sendErr';
    }

    public function getIDPendingUsername($account)
    {
        return $this->db->select('id')
                ->where('username', $account)
                ->get('pending_users')
                ->num_rows();
    }

    public function getIDPendingEmail($email)
    {
        return $this->db->select('id')
                ->where('email', $email)
                ->get('pending_users')
                ->num_rows();
    }

    public function checkPendingUser($key)
    {
        return $this->db->select('id')
                ->where('key', $key)
                ->get('pending_users')
                ->num_rows();
    }

    public function getTempUser($key)
    {
        return $this->db->select('*')
                ->where('key', $key)
                ->get('pending_users')
                ->row_array();
    }

    public function removeTempUser($key)
    {
        return $this->db->where('key', $key)
                ->delete('pending_users');
    }

    public function activateAccount($key)
    {

        $check = $this->checkPendingUser($key);
        $temp  = $this->getTempUser($key);

        if($check == "1") {
            if ($this->m_general->getExpansionAction($this->config->item('expansion_id')) == 1)
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

                $id = $this->m_data->getIDAccount($temp['username']);

                $data1 = array(
                    'id' => $id,
                    'email' => $temp['email'],
                    'sha_pass_hash' => $temp['password_bnet']
                );

                $this->auth->insert('battlenet_accounts', $data1);

                $this->auth->set('battlenet_account', $id)
                            ->where('id', $id)
                            ->update('account');
            }

            $id = $this->m_data->getIDAccount($temp['username']);

            $data3 = array(
                'id' => $id,
                'username' => $temp['username'],
                'email' => $temp['email'],
                'date' => $temp['date'],
                'location' => $temp['location']
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
}
