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

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('changelogs_model');
	}

	public function index()
	{
		$config = [
			'base_url'    => site_url('changelogs'),
			'total_rows'  => $this->changelogs_model->count_changelogs(),
			'per_page'    => 15,
			'uri_segment' => 2
		];

		$this->pagination->initialize($config);

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$data = [
			'changelogs' => $this->changelogs_model->get_all($config['per_page'], $page),
			'links'      => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('tab_changelogs'));

		$this->template->build('index', $data);
	}
}
