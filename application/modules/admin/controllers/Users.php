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

class Users extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin())
		{
			redirect(site_url('user'));
		}

		if ($this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('users_model');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$config = [
			'base_url'    => site_url('admin/users'),
			'total_rows'  => $this->users_model->count_all(),
			'per_page'    => 25,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$data = [
			'links' => $this->pagination->create_links(),
			'users' => $this->users_model->get_all($config['per_page'], $page)
		];

		$this->template->title(config_item('app_name'), lang('button_admin_panel'));

		$this->template->build('users/index', $data);
	}

	public function view($id = null)
	{
		if (empty($id) || ! $this->users_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'user' => $this->users_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('button_admin_panel'));

		$this->template->build('users/view', $data);
	}

	public function logs($id = null)
	{
		if (empty($id) || ! $this->users_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'user' => $this->users_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('button_admin_panel'));

		$this->template->build('users/logs', $data);
	}
}