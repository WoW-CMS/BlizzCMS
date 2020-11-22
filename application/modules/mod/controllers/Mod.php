<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod extends MX_Controller {

    private $wowlocmod = '',
            $wowlocref = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_model');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        if(!$this->wowauth->getIsModerator())
            redirect(base_url(),'refresh');

        $this->template->set_theme('mod');

        $this->wowlocmod = base_url('application/themes/'.$this->template->get_theme().'/');
        $this->wowlocref = base_url('application/themes/'.config_item('theme_name').'/');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => lang('button_mod_panel'),
        );

        $this->template->build('index', $data);
    }

    public function queue()
    {
        $data = array(
            'pagetitle' => lang('button_mod_panel'),
        );

        $this->template->build('queue/index', $data);
    }

    public function reports()
    {
        $data = array(
            'pagetitle' => lang('button_mod_panel'),
        );

        $this->template->build('reports/index', $data);
    }

    public function logs()
    {
        $data = array(
            'pagetitle' => lang('button_mod_panel'),
        );

        $this->template->build('logs/index', $data);
    }

    public function bannings()
    {
        $data = array(
            'pagetitle' => lang('button_mod_panel'),
        );

        $this->template->build('bannings/index', $data);
    }

    public function warnings()
    {
        $data = array(
            'pagetitle' => lang('button_mod_panel'),
        );

        $this->template->build('warnings/index', $data);
    }
}
