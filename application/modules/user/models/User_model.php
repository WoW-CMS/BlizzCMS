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
     * @param string $email
     * @return int
     */
    public function getExistEmail($email)
    {
        return $this->auth->where('email', $email)->get('account')->num_rows();
    }

    /**
     * @return [type]
     */
    public function getAllAvatars()
    {
        return $this->db->order_by('id', 'ASC')->get('avatars');
    }

    /**
     * @param mixed $avatar
     * @return [type]
     */
    public function changeAvatar($avatar)
    {
        $this->db->set('profile', $avatar)->where('id', $this->session->userdata('wow_sess_id'))->update('users');
        return true;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getDateMember($id)
    {
        $query = $this->db->where('id', $id)->get('users')->row('joindate');

        if (! empty($query)) {
            return $query;
        }

        return 'Unknown';
    }

    /**
     * @param int $id
     * @return int
     */
    public function getExpansion($id)
    {
        $query = $this->db->where('id', $id)->get('users')->row('expansion');

        if (! empty($query)) {
            return (int) $query;
        }

        return 0;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getLastIp($id)
    {
        $emulator = config_item('emulator');

        switch ($emulator) {
            case 'srp6':
                return $this->auth->where('id', $id)->get('account')->row('last_ip');

            case 'hex':
                return $this->auth->where('id', $id)->get('account_logons')->row('ip');

            case 'old-trinity':
                return $this->auth->where('id', $id)->get('account')->row('last_ip');

            default:
                return 'Unknown';
        }
    }

    /**
     * Check if user exists
     *
     * @param int $id
     * @return bool
     */
    public function find_user($id)
    {
        $query = $this->db->where('id', $id)->get('users')->num_rows();

        return ($query == 1);
    }

    /**
     * Autentica un usuario.
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authentication($username, $password)
    {
        $accgame =  $this->auth->where('username', $username)->or_where('email', $username)->get('account')->row();
        $emulator = config_item('emulator');

        if (empty($accgame)) {
            return false;
        }

        switch ($emulator) {
            case 'srp6':
                if ($this->auth->field_exists('verifier', 'account')) {
                    $validate = ($accgame->verifier === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
                } else {
                    $validate = ($accgame->v === $this->wowauth->game_hash($accgame->username, $password, 'srp6', strtoupper($accgame->s)));
                }
                break;

            case 'hex':
                $validate = (strtoupper($accgame->v) === $this->wowauth->game_hash($accgame->username, $password, 'hex', $accgame->s));
                break;

            case 'old-trinity':
                $validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->wowauth->game_hash($accgame->username, $password));
                break;

            default:
                break;
        }

        if (! isset($validate) || ! $validate) {
            return false;
        }

        // Si la cuenta no existe en el sitio web, sincronizar los valores de la cuenta del juego
        if (! $this->find_user($accgame->id)) {
            $this->db->insert('users', [
                'id'        => $accgame->id,
                'username'  => $accgame->username,
                'email'     => $accgame->email,
                'joindate'  => strtotime($accgame->joindate)
            ]);
        }

        $this->session->set_userdata([
            'wow_sess_username'   => $accgame->username,
            'blizz_sess_username' => $this->wowauth->getSiteUsernameID($accgame->id),
            'wow_sess_email'      => $accgame->email,
            'wow_sess_id'         => $accgame->id,
            'wow_sess_last_ip'    => $this->wowauth->getLastIPID($accgame->id),
            'wow_sess_last_login' => $this->wowauth->getLastLoginID($accgame->id),
            'wow_sess_gmlevel'    => $this->wowauth->getRank($accgame->id),
            'wow_sess_ban_status' => $this->wowauth->getBanStatus($accgame->id),
            'logged_in'           => TRUE
        ]);

        return true;
    }


    /**
     * Inserta un nuevo registro de usuario en la base de datos.
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $emulator
     * @return bool
     */
    public function insertRegister($username, $email, $password, $emulator)
    {
        $expansion = $this->wowgeneral->getRealExpansionDB();

        switch ($emulator) {
            case 'srp6':
                $salt = random_bytes(32);

                $data = [
                    'username'      => $username,
                    'salt'          => $salt,
                    'verifier'      => $this->wowauth->game_hash($username, $password, 'srp6', $salt),
                    'email'         => $email,
                    'expansion'     => $expansion,
                ];

                $fields = $this->auth->list_fields('account');

                if (in_array('session_key', $fields, true)) {
                    $data['session_key'] = null;
                }

                if (in_array('session_key_auth', $fields, true)) {
                    $data['session_key_auth'] = null;
                }

                if (in_array('session_key_bnet', $fields, true)) {
                    $data['session_key_bnet'] = null;
                }

                $this->auth->insert('account', $data);
                break;

            case 'hex':
                $salt = strtoupper(bin2hex(random_bytes(32)));

                $this->auth->insert('account', [
                    'username'  => $username,
                    'v'         => $this->wowauth->game_hash($username, $password, 'hex', $salt),
                    's'         => $salt,
                    'email'     => $email,
                    'expansion' => $expansion,
                ]);
                break;

            case 'old-trinity':
                $this->auth->insert('account', [
                    'username'      => $username,
                    'sha_pass_hash' => $this->wowauth->game_hash($username, $password),
                    'email'         => $email,
                    'expansion'     => $expansion,
                    'sessionkey'    => ''
                ]);
                break;
        }

        $id = $this->wowauth->getIDAccount($username);

        if (config_item('bnet_enabled')) {
            $this->auth->insert('battlenet_accounts', [
                'id'            => $id,
                'email'         => $email,
                'sha_pass_hash' => $this->wowauth->game_hash($email, $password, 'bnet')
            ]);

            $this->auth->update('account', [
                'battlenet_account' => $id,
                'battlenet_index'   => 1
            ], ['id' => $id]);
        }

        $this->db->insert('users', [
            'id'        => $id,
            'username'  => $username,
            'email'     => $email,
            'joindate'  => $this->wowgeneral->getTimestamp(),
            'dp'        => 0,
            'vp'        => 0
        ]);

        return true;
    }


    /**
     * @param string $username
     * @return mixed
     */
    public function checkuserid($username)
    {
        return $this->auth->where('username', $username)->get('account')->row('id');
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function checkemailid($email)
    {
        return $this->auth->where('email', $email)->get('account')->row('id');
    }

    /**
     * @param string $account
     * @return int
     */
    public function getIDPendingUsername($account)
    {
        return $this->db->where('username', $account)->get('pending_users')->num_rows();
    }

    /**
     * @param string $email
     * @return int
     */
    public function getIDPendingEmail($email)
    {
        return $this->db->where('email', $email)->get('pending_users')->num_rows();
    }

    /**
     * @param string $key
     * @return int
     */
    public function checkPendingUser($key)
    {
        return $this->db->where('key', $key)->get('pending_users')->num_rows();
    }

    /**
     * @param string $key
     * @return array
     */
    public function getTempUser($key)
    {
        return $this->db->where('key', $key)->get('pending_users')->row_array();
    }

    /**
     * @param string $key
     * @return [type]
     */
    public function removeTempUser($key)
    {
        return $this->db->where('key', $key)->delete('pending_users');
    }

    /**
     * @param string $key
     * @return void
     */
    public function activateAccount($key)
    {
        $check = $this->checkPendingUser($key);
        $temp = $this->getTempUser($key);

        if ($check === 1) {
            if ($this->wowgeneral->getExpansionAction() == 1) {
                $this->auth->insert('account', [
                    'username' => $temp['username'],
                    'sha_pass_hash' => $temp['password'],
                    'email' => $temp['email'],
                    'expansion' => $temp['expansion']
                ]);
            } else {
                $this->auth->insert('account', [
                    'username' => $temp['username'],
                    'sha_pass_hash' => $temp['password'],
                    'email' => $temp['email'],
                    'expansion' => $temp['expansion'],
                    'battlenet_index' => '1'
                ]);

                $id = $this->wowauth->getIDAccount($temp['username']);

                $this->auth->insert('battlenet_accounts', [
                    'id' => $id,
                    'email' => $temp['email'],
                    'sha_pass_hash' => $temp['password_bnet']
                ]);

                $this->auth->set('battlenet_account', $id)->where('id', $id)->update('account');
            }

            $id = $this->wowauth->getIDAccount($temp['username']);

            $this->db->insert('users', [
                'id' => $id,
                'username' => $temp['username'],
                'email' => $temp['email'],
                'joindate' => $temp['joindate']
            ]);

            $this->removeTempUser($key);

            $this->session->set_flashdata('account_activation', 'true');
        } else {
            $this->session->set_flashdata('account_activation', 'false');
        }

        redirect(base_url('login'));
    }


    /**
     * @param string $username
     * @param string $newusername
     * @param string $password
     * @return bool
     */
    public function changeUsername($username, $newusername, $password)
    {
        $accgame =  $this->auth->where('username', $username)->or_where('email', $username)->get('account')->row();
        $id = $this->session->userdata('wow_sess_id');
        $emulator = config_item('emulator');

        if (empty($accgame)) {
            return false;
        }

        switch ($emulator) {
            case 'srp6':
                $validate = ($accgame->verifier === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
                break;

            case 'hex':
                $validate = (strtoupper($accgame->v) === $this->wowauth->game_hash($accgame->username, $password, 'hex', strtoupper($accgame->s)));
                break;

            case 'old_trinity':
                $validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->wowauth->game_hash($accgame->username, $password));
                break;

            default:
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
     * @param string $newpass
     * @return bool
     */
    public function changePassword($newpass)
    {
        $accgame = $this->auth->where('id', $this->session->userdata('wow_sess_id'))->get('account')->row();
        $emulator = config_item('emulator');

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
     * @param string $email
     * @param string $newemail
     * @param string $password
     * @return bool
     */
    public function changeEmail($email, $newemail, $password)
    {
        $accgame =  $this->auth->where('email', $email)->get('account')->row();
        $id = $this->session->userdata('wow_sess_id');
        $emulator = config_item('emulator');

        if (empty($accgame)) {
            return false;
        }

        switch ($emulator) {
            case 'srp6':
                $validate = ($accgame->verifier === $this->wowauth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
                break;

            case 'hex':
                $validate = (strtoupper($accgame->v) === $this->wowauth->game_hash($accgame->username, $password, 'hex', strtoupper($accgame->s)));
                break;

            case 'old_trinity':
                $validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->wowauth->game_hash($accgame->username, $password));
                break;

            default:
                break;
        }

        if (! isset($validate) || ! $validate) {
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
     * @param string $username
     * @param string $email
     * @return bool|string
     */
    public function sendpassword($username, $email)
    {
        $ucheck = $this->checkuserid($username);
        $echeck = $this->checkemailid($email);

        if ($ucheck == $echeck) {
            $new_password = $this->generateRandomPassword();

            $this->generateHash(config_item('emulator'), $username, $new_password);

            $mail_message = 'Hi, <span style="font-weight: bold;text-transform: uppercase;">' . $username . '</span> You have sent a request for your account password to be reset.<br>';
            $mail_message .= 'Your new password is: <span style="font-weight: bold;">' . $new_password . '</span><br>';
            $mail_message .= 'Please change your password again as soon as you log in!<br>';
            $mail_message .= 'Kind regards,<br>';
            $mail_message .= $this->config->item('email_settings_sender_name') . ' Support.';

            $this->wowgeneral->smtpSendEmail($email, $this->lang->line('email_password_recovery'), $mail_message);

            return true;
        } else {
            return 'sendErr';
        }

        return 'sendErr';
    }

    /**
     * Genera una contraseña aleatoria.
     * 
     * @return string
     */
    private function generateRandomPassword()
    {
        $allowed_chars = "0123456789abcdefghijklmnopqrstuvwxyz";
        return substr(str_shuffle($allowed_chars), 0, 14);
    }

    /**
     * Genera y actualiza el hash de contraseña según el emulador.
     * 
     * @param string $emulator
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function generateHash($emulator, $username, $password)
    {
        if ($emulator == 'srp6') {
            $salt = random_bytes(32);
            $data = [
                'salt'     => $salt,
                'verifier' => $this->wowauth->game_hash($username, $password, 'srp6', $salt)
            ];
        } elseif ($emulator == 'hex') {
            $salt = strtoupper(bin2hex(random_bytes(32)));
            $data = [
                'v' => $this->wowauth->game_hash($username, $password, 'hex', $salt),
                's' => $salt
            ];
        } elseif ($emulator == 'old-trinity') {
            $data = [
                'sha_pass_hash' => $this->wowauth->game_hash($username, $password)
            ];
        } else {
            return false; // Emulador no válido
        }

        $this->auth->where('username', $username)->update('account', $data);
        return true;
    }
}
