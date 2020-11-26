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

class Changelogs extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('changelogs_model');

		if(!$this->auth->isLogged())
			redirect(base_url('login'),'refresh');
	}

	public function index()
	{
		$data = array(
			'pagetitle' => lang('tab_changelogs'),
		);

		$this->template->build('index', $data);
	}
}
