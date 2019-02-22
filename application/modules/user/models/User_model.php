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
        $this->auth->set('sha_pass_hash', $password)
             ->where('id', $id)
             ->update('account');

        redirect(base_url('logout'),'refresh');
    }

    public function changePasswordII($id, $password, $passbnet)
    {
        $this->auth->set('sha_pass_hash', $password)
             ->where('id', $id)
             ->update('account');

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

    public function updateInformation($id, $username, $email, $country)
    {
        $this->db->where('id', $id)
             ->delete('users');

        $data = array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'location' => $country,
            );

        $this->db->insert('users', $data);

        $tag = rand(1111, 9999);

        $data1 = array(
            'id' => $id,
            'tag' => $tag,
        );

        $this->db->insert('tags', $data1);

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

    public function getCountry()
    {
        return $this->db->select('*')->get('country');
    }

    public function getLocation($id)
    {
        $qq = $this->db->select('location')
               ->where('id', $id)
               ->get('users')
               ->row('location');

        return $this->db->select('country_name')
                ->where('id', $qq)
                ->get('country')
                ->row_array()['country_name'];
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

    public function insertRegister($username, $email, $password, $repassword, $country)
    {
        $date       = $this->m_data->getTimestamp();
        $expansion  = $this->m_general->getRealExpansionDB();
        $passwordAc = $this->m_data->Account($username, $password);
        $passwordBn = $this->m_data->Battlenet($email, $password);

        $checkuser = $this->m_data->getIDAccount($username);
        $checkemail = $this->m_data->getIDEmail($email);

        if($checkuser == "0") {
            if($checkemail == "0") {
                if(strlen($password) >= 5 && strlen($password) <= 16 || strlen($repassword) >= 5 && strlen($repassword) <= 16) {
                    if($password == $repassword)
                    {

                        $tag = rand(1111, 9999);
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
                            'date' => $date,
                            'location' => $country,
                        );

                        $this->db->insert('users', $data3);

                        $data4 = array(
                            'id' => $id,
                            'tag' => $tag,
                        );

                        $this->db->insert('tags', $data4);
                        return true;
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
        $this->load->library('email');

        $econf = array(
            'protocol'  => $this->config->item('smtp_protocol'),
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($econf);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

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
            $mail_message .= $this->config->item('recovery_email_name').' Support.';

            $this->email->to($email);
            $this->email->from($this->config->item('recovery_email_from'), $this->config->item('recovery_email_name'));
            $this->email->subject($this->config->item('recovery_email_subject'));
            $this->email->message($mail_message);

            $this->email->send();
            return true;
        }
        else
            return 'sendErr';
    }
}
