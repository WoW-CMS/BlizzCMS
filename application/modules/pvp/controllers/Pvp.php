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

class Pvp extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('pvp_model');
        $this->load->language('pvp');
    }

    public function index()
    {
        $data = [
            'realms' => $this->realm->get_realms()
        ];

        $this->template->title(config_item('app_name'), lang('pvp_statistics'));

        $this->template->build('index', $data);
    }
}
