<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Changelogs extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('changelogs_model');

		if(!$this->website->isLogged())
			redirect(base_url('login'),'refresh');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('tab_changelogs'));

		$this->template->build('index');
	}
}
