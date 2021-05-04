<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin() || $this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('pages_model');
		$this->load->language('admin');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('admin/pages'),
			'total_rows'  => $this->pages_model->count_all(),
			'per_page'    => 25,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'pages' => $this->pages_model->get_all($config['per_page'], $offset),
			'links' => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('pages/index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[pages.slug]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('pages/create');
			}
			else
			{
				$this->db->insert('pages', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'slug'        => $this->input->post('slug'),
					'created_at'  => now()
				]);

				$this->session->set_flashdata('success', lang('page_created'));
				redirect(site_url('admin/pages/create'));
			}
		}
		else
		{
			$this->template->build('pages/create');
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->pages_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'page' => $this->pages_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|update_unique[pages.slug.'.$id.']');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('pages/edit', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('pages', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'slug'        => $this->input->post('slug'),
				]);

				$this->session->set_flashdata('success', lang('page_updated'));
				redirect(site_url('admin/pages/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('pages/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->pages_model->find_id($id))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('pages');

		$this->session->set_flashdata('success', lang('page_deleted'));
		redirect(site_url('admin/pages'));
	}
}