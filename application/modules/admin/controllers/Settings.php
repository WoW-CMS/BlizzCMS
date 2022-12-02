<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('view.settings');
    }

    public function index()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('realmlist', lang('realmlist'), 'trim');
        $this->form_validation->set_rules('expansion', lang('expansion'), 'trim|required|is_natural');
        $this->form_validation->set_rules('emulator', lang('emulator'), 'trim|required|alpha_dash');
        $this->form_validation->set_rules('bnet', lang('bnet_authentication'), 'trim|required|in_list[true,false]');
        $this->form_validation->set_rules('discord', lang('discord'), 'trim|alpha_numeric');
        $this->form_validation->set_rules('facebook', lang('facebook'), 'trim|alpha_dash');
        $this->form_validation->set_rules('twitter', lang('twitter'), 'trim|alpha_dash');
        $this->form_validation->set_rules('youtube', lang('youtube'), 'trim|alpha_dash');
        $this->form_validation->set_rules('register_page', lang('register_page'), 'trim');
        $this->form_validation->set_rules('forgot_page', lang('forgot_password_page'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'app_name',
                    'value' => $this->input->post('name', true)
                ],
                [
                    'key'   => 'app_realmlist',
                    'value' => $this->input->post('realmlist', true)
                ],
                [
                    'key'   => 'app_expansion',
                    'value' => $this->input->post('expansion')
                ],
                [
                    'key'   => 'app_emulator',
                    'value' => $this->input->post('emulator')
                ],
                [
                    'key'   => 'app_emulator_bnet',
                    'value' => $this->input->post('bnet')
                ],
                [
                    'key'   => 'social_discord',
                    'value' => $this->input->post('discord')
                ],
                [
                    'key'   => 'social_facebook',
                    'value' => $this->input->post('facebook')
                ],
                [
                    'key'   => 'social_twitter',
                    'value' => $this->input->post('twitter')
                ],
                [
                    'key'   => 'social_youtube',
                    'value' => $this->input->post('youtube')
                ],
                [
                    'key'   => 'show_register_page',
                    'value' => $this->input->post('register_page', true) !== 'true' ? 'false' : 'true'
                ],
                [
                    'key'   => 'show_forgot_page',
                    'value' => $this->input->post('forgot_page', true) !== 'true' ? 'false' : 'true'
                ]
            ], 'key');

            $this->log_model->create('settings', 'edit', 'Edited the general settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings'));
        } else {
            $this->template->build('settings/index');
        }
    }

    public function avatar()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('max_size', lang('max_size'), 'trim|required|numeric|greater_than_equal_to[1024]');
        $this->form_validation->set_rules('background', lang('background'), 'trim|required|exact_length[7]');
        $this->form_validation->set_rules('color', lang('color'), 'trim|required|exact_length[7]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/avatar'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'avatar_max_size',
                    'value' => $this->input->post('max_size')
                ],
                [
                    'key'   => 'avatar_api_background',
                    'value' => $this->input->post('background')
                ],
                [
                    'key'   => 'avatar_api_color',
                    'value' => $this->input->post('color')
                ]
            ], 'key');

            $this->log_model->create('settings', 'edit', 'Edited the avatar settings');

            $this->cache->delete('settings');
            $this->cache->delete('users_avatars');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/avatar'));
        } else {
            $this->template->build('settings/avatar');
        }
    }

    public function captcha()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('captcha_type', lang('type'), 'trim|required|in_list[hcaptcha,recaptcha,turnstile]');
        $this->form_validation->set_rules('captcha_size', lang('size'), 'trim|required|in_list[normal,compact]');
        $this->form_validation->set_rules('captcha_theme', lang('theme'), 'trim|required|in_list[light,dark]');
        $this->form_validation->set_rules('captcha_sitekey', lang('site_key'), 'trim|required');
        $this->form_validation->set_rules('captcha_secretkey', lang('secret_key'), 'trim');
        $this->form_validation->set_rules('captcha_login_page', lang('login_page'), 'trim');
        $this->form_validation->set_rules('captcha_register_page', lang('register_page'), 'trim');
        $this->form_validation->set_rules('captcha_forgot_page', lang('forgot_password_page'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/captcha'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'captcha_type',
                    'value' => $this->input->post('captcha_type')
                ],
                [
                    'key'   => 'captcha_size',
                    'value' => $this->input->post('captcha_size')
                ],
                [
                    'key'   => 'captcha_theme',
                    'value' => $this->input->post('captcha_theme')
                ],
                [
                    'key'   => 'captcha_sitekey',
                    'value' => $this->input->post('captcha_sitekey')
                ],
                [
                    'key'   => 'captcha_login_page',
                    'value' => $this->input->post('captcha_login_page', true) !== 'true' ? 'false' : 'true'
                ],
                [
                    'key'   => 'captcha_register_page',
                    'value' => $this->input->post('captcha_register_page', true) !== 'true' ? 'false' : 'true'
                ],
                [
                    'key'   => 'captcha_forgot_page',
                    'value' => $this->input->post('captcha_forgot_page', true) !== 'true' ? 'false' : 'true'
                ]
            ], 'key');

            $secretkey = $this->input->post('captcha_secretkey');

            if (! empty($secretkey)) {
                $this->setting_model->update([
                    'value' => encrypt($secretkey)
                ], ['key' => 'captcha_secretkey']);
            }

            $this->log_model->create('settings', 'edit', 'Edited the captcha settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/captcha'));
        } else {
            $this->template->build('settings/captcha');
        }
    }

    public function discussion()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('articles_max_recently', lang('articles_max_recently'), 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('articles_per_page', lang('articles_per_page'), 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('comments_per_page', lang('comments_per_page'), 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('comments_min_length', lang('comment_min_length'), 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('comments_max_length', lang('comment_max_length'), 'trim|required|is_natural');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/discussion'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'articles_max_recently',
                    'value' => $this->input->post('articles_max_recently')
                ],
                [
                    'key'   => 'articles_per_page',
                    'value' => $this->input->post('articles_per_page')
                ],
                [
                    'key'   => 'comments_per_page',
                    'value' => $this->input->post('comments_per_page')
                ],
                [
                    'key'   => 'comments_min_length',
                    'value' => $this->input->post('comments_min_length')
                ],
                [
                    'key'   => 'comments_max_length',
                    'value' => $this->input->post('comments_max_length')
                ]
            ], 'key');

            $this->log_model->create('settings', 'edit', 'Edited the discussion settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/discussion'));
        } else {
            $this->template->build('settings/discussion');
        }
    }

    public function login()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('max_attempts', lang('max_attempts'), 'trim|required|numeric|greater_than_equal_to[2]|less_than_equal_to[15]');
        $this->form_validation->set_rules('lockout_interval', lang('value'), 'trim|required|is_natural_no_zero|less_than_equal_to[120]');
        $this->form_validation->set_rules('lockout_option', lang('option'), 'trim|required|in_list[M,H]');
        $this->form_validation->set_rules('reset_interval', lang('value'), 'trim|required|is_natural_no_zero|less_than_equal_to[120]');
        $this->form_validation->set_rules('reset_option', lang('option'), 'trim|required|in_list[M,H]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/login'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'login_max_attempts',
                    'value' => $this->input->post('max_attempts')
                ],
                [
                    'key'   => 'login_lockout_interval',
                    'value' => $this->input->post('lockout_interval') . $this->input->post('lockout_option')
                ],
                [
                    'key'   => 'login_reset_interval',
                    'value' => $this->input->post('reset_interval') . $this->input->post('reset_option')
                ]
            ], 'key');

            $this->log_model->create('settings', 'edit', 'Edited the login settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/login'));
        } else {
            $this->template->build('settings/login');
        }
    }

    public function logs()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('value', lang('value'), 'trim|required|is_natural_no_zero|less_than_equal_to[365]');
        $this->form_validation->set_rules('option', lang('option'), 'trim|required|in_list[D,M,Y]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/logs'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'logs_keep_interval',
                    'value' => $this->input->post('value') . $this->input->post('option')
                ]
            ], 'key');

            $this->log_model->create('settings', 'edit', 'Edited the logs settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/logs'));
        } else {
            $this->template->build('settings/logs');
        }
    }

    public function mailer()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('protocol', lang('protocol'), 'trim|required|in_list[mail,sendmail,smtp]');
        $this->form_validation->set_rules('hostname', lang('hostname'), 'trim|alpha_period');
        $this->form_validation->set_rules('username', lang('username'), 'trim');
        $this->form_validation->set_rules('password', lang('password'), 'trim');
        $this->form_validation->set_rules('port', lang('port'), 'trim|required|numeric|less_than_equal_to[65535]');
        $this->form_validation->set_rules('encryption', lang('encryption'), 'trim|in_list[tls,ssl]');
        $this->form_validation->set_rules('from_name', lang('from_name'), 'trim|required');
        $this->form_validation->set_rules('from_email', lang('from_email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('account_confirmation', lang('account_confirmation'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/mailer'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'mailer_protocol',
                    'value' => $this->input->post('protocol')
                ],
                [
                    'key'   => 'mailer_hostname',
                    'value' => $this->input->post('hostname', true)
                ],
                [
                    'key'   => 'mailer_username',
                    'value' => $this->input->post('username')
                ],
                [
                    'key'   => 'mailer_port',
                    'value' => $this->input->post('port')
                ],
                [
                    'key'   => 'mailer_encryption',
                    'value' => $this->input->post('encryption')
                ],
                [
                    'key'   => 'mailer_from_name',
                    'value' => $this->input->post('from_name', true)
                ],
                [
                    'key'   => 'mailer_from_email',
                    'value' => $this->input->post('from_email', true)
                ],
                [
                    'key'   => 'mailer_account_confirmation',
                    'value' => $this->input->post('account_confirmation', true) !== 'true' ? 'false' : 'true'
                ]
            ], 'key');

            $password = $this->input->post('password');

            if (! empty($password)) {
                $this->setting_model->update([
                    'value' => encrypt($password)
                ], ['key' => 'mailer_password']);
            }

            $this->log_model->create('settings', 'edit', 'Edited the mail settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/mailer'));
        } else {
            $this->template->build('settings/mailer');
        }
    }

    public function seo()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('seo_tags', lang('seo_tags'), 'trim');
        $this->form_validation->set_rules('og_tags', lang('open_graph_tags'), 'trim');
        $this->form_validation->set_rules('meta_description', lang('meta_description'), 'trim|max_length[155]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (! has_permission('edit.settings', 'admin')) {
                $this->session->set_flashdata('error', lang('exception_no_action_permission'));
                redirect(site_url('admin/settings/seo'));
            }

            $this->setting_model->update_batch([
                [
                    'key'   => 'seo_tags',
                    'value' => $this->input->post('seo_tags', true) !== 'true' ? 'false' : 'true'
                ],
                [
                    'key'   => 'seo_og_tags',
                    'value' => $this->input->post('og_tags', true) !== 'true' ? 'false' : 'true'
                ],
                [
                    'key'   => 'seo_description_tag',
                    'value' => $this->input->post('meta_description', true)
                ]
            ], 'key');

            $this->log_model->create('settings', 'edit', 'Edited the SEO settings');

            $this->cache->delete('settings');

            $this->session->set_flashdata('success', lang('alert_settings_updated'));
            redirect(site_url('admin/settings/seo'));
        } else {
            $this->template->build('settings/seo');
        }
    }

    public function mailer_test()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('html', lang('html'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $html = $this->input->post('html');

            $message = $html === 'true' ? $this->template->load_view('email/template', ['message' => lang('test_email_message')]) : lang('test_email_message');
            $type    = $html === 'true' ? 'html' : 'text';

            $debug = $this->auth_model->send_email(
                $this->input->post('email', true),
                lang('test_email'),
                $message,
                $type,
                true
            );

            $this->session->set_flashdata([
                'info'  => lang('alert_test_email_sent'),
                'debug' => $debug
            ]);
            redirect(site_url('admin/settings/mailer/test'));
        } else {
            $this->template->build('settings/mailer_test');
        }
    }

    public function purge_logs()
    {
        $interval = $this->setting_model->get_value('logs_keep_interval') ?? '6M';

        $this->setting_model->update([
            'value' => add_timespan('now', 'P' . $interval)
        ], ['key' => 'logs_purge_date']);

        $this->db->truncate('logs');

        $this->log_model->create('logs', 'purge', 'Purged all logs');

        $this->cache->delete('settings');

        $this->session->set_flashdata('success', lang('alert_logs_purged'));
        redirect(site_url('admin/settings/logs'));
    }
}
