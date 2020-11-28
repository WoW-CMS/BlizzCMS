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

class General extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function error404()
	{
		$data = array(
			'pagetitle' => lang('tab_error'),
		);

		$this->template->build('404', $data);
	}

	public function maintenance()
	{
		$data = array(
			'pagetitle' => lang('tab_maintenance'),
		);

		$this->template->build('maintenance', $data);
	}
}