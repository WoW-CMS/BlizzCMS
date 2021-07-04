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

class System extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->language('admin');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('system/index');
    }

    public function general()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', lang('name'), 'trim|required|min_length[3]');
            $this->form_validation->set_rules('realmlist', lang('realmlist'), 'trim');
            $this->form_validation->set_rules('theme', lang('theme'), 'trim');
            $this->form_validation->set_rules('expansion', lang('expansion'), 'trim|required|is_natural');
            $this->form_validation->set_rules('emulator', lang('emulator'), 'trim|required|alpha_dash');
            $this->form_validation->set_rules('bnet', lang('bnet_account'), 'trim|required|in_list[true,false]');
            $this->form_validation->set_rules('discord', lang('discord_server'), 'trim|alpha_dash');
            $this->form_validation->set_rules('facebook', lang('facebook_url'), 'trim|valid_url');
            $this->form_validation->set_rules('twitter', lang('twitter_url'), 'trim|valid_url');
            $this->form_validation->set_rules('youtube', lang('youtube_url'), 'trim|valid_url');

            $this->form_validation->set_rules('admin_access', 'Admin access', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('mod_access', 'Mod access', 'trim|required|is_natural_no_zero');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('system/general');
            }
            else
            {
                $this->settings->update_batch([
                    [
                        'key' => 'app_name',
                        'value' => $this->input->post('name', TRUE)
                    ],
                    [
                        'key' => 'realmlist',
                        'value' => $this->input->post('realmlist', TRUE)
                    ],
                    [
                        'key' => 'app_theme',
                        'value' => $this->input->post('theme', TRUE)
                    ],
                    [
                        'key' => 'expansion',
                        'value' => $this->input->post('expansion')
                    ],
                    [
                        'key' => 'emulator',
                        'value' => $this->input->post('emulator', TRUE)
                    ],
                    [
                        'key' => 'emulator_bnet',
                        'value' => $this->input->post('bnet')
                    ],
                    [
                        'key' => 'discord_server_id',
                        'value' => $this->input->post('discord', TRUE)
                    ],
                    [
                        'key' => 'facebook_url',
                        'value' => $this->input->post('facebook', TRUE)
                    ],
                    [
                        'key' => 'twitter_url',
                        'value' => $this->input->post('twitter', TRUE)
                    ],
                    [
                        'key' => 'youtube_url',
                        'value' => $this->input->post('youtube', TRUE)
                    ],
                    [
                        'key' => 'admin_access_level',
                        'value' => $this->input->post('admin_access', TRUE)
                    ],
                    [
                        'key' => 'mod_access_level',
                        'value' => $this->input->post('mod_access', TRUE)
                    ]
                ], 'key');

                // Clear cache
                $this->cache->file->delete('settings');

                $this->session->set_flashdata('success', lang('settings_updated'));
                redirect(site_url('admin/system/general'));
            }
        }
        else
        {
            $this->template->build('system/general');
        }
    }

    public function captcha()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('captcha_register', 'Captcha Register', 'trim');
            $this->form_validation->set_rules('captcha_login', 'Captcha Login', 'trim');
            $this->form_validation->set_rules('captcha_forgot', 'Captcha Forgot', 'trim');
            $this->form_validation->set_rules('captcha_type', lang('type'), 'trim|in_list[hcaptcha,recaptcha]');
            $this->form_validation->set_rules('captcha_theme', lang('theme'), 'trim|in_list[light,dark]');
            $this->form_validation->set_rules('captcha_public', lang('public_key'), 'trim|alpha_dash');
            $this->form_validation->set_rules('captcha_private', lang('private_key'), 'trim|alpha_dash');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('system/captcha');
            }
            else
            {
                $this->settings->update_batch([
                    [
                        'key'   => 'captcha_register',
                        'value' => ($this->input->post('captcha_register', TRUE) != 'true') ? 'false' : 'true'
                    ],
                    [
                        'key'   => 'captcha_login',
                        'value' => ($this->input->post('captcha_login', TRUE) != 'true') ? 'false' : 'true'
                    ],
                    [
                        'key'   => 'captcha_forgot',
                        'value' => ($this->input->post('captcha_forgot', TRUE) != 'true') ? 'false' : 'true'
                    ],
                    [
                        'key'   => 'captcha_type',
                        'value' => $this->input->post('captcha_type')
                    ],
                    [
                        'key'   => 'captcha_theme',
                        'value' => $this->input->post('captcha_theme')
                    ],
                    [
                        'key'   => 'captcha_public',
                        'value' => $this->input->post('captcha_public')
                    ],
                    [
                        'key'   => 'captcha_private',
                        'value' => $this->input->post('captcha_private')
                    ]
                ], 'key');

                // Clear cache
                $this->cache->file->delete('settings');

                $this->session->set_flashdata('success', lang('settings_updated'));
                redirect(site_url('admin/system/captcha'));
            }
        }
        else
        {
            $this->template->build('system/captcha');
        }
    }

    public function mail()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('validation', 'Validation', 'trim');
            $this->form_validation->set_rules('mailer', lang('mailer'), 'trim|in_list[mail,sendmail,smtp]');
            $this->form_validation->set_rules('hostname', lang('hostname'), 'trim');
            $this->form_validation->set_rules('username', lang('username'), 'trim');
            $this->form_validation->set_rules('password', lang('password'), 'trim');
            $this->form_validation->set_rules('port', lang('port'), 'trim|numeric|less_than_equal_to[65535]');
            $this->form_validation->set_rules('encryption', lang('encryption'), 'trim|in_list[tls,ssl]');
            $this->form_validation->set_rules('sender', lang('sender'), 'trim');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('system/mail');
            }
            else
            {
                $this->settings->update_batch([
                    [
                        'key'   => 'mail_validation',
                        'value' => ($this->input->post('register', TRUE) != 'true') ? 'false' : 'true'
                    ],
                    [
                        'key'   => 'mail_mailer',
                        'value' => $this->input->post('mailer')
                    ],
                    [
                        'key'   => 'mail_hostname',
                        'value' => $this->input->post('hostname', TRUE)
                    ],
                    [
                        'key'   => 'mail_username',
                        'value' => $this->input->post('username')
                    ],
                    [
                        'key'   => 'mail_port',
                        'value' => $this->input->post('port')
                    ],
                    [
                        'key'   => 'mail_encryption',
                        'value' => $this->input->post('encryption')
                    ],
                    [
                        'key'   => 'mail_sender',
                        'value' => $this->input->post('sender', TRUE)
                    ]
                ], 'key');

                $password = $this->input->post('password');

                if (! empty($password))
                {
                    $this->settings->update([
                        'value' => encrypt($password)
                    ], ['key' => 'mail_password']);
                }

                // Clear cache
                $this->cache->file->delete('settings');

                $this->session->set_flashdata('success', lang('settings_updated'));
                redirect(site_url('admin/system/mail'));
            }
        }
        else
        {
            $this->template->build('system/mail');
        }
    }

    public function cache()
    {
        if (! $this->cache->file->clean())
        {
            $this->session->set_flashdata('error', lang('cache_error'));
        }
        else
        {
            $this->session->set_flashdata('success', lang('cache_deleted'));
        }

        redirect(site_url('admin/system'));
    }

    public function sessions()
    {
        $this->db->truncate('sessions');

        redirect(site_url('admin/system'));
    }

    public function logs()
    {
        $raw_page   = $this->input->get('page');
        $raw_search = $this->input->get('search');

        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $search   = $this->security->xss_clean($raw_search);
        $per_page = 25;

        $this->pagination->initialize([
            'base_url'    => site_url('admin/system/logs'),
            'total_rows'  => $this->logs->count_all($search),
            'per_page'    => $per_page,
            'uri_segment' => 4
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'logs'   => $this->logs->find_all($per_page, $offset, $search),
            'links'  => $this->pagination->create_links(),
            'search' => $raw_search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('system/logs', $data);
    }
}