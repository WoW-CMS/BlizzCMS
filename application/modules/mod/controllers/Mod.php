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

class Mod extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_moderator())
		{
			redirect(site_url('user'));
		}

		$this->load->model('mod_model');

		$this->template->set_theme();
		$this->template->set_layout('mod_layout');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('mod_panel'));

		$this->template->build('index');
	}

	public function queue()
	{
		$this->template->title(config_item('app_name'), lang('mod_panel'));

		$this->template->build('queue/index');
	}

	public function reports()
	{
		$this->template->title(config_item('app_name'), lang('mod_panel'));

		$this->template->build('reports/index');
	}

	public function logs()
	{
		$this->template->title(config_item('app_name'), lang('mod_panel'));

		$this->template->build('logs/index');
	}

	public function bannings()
	{
		$this->template->title(config_item('app_name'), lang('mod_panel'));

		$this->template->build('bannings/index');
	}

	public function warnings()
	{
		$this->template->title(config_item('app_name'), lang('mod_panel'));

		$this->template->build('warnings/index');
	}
}
