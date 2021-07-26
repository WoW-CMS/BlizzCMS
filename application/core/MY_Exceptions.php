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

class MY_Exceptions extends CI_Exceptions
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 404 error page handler
     *
     * @param string $page
     * @param bool $log_error
     * @return void
     */
    public function show_404($page = '', $log_error = true)
    {
        $CI =& get_instance();

        if ($CI === null)
        {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['template', 'language']);
        $CI->load->model('settings_model');
        $CI->load->language('general', $CI->language->current());

        $data = [
            'heading' => $CI->lang->line('page_not_found'),
            'message' => $CI->lang->line('page_requested_not_found')
        ];

        if (is_cli()) {
            // By default we log this, but allow a dev to skip it
            if ($log_error) {
                log_message('error', $data['heading'].': '.$page);
            }

            echo parent::show_error($data['heading'], $data['message'], 'error_404', 404);
            exit(4); // EXIT_UNKNOWN_FILE
        }
        else {
            // By default we log this, but allow a dev to skip it
            if ($log_error) {
                log_message('error', $data['heading'].': '.$page);
            }

            $name = $CI->settings_model->saved_value('app_name');

            $CI->config->set_item('app_name', $name);
            $CI->template->title($name);

            $output = $CI->template->build('static/errors/404', $data, true);

            set_status_header(404);
            echo $output;
            exit(4); // EXIT_UNKNOWN_FILE
        }
    }

    /**
     * Permission rejected page handler
     *
     * @return void
     */
    public function show_permission_rejected()
    {
        $CI =& get_instance();

        if ($CI === null)
        {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['template', 'language']);
        $CI->load->model('settings_model');
        $CI->load->language('general', $CI->language->current());

        $data = [
            'heading' => $CI->lang->line('permission_rejected'),
            'message' => $CI->lang->line('dont_have_permission')
        ];

        $name = $CI->settings_model->saved_value('app_name');

        $CI->config->set_item('app_name', $name);
        $CI->template->title($name);

        $output = $CI->template->build('static/errors/permission', $data, true);

        set_status_header(401);
        echo $output;
        exit(0); // EXIT_SUCCESS
    }

    /**
     * Guest page handler
     *
     * @return void
     */
    public function show_guest()
    {
        $CI =& get_instance();

        if ($CI === null)
        {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['template', 'language']);
        $CI->load->model('settings_model');
        $CI->load->language('general', $CI->language->current());

        $data = [
            'heading' => $CI->lang->line('permission_rejected'),
            'message' => $CI->lang->line('already_logged_in')
        ];

        $name = $CI->settings_model->saved_value('app_name');

        $CI->config->set_item('app_name', $name);
        $CI->template->title($name);

        $output = $CI->template->build('static/errors/guest', $data, true);

        set_status_header(401);
        echo $output;
        exit(0); // EXIT_SUCCESS
    }

    /**
     * Logged in page handler
     *
     * @return void
     */
    public function show_loggedin()
    {
        $CI =& get_instance();

        if ($CI === null)
        {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['template', 'language']);
        $CI->load->model('settings_model');
        $CI->load->language('general', $CI->language->current());

        $data = [
            'heading' => $CI->lang->line('permission_rejected'),
            'message' => $CI->lang->line('must_be_logged_in')
        ];

        $name = $CI->settings_model->saved_value('app_name');

        $CI->config->set_item('app_name', $name);
        $CI->template->title($name);

        $output = $CI->template->build('static/errors/loggedin', $data, true);

        set_status_header(401);
        echo $output;
        exit(0); // EXIT_SUCCESS
    }
}