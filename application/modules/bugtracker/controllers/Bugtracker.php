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

class Bugtracker extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('bugtracker_model');
		$this->load->config('bugtracker');
	}

	public function index()
	{
		$config = [
			'base_url'    => site_url('bugtracker'),
			'total_rows'  => $this->bugtracker_model->count_reports(),
			'per_page'    => 15,
			'uri_segment' => 2
		];

		$this->pagination->initialize($config);

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$data = [
			'reports' => $this->bugtracker_model->get_all($config['per_page'], $page),
			'links'   => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('tab_bugtracker'));

		$this->template->build('index', $data);
	}

	public function newreport()
	{
		if($this->auth->is_admin())
			$tiny = $this->base->tinyEditor('Admin');
		else
			$tiny = $this->base->tinyEditor('User');

		$data = [
			'tiny' => $tiny
		];

		$this->template->title(config_item('app_name'), lang('tab_bugtracker'));

		$this->template->build('new_report', $data);
	}

	public function report($id = null)
	{
		if (empty($id) || ! $this->bugtracker_model->find_report($id))
		{
			show_404();
		}

		$data = [
			'report' => $this->bugtracker_model->get_report($id)
		];

		$this->template->title(config_item('app_name'), lang('tab_bugtracker'));

		$this->template->build('report', $data);
	}

	public function create()
	{
		$title       = $this->input->post('title', TRUE);
		$description = $this->input->post('description');
		$type        = $this->input->post('type', TRUE);
		$priority    = $this->input->post('priority', TRUE);
		echo $this->bugtracker_model->insertIssue($title, $description, $type, $priority);
	}

	public function update_priority()
	{
		if (! $this->auth->is_moderator())
		{
			redirect(site_url('bugtracker'));
		}

		$id       = $this->input->post('id', TRUE);
		$priority = $this->input->post('priority', TRUE);
		$this->bugtracker_model->change_priority($id, $priority);

		redirect(site_url('bugtracker/report/'.$id));
	}

	public function update_status()
	{
		if (! $this->auth->is_moderator())
		{
			redirect(site_url('bugtracker'));
		}

		$id     = $this->input->post('id', TRUE);
		$status = $this->input->post('status', TRUE);
		$this->bugtracker_model->change_status($id, $status);

		redirect(site_url('bugtracker/report/'.$id));
	}

	public function update_type()
	{
		if (! $this->auth->is_moderator())
		{
			redirect(site_url('bugtracker'));
		}

		$id   = $this->input->post('id', TRUE);
		$type = $this->input->post('type', TRUE);
		$this->bugtracker_model->change_type($id, $type);

		redirect(site_url('bugtracker/report/'.$id));
	}

	public function close_report()
	{
		if (! $this->auth->is_moderator())
		{
			redirect(site_url('bugtracker'));
		}

		$id = $this->input->post('id', TRUE);
		$this->bugtracker_model->close_report($id);

		redirect(site_url('bugtracker/report/'.$id));
	}
}
