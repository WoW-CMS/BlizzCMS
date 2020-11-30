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
	public function error404()
	{
		$this->template->title(config_item('app_name'), lang('tab_error'));

		$this->template->build('404');
	}
}