<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('throttle_model');
    }

    public function login()
    {
        require_guest();

        $this->template->title(lang('login'), config_item('app_name'));

        $this->template->set_meta_tags([
            'robots' => 'noindex, follow',
            'title'  => lang('login')
        ]);

        $this->form_validation->set_rules('username', lang('username'), 'trim|required');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('remember', lang('remember'), 'trim|valid_boolean');

        if (config_item('captcha_login_page')) {
            $this->set_captcha_rule();
        }

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $ip            = $this->input->ip_address();
            $find          = $this->throttle_model->find(['ip' => $ip]);
            $maxAttempts   = config_item('login_max_attempts') ?? 3;
            $resetInterval = config_item('login_reset_interval') ?? '1H';
            $attempts      = 0;

            if (empty($find)) {
                $this->throttle_model->insert([
                    'ip'       => $ip,
                    'reset_at' => add_timespan('now', 'PT' . $resetInterval)
                ]);
            } else {
                $countdown = $find->unlock_at !== null ? remaining_minutes('now', $find->unlock_at) : 0;

                if ($countdown < 0) {
                    $this->throttle_model->set([
                        'attempts'  => 0,
                        'reset_at'  => add_timespan('now', 'PT' . $resetInterval),
                        'unlock_at' => null
                    ], ['ip' => $ip]);
                } else {
                    if (remaining_minutes('now', $find->reset_at) < 0 && (int) $find->attempts < $maxAttempts) {
                        $this->throttle_model->set([
                            'attempts' => 0,
                            'reset_at' => add_timespan('now', 'PT' . $resetInterval)
                        ], ['ip' => $ip]);
                    } else {
                        $attempts += (int) $find->attempts;
                    }
                }

                if ($attempts >= $maxAttempts) {
                    $this->session->set_flashdata('error', lang_vars('alert_login_attempts_exhausted', [$countdown]));
                    redirect(site_url('login'));
                }
            }

            $username = $this->input->post('username', true);
            $auth     = $this->auth_model->authenticate(
                $username,
                $this->input->post('password'),
                $this->input->post('remember')
            );

            if ($auth['status'] === 'success') {
                $this->throttle_model->delete(['ip' => $ip]);

                redirect(site_url('user'));
            }

            if ($auth['status'] === 'banned') {
                $this->session->set_flashdata('error', lang('alert_account_permanently_banned'));
                redirect(site_url('login'));
            }

            $attempts++;

            $set = [
                'attempts' => $attempts
            ];

            if ($attempts === $maxAttempts) {
                $lockoutInterval = config_item('login_lockout_interval') ?? '15M';

                $set['unlock_at'] = add_timespan('now', 'PT' . $lockoutInterval);
            }

            $this->throttle_model->set($set, ['ip' => $ip]);

            $this->session->set_flashdata('warning', lang_vars('alert_login_failed', [$attempts, $maxAttempts]));
            redirect(site_url('login'));
        } else {
            $this->template->build('auth/login');
        }
    }

    public function logout()
    {
        if (! is_logged_in()) {
            show_404();
        }

        if (get_cookie('remember', true) !== null) {
            $this->user_token_model->delete([
                'user_id' => $this->session->userdata('id'),
                'type'    => User_token_model::TOKEN_REMEMBER
            ]);

            delete_cookie('remember');
        }

        $this->log_model->create('user', 'logout', 'Logout');

        session_destroy();

        redirect(site_url('login'));
    }

    public function register()
    {
        require_guest();

        if (! config_item('show_register_page')) {
            show_404();
        }

        $this->template->title(lang('register'), config_item('app_name'));

        $this->template->set_meta_tags([
            'robots' => 'noindex, follow',
            'title'  => lang('register')
        ]);

        $this->form_validation->set_rules('nickname', lang('nickname'), 'trim|required|alpha_dash|max_length[15]|is_user_field_unique[nickname]');
        $this->form_validation->set_rules('username', lang('username'), 'trim|required|alpha_numeric|min_length[4]|max_length[15]|differs[nickname]|is_user_field_unique[username]');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|is_user_field_unique[email]');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'trim|required|min_length[8]|matches[password]');
        $this->form_validation->set_rules('terms', lang('terms_and_conditions'), 'trim|required');

        if (config_item('captcha_register_page')) {
            $this->set_captcha_rule();
        }

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $nickname = $this->input->post('nickname');
            $username = $this->input->post('username');
            $email    = $this->input->post('email', true);
            $password = $this->input->post('password');

            if ($this->ban_model->is_email_banned($email)) {
                $this->session->set_flashdata('error', lang('alert_email_blocked'));
                redirect(site_url('register'));
            }

            if (config_item('mailer_account_confirmation')) {
                $token = $this->user_token_model->create_token(
                    0, 
                    User_token_model::TOKEN_CONFIRMATION,
                    'PT12H',
                    [
                        'nickname' => $nickname,
                        'username' => $username,
                        'email'    => $email,
                        'password' => encrypt($password)
                    ]
                );

                $html  = $this->template->load_view('email/template', [
                    'message' => lang('email_account_confirmation'),
                    'link'    => site_url('confirm-register/' . $token),
                    'note'    => lang('email_note_time_limit')
                ]);

                $this->auth_model->send_email($email, lang('account_confirmation'), $html);

                $this->session->set_flashdata('success', lang('alert_registration_pending'));
                redirect(site_url('register'));
            }

            $id = $this->server_auth_model->create_account($username, $email, $password);

            $this->user_model->insert([
                'id'       => $id,
                'nickname' => $nickname,
                'username' => $username,
                'email'    => $email,
                'password' => $password,
                'role'     => Role_model::ROLE_USER,
                'language' => $this->multilanguage->current_language()
            ]);

            $this->cache->delete('users_avatars');

            $this->session->set_flashdata('success', lang('alert_registration_success'));
            redirect(site_url('login'));
        } else {
            $this->template->build('auth/register');
        }
    }

    /**
     * Confirm register
     *
     * @param string $token
     * @return void
     */
    public function confirm_register($token = null)
    {
        require_guest();

        $result = $this->user_token_model->verify_token($token, User_token_model::TOKEN_CONFIRMATION);

        if (! $result) {
            $this->session->set_flashdata('error', lang('alert_token_invalid'));
            redirect(site_url('login'));
        }

        $emulator = config_item('app_emulator');
        $user     = json_decode($result->data);
        $password = decrypt($user->password);

        $id = $this->server_auth_model->create_account($user->username, $user->email, $password);

        $this->user_model->insert([
            'id'       => $id,
            'nickname' => $user->nickname,
            'username' => $user->username,
            'email'    => $user->email,
            'password' => $password,
            'role'     => Role_model::ROLE_USER,
            'language' => $this->multilanguage->current_language()
        ]);

        $this->user_token_model->delete(['hash' => $result->hash, 'type' => User_token_model::TOKEN_CONFIRMATION]);

        $this->cache->delete('users_avatars');

        $this->session->set_flashdata('success', lang('alert_registration_validated'));
        redirect(site_url('login'));
    }

    public function forgot_password()
    {
        require_guest();

        if (! config_item('show_forgot_page')) {
            show_404();
        }

        $this->template->title(lang('forgot_password'), config_item('app_name'));

        $this->template->set_meta_tags([
            'robots' => 'noindex, follow',
            'title'  => lang('forgot_password')
        ]);

        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email');

        if (config_item('captcha_forgot_page')) {
            $this->set_captcha_rule();
        }

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $email = $this->input->post('email', true);
            $id    = $this->server_auth_model->account_id($email, 'email');

            if (! empty($id)) {
                $token = $this->user_token_model->create_token($id, User_token_model::TOKEN_PASSWORD, 'PT12H');

                $html  = $this->template->load_view('email/template', [
                    'message' => lang('email_reset_password'),
                    'link'    => site_url('reset-password?token=' . $token),
                    'note'    => lang('email_note_time_limit')
                ]);

                $this->auth_model->send_email($email, lang('reset_password'), $html);
            }

            $this->session->set_flashdata('success', lang('alert_forgot_success'));
            redirect(site_url('forgot-password'));
        } else {
            $this->template->build('auth/forgot_password');
        }
    }

    /**
     * Reset Password
     *
     * @return void
     */
    public function reset_password()
    {
        require_guest();

        $data = [
            'token' => $this->input->get('token')
        ];

        $this->template->title(lang('reset_password'), config_item('app_name'));

        $this->template->set_meta_tags([
            'robots' => 'noindex, nofollow',
            'title'  => lang('reset_password')
        ]);

        $this->form_validation->set_rules('token', lang('token'), 'trim|required');
        $this->form_validation->set_rules('new_password', lang('new_password'), 'trim|required|min_length[8]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $newPassword = $this->input->post('new_password');
            $result      = $this->user_token_model->verify_token($this->input->post('token', true), User_token_model::TOKEN_PASSWORD);

            if (! $result) {
                $this->session->set_flashdata('error', lang('alert_token_invalid'));
                redirect(site_url('reset-password'));
            }

            $emulator = config_item('app_emulator');
            $auth     = $this->server_auth_model->connect();
            $account  = $this->server_auth_model->account($result->user_id);

            switch ($emulator) {
                case 'azeroth':
                    $salt = random_bytes(32);
                    $setUser = [
                        'salt'        => $salt,
                        'verifier'    => client_pwd_hash($account->username, $newPassword, 'srp6', $salt),
                        'session_key' => null
                    ];
                    break;

                case 'trinity':
                    $salt = random_bytes(32);
                    $setUser = [
                        'salt'             => $salt,
                        'verifier'         => client_pwd_hash($account->username, $newPassword, 'srp6', $salt),
                        'session_key_auth' => null,
                        'session_key_bnet' => null
                    ];
                    break;

                case 'cmangos':
                    $salt = strtoupper(bin2hex(random_bytes(32)));
                    $setUser = [
                        'sessionkey' => '',
                        'v'          => client_pwd_hash($account->username, $newPassword, 'hex', $salt),
                        's'          => $salt
                    ];
                    break;

                case 'mangos':
                case 'trinity_sha':
                    $setUser = [
                        'sha_pass_hash' => client_pwd_hash($account->username, $newPassword),
                        'sessionkey'    => '',
                        'v'             => '',
                        's'             => ''
                    ];
                    break;
            }

            $auth->update('account', $setUser, ['id' => $result->user_id]);

            // Update the BNET account if BNET is enabled and the table exists
            if (config_item('app_emulator_bnet') && $auth->table_exists('battlenet_accounts')) {
                $auth->update('battlenet_accounts', [
                    'sha_pass_hash' => client_pwd_hash($account->email, $newPassword, 'bnet')
                ], ['id' => $result->user_id]);
            }

            $this->user_model->update(['password' => $newPassword], ['id' => $result->user_id]);

            $this->user_token_model->delete(['user_id' => $result->user_id, 'type' => User_token_model::TOKEN_PASSWORD]);

            $this->session->set_flashdata('success', lang('alert_reset_password'));
            redirect(site_url('login'));
        } else {
            $this->template->build('auth/reset_password', $data);
        }
    }
}
