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

class Page extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}

	public function index($uri)
	{
		if (empty($uri) || is_null($uri) || $uri == NULL)
			redirect(base_url(),'refresh');

		if ($this->page_model->getVerifyExist($uri) < 1)
			redirect(base_url(),'refresh');

		$data = [
			'uri' => $uri
		];

		$this->template->title(config_item('app_name'), $this->page_model->getName($uri));

		$this->template->build('index', $data);
	}
}
