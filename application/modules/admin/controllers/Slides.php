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

class Slides extends MX_Controller
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

		$this->load->model('slides_model');
		$this->load->language('admin');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'slides' => $this->slides_model->get_all()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('slides/index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[image,video,iframe]');
			$this->form_validation->set_rules('route', 'Route', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('slides/create');
			}
			else
			{
				$this->db->insert('slides', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'type'        => $this->input->post('type'),
					'route'       => $this->input->post('route', TRUE)
				]);

				$this->session->set_flashdata('success', lang('alert_slide_created'));
				redirect(site_url('admin/slides/create'));
			}
		}
		else
		{
			$this->template->build('slides/create');
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->slides_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'slide' => $this->slides_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[image,video,iframe]');
			$this->form_validation->set_rules('route', 'Route', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('slides/edit', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('slides', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'type'        => $this->input->post('type'),
					'route'       => $this->input->post('route', TRUE)
				]);

				$this->session->set_flashdata('success', lang('alert_slide_updated'));
				redirect(site_url('admin/slides/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('slides/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->slides_model->find_id($id))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('slides');

		$this->session->set_flashdata('success', lang('alert_slide_deleted'));
		redirect(site_url('admin/slides'));
	}
}