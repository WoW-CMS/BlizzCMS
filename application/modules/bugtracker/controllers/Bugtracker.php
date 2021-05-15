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

class Bugtracker extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('bugtracker', true);

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('bugtracker_model');
		$this->load->language('bugtracker');

		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$search         = $this->input->get('search');
		$category       = $this->input->get('category');
		$search_cleaned = $this->security->xss_clean($search);
		$cat_cleaned    = $this->security->xss_clean($category);

		$config = [
			'base_url'    => site_url('bugtracker'),
			'total_rows'  => $this->bugtracker_model->count_reports($search_cleaned, $cat_cleaned),
			'per_page'    => 15,
			'uri_segment' => 2
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'reports'  => $this->bugtracker_model->get_all($config['per_page'], $offset, $search_cleaned, $cat_cleaned),
			'links'    => $this->pagination->create_links(),
			'search'   => $search,
			'category' => $category
		];

		$this->template->title(config_item('app_name'), lang('bugtracker'));

		$this->template->build('index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('bugtracker'));

		$data = [
			'realms' => $this->realm->get_realms()
		];

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('create_report', $data);
			}
			else
			{
				$this->db->insert('bugtracker', [
					'user_id'     => $this->session->userdata('id'),
					'realm_id'    => $this->input->post('realm', TRUE),
					'title'       => $this->input->post('title', TRUE),
					'description' => $this->input->post('description'),
					'category_id' => $this->input->post('category', TRUE),
					'created_at'  => now()
				]);

				$this->session->set_flashdata('success', lang('report_created'));
				redirect(site_url('bugtracker/create'));
			}
		}
		else
		{
			$this->template->build('create_report', $data);
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->bugtracker_model->find_report($id))
		{
			show_404();
		}

		$report = $this->bugtracker_model->get_report($id);

		if (! $this->auth->is_moderator() || $this->session->userdata('id') != $report->user_id)
		{
			show_404();
		}

		$data = [
			'realms' => $this->realm->get_realms(),
			'report' => $report
		];

		$this->template->title(config_item('app_name'), lang('bugtracker'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->auth->is_moderator())
			{
				$this->form_validation->set_rules('priority', 'Priority', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');
			}

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('edit_report', $data);
			}
			else
			{
				$data = [
					'realm_id'    => $this->input->post('realm', TRUE),
					'title'       => $this->input->post('title', TRUE),
					'description' => $this->input->post('description'),
					'category_id' => $this->input->post('category', TRUE)
				];

				if ($this->auth->is_moderator())
				{
					$data['priority'] = $this->input->post('priority', TRUE);
					$data['status']   = $this->input->post('status', TRUE);
				}

				$this->db->where('id', $id)->update('bugtracker', $data);

				$this->session->set_flashdata('success', lang('report_edited'));
				redirect(site_url('bugtracker/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('edit_report', $data);
		}
	}

	public function report($id = null)
	{
		if (empty($id) || ! $this->bugtracker_model->find_report($id))
		{
			show_404();
		}

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('bugtracker/report/' . $id),
			'total_rows'  => $this->bugtracker_model->count_comments($id),
			'per_page'    => 15,
			'uri_segment' => 4
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'report'   => $this->bugtracker_model->get_report($id),
			'comments' => $this->bugtracker_model->get_all_comments($id, $config['per_page'], $offset),
			'links'    => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('bugtracker'));

		$this->template->build('report', $data);
	}

	public function comment()
	{
		if ($this->input->method() != 'post')
		{
			show_404();
		}

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->form_validation->set_rules('id', 'Id', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$id = $this->input->post('id', TRUE);

			$this->session->set_flashdata('form_error', form_error('comment', '', ''));
			redirect(site_url('bugtracker/report/' . $id));
		}
		else
		{
			$id = $this->input->post('id', TRUE);

			$this->db->insert('bugtracker_comments', [
				'report_id'  => $id,
				'user_id'    => $this->session->userdata('id'),
				'commentary' => $this->input->post('comment'),
				'created_at' => now()
			]);

			$this->session->set_flashdata('success', lang('comment_sended'));
			redirect(site_url('bugtracker/report/' . $id));
		}
	}

	public function delete_comment($id = null)
	{
		if (empty($id) || ! $this->bugtracker_model->find_comment($id))
		{
			show_404();
		}

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$comment = $this->bugtracker_model->get_comment($id);

		if ($this->auth->is_moderator() || $this->session->userdata('id') == $comment->user_id && now() < strtotime('+30 minutes', $comment->created_at))
		{
			$this->db->where('id', $id)->delete('bugtracker_comments');

			$this->session->set_flashdata('success', lang('comment_deleted'));
			redirect(site_url('bugtracker/report/' . $comment->report_id));
		}

		$this->session->set_flashdata('error', lang('permission_denied'));
		redirect(site_url('bugtracker/report/' . $comment->report_id));
	}
}
