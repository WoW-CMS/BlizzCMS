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

class Home extends CI_Controller
{
	public function index()
	{
		$data = [
			'articles' => [], // $this->news_model->getNewsList()->result()
			'realms'   => $this->realm->getRealms()->result()
		];

		$this->template->title(config_item('app_name'));

		$this->template->build('home', $data);
	}
}