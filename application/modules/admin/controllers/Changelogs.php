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

		if (! $this->auth->is_admin())
		{
			redirect(site_url('user'));
		}

		if ($this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('changelogs_model');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('admin/changelogs'),
			'total_rows'  => $this->changelogs_model->count_all(),
			'per_page'    => 25,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'changelogs' => $this->changelogs_model->get_all($config['per_page'], $offset),
			'links'      => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('changelogs/index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('changelogs/create');
			}
			else
			{
				$this->db->insert('changelogs', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'created_at'  => now()
				]);

				$this->session->set_flashdata('success', lang('alert_changelog_created'));
				redirect(site_url('admin/changelogs/create'));
			}
		}
		else
		{
			$this->template->build('changelogs/create');
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->changelogs_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'changelog' => $this->changelogs_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('changelogs/edit', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('changelogs', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description')
				]);

				$this->session->set_flashdata('success', lang('alert_changelog_updated'));
				redirect(site_url('admin/changelogs/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('changelogs/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->changelogs_model->find_id($id))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('changelogs');

		$this->session->set_flashdata('success', lang('alert_changelog_deleted'));
		redirect(site_url('admin/changelogs'));
	}
}