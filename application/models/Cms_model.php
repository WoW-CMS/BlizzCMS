<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_model extends CI_Model
{
    /**
     * Authentication
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authentication($username, $password)
    {
        $account  = $this->auth->connect()->where('username', $username)->or_where('email', $username)->get('account')->row();
        $emulator = config_item('emulator');

        if (empty($account)) {
            return false;
        }

        switch ($emulator) {
            case 'azeroth':
            case 'trinity':
                $validate = ($account->verifier === $this->auth->game_hash($account->username, $password, 'srp6', $account->salt));
                break;
            case 'cmangos':
                $validate = (strtoupper($account->v) === $this->auth->game_hash($account->username, $password, 'hex', $account->s));
                break;
            case 'old_trinity':
            case 'mangos':
                $validate = hash_equals(strtoupper($account->sha_pass_hash), $this->auth->game_hash($account->username, $password));
                break;
        }

        if (! isset($validate) || ! $validate) {
            return false;
        }

        $user = $this->users->find(['id' => $account->id]);
        // if account on website don't exist sync values from game account
        if (empty($user)) {
            $this->users->create([
                'id'        => $account->id,
                'nickname'  => $account->username,
                'username'  => $account->username,
                'email'     => $account->email,
                'joined_at' => date('Y-m-d H:i:s', $account->joindate)
            ]);

            $userdata = [
                'id'        => $account->id,
                'nickname'  => $account->username,
                'username'  => $account->username,
                'email'     => $account->email,
                'gmlevel'   => $this->auth->get_gmlevel($account->id),
                'logged_in' => TRUE
            ];
        }
        else {
            $userdata = [
                'id'        => $user->id,
                'nickname'  => $user->nickname,
                'username'  => $user->username,
                'email'     => $user->email,
                'gmlevel'   => $this->auth->get_gmlevel($user->id),
                'logged_in' => TRUE
            ];
        }

        $this->session->set_userdata($userdata);
        return true;    
    }

    /**
     * Check if user is logged
     *
     * @return bool
     */
    public function isLogged()
    {
        if ($this->session->userdata('id') && $this->session->logged_in) {
            return true;
        }

        return false;
    }

    /**
     * Get avatar image of specific user
     *
     * @param int|null $id
     * @return bool
     */
    public function user_avatar($id = null)
    {
        $avatar = $this->user($id, 'avatar');
        $query  = $this->avatars->find(['id' => $avatar]);

        return $query->image;
    }

    /**
     * Get user information
     *
     * @param int|null $id
     * @param string|null $column
     * @return mixed
     */
    public function user($id = null, $column = null)
    {
        $id  = $id ?? $this->session->userdata('id');
        $row = $this->users->find(['id' => $id]);

        if (empty($row)) {
            return null;
        }

        if (property_exists($row, $column)) {
            return $row->$column;
        }

        return $row;
    }

    /**
     * Get user id
     *
     * @param string $value
     * @param string $column
     * @return mixed
     */
    public function user_id($value, $column = 'username')
    {
        if (! in_array($column, ['username', 'email', 'nickname'], true)) {
            return null;
        }

        $row = $this->users->find([$column => $value]);

        if (empty($row)) {
            return null;
        }

        return $row->id;
    }

    /**
     * Send email
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param bool $debug
     * @return bool
     */
    public function send_email($to, $subject, $message, $debug = false)
    {
        $this->load->library('email');

        $this->email->initialize([
            'protocol'    => config_item('email_protocol'),
            'smtp_host'   => config_item('email_hostname'),
            'smtp_user'   => config_item('email_username'),
            'smtp_pass'   => ! empty(config_item('email_password')) ? decrypt(config_item('email_password')) : '',
            'smtp_port'   => config_item('email_port'),
            'smtp_crypto' => config_item('email_crypto'),
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        ]);

        $this->email->to($to);
        $this->email->from(config_item('email_sender'), config_item('email_sender_name'));
        $this->email->subject($subject);
        $this->email->message($message);

        if ($debug) {
            $this->email->send(false);
            return $this->email->print_debugger();
        }

        return $this->email->send();
    }
}
