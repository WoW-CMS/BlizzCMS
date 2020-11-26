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

class Bugtracker extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('bugtracker_model');
		$this->load->config('bugtracker');

		if (!$this->wowmodule->getBugtrackerStatus())
			redirect(base_url(),'refresh');

		if(!$this->auth->isLogged())
			redirect(base_url('login'),'refresh');
	}

	public function index()
	{
		$data = array(
			'pagetitle' => lang('tab_bugtracker'),
		);

		$config['total_rows'] = $this->bugtracker_model->getAllBugs();
		$data['total_count'] = $config['total_rows'];
		$config['suffix'] = '';

		if ($config['total_rows'] > 0)
		{
			$page_number = $this->uri->segment(3);
			$config['base_url'] = base_url().'bugtracker/';

			if (empty($page_number))
				$page_number = 1;

			$offset = ($page_number - 1) * $this->pagination->per_page;
			$this->bugtracker_model->setPageNumber($this->pagination->per_page);
			$this->bugtracker_model->setOffset($offset);
			$this->pagination->initialize($config);

			$data['pagination_links'] = $this->pagination->create_links();
			$data['bugtrackerList'] = $this->bugtracker_model->bugtrackerList();
		}

		$this->template->build('index', $data);
	}

	public function newreport()
	{
		if($this->auth->getIsAdmin())
			$tiny = $this->base->tinyEditor('Admin');
		else
			$tiny = $this->base->tinyEditor('User');

		$data = array(
			'pagetitle' => lang('tab_bugtracker'),
			'lang' => $this->lang->lang(),
			'tiny' => $tiny,
		);

		$this->template->build('new_report', $data);
	}

	public function report($id)
	{
		if (empty($id) || is_null($id) || $id == '0')
			redirect(base_url(),'refresh');

		if (!$this->wowmodule->getBugtrackerStatus())
			redirect(base_url(),'refresh');

		$data = array(
			'idlink' => $id,
			'pagetitle' => lang('tab_bugtracker'),
		);

		$this->template->build('report', $data);
	}

	public function create()
	{
		$title = $this->input->post('title');
		$description = $_POST['description'];
		$type = $this->input->post('type');
		$priority = $this->input->post('priority');
		echo $this->bugtracker_model->insertIssue($title, $description, $type, $priority);
	}
}
