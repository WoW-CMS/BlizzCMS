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

class Switcher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * switcher website language
     *
     * @param string $lang
     * @return void
     */
    public function index($lang = null)
    {
        $this->language->set($lang);

        redirect($this->agent->referrer());
    }
}