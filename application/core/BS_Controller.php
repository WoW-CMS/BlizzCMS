<?php defined('BASEPATH') or exit('No direct script access allowed');

// load the MX_Controller class
require APPPATH.'third_party/MX/Controller.php';

class BS_Controller extends MX_Controller
{
    /**
     * Array of URIs in which it is exclude pageviews tracking
     *
     * @var array
     */
    protected $pageviewsExcludeUris = [];

    /**
     * Current language used by the user
     *
     * @var string
     */
    protected $currentLanguage;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Allow form validation callback methods to work properly
        $this->form_validation->CI =& $this;

        $this->currentLanguage = $this->multilanguage->current_language();

        $this->config->set_item('language', $this->currentLanguage);

        $this->lang->load('general');

        $this->tracking_pageviews();

        $this->template->set_partial('alerts', 'static/alerts');
    }

    /**
     * Tracking Pageviews
     *
     * @return void
     */
    protected function tracking_pageviews()
    {
        if ($this->input->method() !== 'get' || $this->input->is_ajax_request() || is_cli()) {
            return;
        }

        if ($this->load->database() !== false) {
            return;
        }

        $matches = array_filter($this->pageviewsExcludeUris, fn($v) => preg_match('#^'.$v.'$#i'.(UTF8_ENABLED ? 'u' : ''), $this->uri->uri_string()) === 1);

        if (count($matches) >= 1) {
            return;
        }

        $this->pageviews_model->create();
    }

    /**
     * Set Captcha Rule
     *
     * Function to set the captcha rule in the validation form
     * and adds the necessary JS script to the head of the template.
     *
     * @return void
     */
    protected function set_captcha_rule()
    {
        $type = config_item('captcha_type');

        switch ($type) {
            case 'recaptcha':
                $field  = 'g-recaptcha-response';
                $src    = 'https://www.google.com/recaptcha/api.js'; 
                break;

            case 'turnstile':
                $field = 'cf-turnstile-response';
                $src   = 'https://challenges.cloudflare.com/turnstile/v0/api.js';
                break;

            default:
                $field = 'h-captcha-response';
                $src   = 'https://js.hcaptcha.com/1/api.js';
                break;
        }

        $this->form_validation->set_rules($field, lang('captcha'), 'trim|required|valid_captcha');

        $this->template->head_tags([
            ['script', ['src' => $src, 'async' => null, 'defer' => null]]
        ]);
    }
}

class Admin_Controller extends BS_Controller
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if (! is_logged_in()) {
            show_404();
        }

        require_permission('view.admin', 'admin');

        $this->load->language('admin/admin');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
    }
}
