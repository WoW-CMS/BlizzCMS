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

class Mod extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mod_model');

		if(!$this->website->isLogged())
			redirect(base_url(),'refresh');

		if(!$this->website->getIsModerator())
			redirect(base_url(),'refresh');

		$this->template->set_theme();
		$this->template->set_layout('mod_layout');
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
