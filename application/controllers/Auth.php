<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'users_tokens_model' => 'users_tokens'
        ]);

        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function login()
    {
        if ($this->website->isLogged())
        {
            redirect(site_url('user'));
        }

        $this->template->title(config_item('app_name'), lang('login'));

        if (config_item('captcha_login') === 'true')
        {
            $captcha_link = (config_item('captcha_type') === 'hcaptcha') ? 'https://hcaptcha.com/1/api.js' : 'https://www.google.com/recaptcha/api.js';
            $this->template->add_js($captcha_link, 'async defer', 'head');
        }

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('username', 'Username/Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if (config_item('captcha_login') === 'true')
            {
                $captcha_rule = (config_item('captcha_type') === 'hcaptcha') ? 'h-captcha-response' : 'g-recaptcha-response';
                $this->form_validation->set_rules($captcha_rule, 'Captcha', 'trim|required|validate_captcha');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('auth/login');
            }
            else
            {
                $response = $this->website->authentication(
                    $this->input->post('username', TRUE),
                    $this->input->post('password')
                );

                if (! $response)
                {
                    $this->session->set_flashdata('error', lang('login_error'));
                    $this->template->build('auth/login');
                }
                else
                {
                    redirect(site_url('user'));
                }
            }
        }
        else
        {
            $this->template->build('auth/login');
        }
    }

    public function logout()
    {
        if (! $this->website->isLogged())
        {
            show_404();
        }

        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function register()
    {
        if ($this->website->isLogged())
        {
            redirect(site_url('user'));
        }

        $this->template->title(config_item('app_name'), lang('register'));

        if (config_item('captcha_register') === 'true')
        {
            $captcha_link = (config_item('captcha_type') === 'hcaptcha') ? 'https://hcaptcha.com/1/api.js' : 'https://www.google.com/recaptcha/api.js';
            $this->template->add_js($captcha_link, 'async defer', 'head');
        }

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('nickname', 'Nickname', 'trim|required|alpha_numeric|max_length[16]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[3]|max_length[16]|differs[nickname]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[8]|matches[password]');
            $this->form_validation->set_rules('terms', 'Terms and conditions', 'trim|required');

            if (config_item('captcha_register') === 'true')
            {
                $captcha_rule = (config_item('captcha_type') === 'hcaptcha') ? 'h-captcha-response' : 'g-recaptcha-response';
                $this->form_validation->set_rules($captcha_rule, 'Captcha', 'trim|required|validate_captcha');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('auth/register');
            }
            else
            {
                $nickname   = $this->input->post('nickname', TRUE);
                $username   = $this->input->post('username', TRUE);
                $email      = $this->input->post('email', TRUE);
                $password   = $this->input->post('password');

                $emulator   = config_item('emulator');

                if (! $this->auth->account_unique($username, 'username'))
                {
                    $this->session->set_flashdata('error', lang('username_already'));
                    redirect(site_url('register'));
                }

                if (! $this->auth->account_unique($email, 'email'))
                {
                    $this->session->set_flashdata('error', lang('email_already'));
                    redirect(site_url('register'));
                }

                if ($this->users_tokens->pending_account($username, $email))
                {
                    $this->session->set_flashdata('warning', lang('account_pending'));
                    redirect(site_url('register'));
                }

                if (config_item('register_validation') === 'true')
                {
                    $token = $this->users_tokens->create(0, TOKEN_VALIDATION, 'PT12H', json_encode([
                        'nickname' => $nickname,
                        'username' => $username,
                        'email' => $email
                    ]));

                    $html  = $this->load->view('email/account', [
                        'message' => lang('message_validate'),
                        'link'    => site_url('validate/' . $token),
                        'note'    => lang('note_time_limit')
                    ], TRUE);

                    $this->website->send_email($email, lang('subject_validate'), $html);

                    $this->session->set_flashdata('success', lang('register_pending'));
                    redirect(site_url('register'));
                }
                else
                {
                    if (in_array($emulator, ['azeroth', 'trinity'], true))
                    {
                        $salt = random_bytes(32);

                        $this->auth->connect()->insert('account', [
                            'username'  => $username,
                            'salt'      => $salt,
                            'verifier'  => $this->auth->game_hash($username, $password, 'srp6', $salt),
                            'email'     => $email,
                            'expansion' => config_item('expansion')
                        ]);
                    }
                    elseif (in_array($emulator, ['cmangos'], true))
                    {
                        $salt = strtoupper(bin2hex(random_bytes(32)));

                        $this->auth->connect()->insert('account', [
                            'username'  => $username,
                            'v'         => $this->auth->game_hash($username, $password, 'hex', $salt),
                            's'         => $salt,
                            'email'     => $email,
                            'expansion' => config_item('expansion')
                        ]);
                    }
                    elseif (in_array($emulator, ['mangos', 'old_trinity'], true))
                    {
                        $this->auth->connect()->insert('account', [
                            'username'        => $username,
                            'sha_pass_hash'   => $this->auth->game_hash($username, $password),
                            'email'           => $email,
                            'expansion'       => config_item('expansion')
                        ]);
                    }

                    $id = $this->auth->account_id($username);

                    // Insert/update account if emulator support bnet
                    if (config_item('emulator_bnet') === 'true')
                    {
                        $this->auth->connect()->insert('battlenet_accounts', [
                            'id'            => $id,
                            'email'         => $email,
                            'sha_pass_hash' => $this->auth->game_hash($email, $password, 'bnet')
                        ]);

                        $this->auth->connect()->where('id', $id)->update('account', [
                            'battlenet_account' => $id,
                            'battlenet_index'   => 1
                        ]);
                    }

                    // Add user to website db
                    $this->users->create([
                        'id'        => $id,
                        'nickname'  => $nickname,
                        'username'  => $username,
                        'email'     => $email,
                        'joined_at' => current_date()
                    ]);

                    $this->session->set_flashdata('success', lang('register_success'));
                    redirect(site_url('login'));
                }
            }
        }
        else
        {
            $this->template->build('auth/register');
        }
    }

    public function forgot()
    {
        if ($this->website->isLogged())
        {
            redirect(site_url('user'));
        }

        $this->template->title(config_item('app_name'), lang('forgot_password'));

        if (config_item('captcha_forgot') === 'true')
        {
            $captcha_link = (config_item('captcha_type') === 'hcaptcha') ? 'https://hcaptcha.com/1/api.js' : 'https://www.google.com/recaptcha/api.js';
            $this->template->add_js($captcha_link, 'async defer', 'head');
        }

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if (config_item('captcha_forgot') === 'true')
            {
                $captcha_rule = (config_item('captcha_type') === 'hcaptcha') ? 'h-captcha-response' : 'g-recaptcha-response';
                $this->form_validation->set_rules($captcha_rule, 'Captcha', 'trim|required|validate_captcha');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('auth/forgot');
            }
            else
            {
                $email = $this->input->post('email', TRUE);
                $id    = $this->auth->account_id($email, 'email');

                if (! empty($id))
                {
                    $token = $this->users_tokens->create($id, TOKEN_PASSWORD, 'PT12H');

                    $html  = $this->load->view('email/account', [
                        'message' => lang('message_reset'),
                        'link'    => site_url('reset/' . $token),
                        'note'    => lang('note_time_limit')
                    ], TRUE);

                    $this->website->send_email($email, lang('subject_reset'), $html);
                }

                $this->session->set_flashdata('success', lang('forgot_success'));
                redirect(site_url('forgot'));
            }
        }
        else
        {
            $this->template->build('auth/forgot');
        }
    }

    /**
     * Validate registration
     *
     * @param string $token
     * @return void
     */
    public function register_validate($token = null)
    {
        if (empty($token) || $this->website->isLogged())
        {
            show_404();
        }

        $result = $this->users_tokens->validate($token, TOKEN_VALIDATION);

        if (! $result)
        {
            $this->session->set_flashdata('error', lang('invalid_token'));
            redirect(site_url('login'));
        }

        $this->template->title(config_item('app_name'), lang('login'));

        $data = [
            'user' => json_decode($result->data)
        ];

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[8]|matches[password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('auth/validate', $data);
            }
            else
            {
                $password = $this->input->post('password');
                $emulator = config_item('emulator');

                if (in_array($emulator, ['azeroth', 'trinity'], true))
                {
                    $salt = random_bytes(32);

                    $this->auth->connect()->insert('account', [
                        'username'  => $data['user']->username,
                        'salt'      => $salt,
                        'verifier'  => $this->auth->game_hash($data['user']->username, $password, 'srp6', $salt),
                        'email'     => $data['user']->email,
                        'expansion' => config_item('expansion')
                    ]);
                }
                elseif (in_array($emulator, ['cmangos'], true))
                {
                    $salt = strtoupper(bin2hex(random_bytes(32)));

                    $this->auth->connect()->insert('account', [
                        'username'  => $data['user']->username,
                        'v'         => $this->auth->game_hash($data['user']->username, $password, 'hex', $salt),
                        's'         => $salt,
                        'email'     => $data['user']->email,
                        'expansion' => config_item('expansion')
                    ]);
                }
                elseif (in_array($emulator, ['mangos', 'old_trinity'], true))
                {
                    $this->auth->connect()->insert('account', [
                        'username'      => $data['user']->username,
                        'sha_pass_hash' => $this->auth->game_hash($data['user']->username, $password),
                        'email'         => $data['user']->email,
                        'expansion'     => config_item('expansion')
                    ]);
                }

                $id = $this->auth->connect()->insert_id();

                // Insert/update account if emulator support bnet
                if (config_item('emulator_bnet') === 'true')
                {
                    $this->auth->connect()->insert('battlenet_accounts', [
                        'id'            => $id,
                        'email'         => $data['user']->email,
                        'sha_pass_hash' => $this->auth->game_hash($data['user']->email, $password, 'bnet')
                    ]);

                    $this->auth->connect()->where('id', $id)->update('account', [
                        'battlenet_account' => $id,
                        'battlenet_index'   => 1
                    ]);
                }

                // Add user to website db
                $this->users->create([
                    'id'        => $id,
                    'nickname'  => $data['user']->nickname,
                    'username'  => $data['user']->username,
                    'email'     => $data['user']->email,
                    'joined_at' => current_date()
                ]);

                $this->db->where(['hash' => $result->hash, 'type' => TOKEN_VALIDATION])->delete('users_tokens');

                $this->session->set_flashdata('success', lang('validate_success'));
                redirect(site_url('login'));
            }
        }
        else
        {
            $this->template->build('auth/validate', $data);
        }
    }

    /**
     * Reset password
     *
     * @param string $token
     * @return void
     */
    public function reset_password($token = null)
    {
        if (empty($token) || $this->website->isLogged())
        {
            show_404();
        }

        $result = $this->users_tokens->validate($token, TOKEN_PASSWORD);

        if (! $result)
        {
            $this->session->set_flashdata('error', lang('invalid_token'));
            redirect(site_url('login'));
        }

        $this->template->title(config_item('app_name'), lang('login'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('new_password', 'New password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('confirm_new_password', 'Confirm new password', 'trim|required|min_length[8]|matches[new_password]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('auth/reset');
            }
            else
            {
                $password = $this->input->post('new_password');
                $account  = $this->auth->get_account($result->user_id);
                $emulator = config_item('emulator');

                if (in_array($emulator, ['azeroth', 'trinity'], true))
                {
                    $salt = random_bytes(32);

                    $this->auth->connect()->where('id', $result->user_id)->update('account', [
                        'salt'     => $salt,
                        'verifier' => $this->auth->game_hash($account->username, $password, 'srp6', $salt)
                    ]);
                }
                elseif (in_array($emulator, ['cmangos'], true))
                {
                    $salt = strtoupper(bin2hex(random_bytes(32)));

                    $this->auth->connect()->where('id', $result->user_id)->update('account', [
                        'sessionkey' => '',
                        'v'          => $this->auth->game_hash($account->username, $password, 'hex', $salt),
                        's'          => $salt
                    ]);
                }
                elseif (in_array($emulator, ['mangos', 'old_trinity'], true))
                {
                    $this->auth->connect()->where('id', $result->user_id)->update('account', [
                        'sha_pass_hash' => $this->auth->game_hash($account->username, $password),
                        'sessionkey'    => '',
                        'v'             => '',
                        's'             => ''
                    ]);
                }

                // If emulator support bnet update password on table
                if (config_item('emulator_bnet') === 'true')
                {
                    $bnet = $this->auth->game_hash($account->email, $password, 'bnet');

                    $this->auth->connect()->set('sha_pass_hash', $bnet)->where('id', $result->user_id)->update('battlenet_accounts');
                }

                $this->db->where(['user_id' => $result->user_id, 'type' => TOKEN_PASSWORD])->delete('users_tokens');

                $this->session->set_flashdata('success', lang('reset_success'));
                redirect(site_url('login'));
            }
        }
        else
        {
            $this->template->build('auth/reset');
        }
    }
}