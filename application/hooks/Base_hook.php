<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_hook
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Redirect if installation is still active
     */
    public function installation()
    {
        if (! $this->CI->config->item('installation_active')) {
            return;
        }

        if (in_array($this->CI->uri->segment(1), ['install', 'lang'], true)) {
            return;
        }

        redirect(site_url('install'));
    }

    /**
     * Load settings from the database
     */
    public function load_settings()
    {
        if ($this->CI->load->database() !== false) {
            return;
        }

        $data = $this->CI->setting_model->get_all();

        foreach ($data as $row) {
            switch ($row->type) {
                case 'bool':
                    $val = filter_var($row->value, FILTER_VALIDATE_BOOLEAN);
                    break;

                case 'float':
                    $val = (float) $row->value;
                    break;

                case 'int':
                    $val = (int) $row->value;
                    break;

                default:
                    $val = $row->value;
                    break;
            }

            $this->CI->config->set_item($row->key, $val);
        }
    }

    /**
     * Re-login through a cookie
     */
    public function remember()
    {
        if ($this->CI->load->database() !== false) {
            return;
        }

        $this->CI->auth_model->restore_session();
    }

    /**
     * Log out if the user is connected from a banned IP
     */
    public function logout_banned_ip()
    {
        if ($this->CI->load->database() !== false) {
            return;
        }

        if (! $this->CI->auth_model->is_logged_in()) {
            return;
        }

        if (! $this->CI->ban_model->is_ip_banned($this->CI->input->ip_address())) {
            return;
        }

        if (get_cookie('remember', true) !== null) {
            $this->CI->user_token_model->delete([
                'user_id' => $this->CI->session->userdata('id')
            ]);

            delete_cookie('remember');
        }

        session_destroy();

        redirect(site_url());
    }
}
