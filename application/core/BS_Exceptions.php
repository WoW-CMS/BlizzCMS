<?php defined('BASEPATH') or exit('No direct script access allowed');

class BS_Exceptions extends CI_Exceptions
{
    public function __construct()
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

        if ($CI === null) {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['multilanguage', 'template']);
        $CI->load->model('setting_model');
        $CI->load->language('general', $CI->multilanguage->current_language());

        $data = [
            'heading' => $CI->lang->line('exception_page_not_found'),
            'message' => $CI->lang->line('exception_page_requested_not_found')
        ];

        if (is_cli()) {
            // By default we log this, but allow a dev to skip it
            if ($log_error) {
                log_message('error', $data['heading'] . ': ' . $page);
            }

            echo parent::show_error($data['heading'], $data['message'], 'error_404', 404);
            exit(4); // EXIT_UNKNOWN_FILE
        } else {
            // By default we log this, but allow a dev to skip it
            if ($log_error) {
                log_message('error', $data['heading'] . ': ' . $page);
            }

            $name = $CI->setting_model->get_value('app_name');

            $CI->config->set_item('app_name', $name);

            $CI->template->title($CI->lang->line('exception_error_404'), $name);

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

        if ($CI === null) {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['multilanguage', 'template']);
        $CI->load->model('setting_model');
        $CI->load->language('general', $CI->multilanguage->current_language());

        $data = [
            'heading' => $CI->lang->line('exception_permission_rejected'),
            'message' => $CI->lang->line('exception_no_access_permission')
        ];

        $name = $CI->setting_model->get_value('app_name');

        $CI->config->set_item('app_name', $name);

        $CI->template->title($CI->lang->line('error'), $name);

        $CI->template->add_meta('robots', 'noindex, follow');

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

        if ($CI === null) {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['multilanguage', 'template']);
        $CI->load->model('setting_model');
        $CI->load->language('general', $CI->multilanguage->current_language());

        $data = [
            'heading' => $CI->lang->line('exception_permission_rejected'),
            'message' => $CI->lang->line('exception_already_logged_in')
        ];

        $name = $CI->setting_model->get_value('app_name');

        $CI->config->set_item('app_name', $name);

        $CI->template->title($CI->lang->line('error'), $name);

        $CI->template->add_meta('robots', 'noindex, follow');

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

        if ($CI === null) {
            new CI_Controller();
            $CI =& get_instance();
        }

        $CI->load->helper('url');
        $CI->load->library(['multilanguage', 'template']);
        $CI->load->model('setting_model');
        $CI->load->language('general', $CI->multilanguage->current_language());

        $data = [
            'heading' => $CI->lang->line('exception_permission_rejected'),
            'message' => $CI->lang->line('exception_must_be_logged_in')
        ];

        $name = $CI->setting_model->get_value('app_name');

        $CI->config->set_item('app_name', $name);

        $CI->template->title($CI->lang->line('error'), $name);

        $CI->template->add_meta('robots', 'noindex, follow');

        $output = $CI->template->build('static/errors/loggedin', $data, true);

        set_status_header(401);
        echo $output;
        exit(0); // EXIT_SUCCESS
    }
}
