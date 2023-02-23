<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check user authentication
     *
     * @param string $username
     * @param string $password
     * @param mixed $remember
     * @return array
     */
    public function authenticate($username, $password, $remember)
    {
        $user = $this->user_model->find_user($username);

        if (empty($user)) {
            $this->log_model->create('user', 'login', 'Login attempt', [
                'username' => $username
            ], '', Log_model::STATUS_FAILED);

            return ['status' => 'error'];
        }

        if ($user->password === '') {
            if (! $this->server_auth_model->password_verify($password, $user->id)) {
                $this->log_model->create('user', 'login', 'Login', [], '', Log_model::STATUS_FAILED, $user->id);

                return ['status' => 'error'];
            }

            $this->user_model->update(['password' => $password], ['id' => $user->id]);
        } else {
            if (! password_verify($password, $user->password)) {
                $this->log_model->create('user', 'login', 'Login', [], '', Log_model::STATUS_FAILED, $user->id);

                return ['status' => 'error'];
            }

            if (password_needs_rehash($user->password, PASSWORD_ARGON2ID, [
                'memory_cost' => 64<<10,
                'time_cost'   => 4,
                'threads'     => 1
            ])) {
                $this->user_model->update(['password' => $password], ['id' => $user->id]);
            }

            if ($this->ban_model->is_user_banned($user->id, true)) {
                return ['status' => 'banned'];
            }
        }

        $this->session->set_userdata([
            'id'        => $user->id,
            'nickname'  => $user->nickname,
            'email'     => $user->email,
            'language'  => $user->language,
            'logged_in' => true
        ]);

        if (filter_var($remember, FILTER_VALIDATE_BOOLEAN)) {
            $token = $this->user_token_model->create_token($user->id, User_token_model::TOKEN_REMEMBER, 'P7D');

            set_cookie(
                'remember',
                $token,
                3600 * 24 * 7,
                config_item('cookie_domain'),
                config_item('cookie_path'),
                config_item('cookie_prefix'),
                false,
                true
            );
        }

        $this->log_model->create('user', 'login', 'Login');

        return ['status' => 'success'];
    }

    /**
     * Check if the user has logged in
     *
     * @return bool
     */
    public function is_logged_in()
    {
        if ($this->session->userdata('id') && $this->session->logged_in) {
            return true;
        }

        return false;
    }

    /**
     * Restore user session
     *
     * @return bool
     */
    public function restore_session()
    {
        if ($this->is_logged_in()) {
            return false;
        }

        $token = get_cookie('remember', true);

        if (empty($token)) {
            return false;
        }

        $result = $this->user_token_model->verify_token($token, User_token_model::TOKEN_REMEMBER);

        if (! $result) {
            return false;
        }

        $user = $this->user_model->user(null, $result->user_id);

        if (empty($user)) {
            return false;
        }

        // Generate new token
        $newToken = $this->user_token_model->refresh_token($result->chooser, User_token_model::TOKEN_REMEMBER);

        if (! $newToken) {
            return false;
        }

        set_cookie(
            'remember',
            $newToken,
            3600 * 24 * 7,
            config_item('cookie_domain'),
            config_item('cookie_path'),
            config_item('cookie_prefix'),
            false,
            true
        );

        $this->session->set_userdata([
            'id'        => $user->id,
            'nickname'  => $user->nickname,
            'email'     => $user->email,
            'language'  => $user->language,
            'logged_in' => true
        ]);

        return true;
    }

    /**
     * Send email
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string|null $type
     * @param bool $debug
     * @return bool
     */
    public function send_email($to, $subject, $message, $type = null, $debug = false)
    {
        $this->load->library('email', [
            'protocol'    => config_item('mailer_protocol'),
            'smtp_host'   => config_item('mailer_hostname'),
            'smtp_user'   => config_item('mailer_username'),
            'smtp_pass'   => decrypt(config_item('mailer_password')),
            'smtp_port'   => config_item('mailer_port'),
            'smtp_crypto' => config_item('mailer_encryption'),
            'mailtype'    => $type ?? 'html'
        ]);

        $this->email->from(config_item('mailer_from_email'), config_item('mailer_from_name'));
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($debug) {
            $this->email->send(false);
            return $this->email->print_debugger();
        }

        return $this->email->send();
    }
}
