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

class Admin extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('forum', true);

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

		$this->load->model('forum_model');
		$this->load->language('admin/admin');
		$this->load->language('forum');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'items' => $this->forum_model->get_all_forums()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('admin/index', $data);
	}

	public function create()
	{
		$data = [
			'categories' => $this->forum_model->get_all_forums(0, 'category'),
			'forums'     => $this->forum_model->get_all_forums(null, 'forum')
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|max_length[250]');
			$this->form_validation->set_rules('icon', 'Icon', 'trim');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[category,forum]');
			$this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('admin/create', $data);
			}
			else
			{
				$type   = $this->input->post('type');
				$parent = $this->input->post('parent');

				if ($type === 'forum' && $parent == 0)
				{
					$this->session->set_flashdata('error', lang('forum_need_related'));
					redirect(site_url('forum/admin/create'));
				}

				if ($type === 'category' && $this->forum_model->find_forum($parent, 'forum') || $type === 'category' && $this->forum_model->find_forum($parent, 'category'))
				{
					$this->session->set_flashdata('error', lang('category_not_relate'));
					redirect(site_url('forum/admin/create'));
				}

				$this->db->insert('forum', [
					'name'        => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'icon'        => $this->input->post('icon'),
					'type'        => $type,
					'parent'      => $parent
				]);

				$this->session->set_flashdata('success', lang('forum_created'));
				redirect(site_url('forum/admin/create'));
			}
		}
		else
		{
			$this->template->build('admin/create', $data);
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->forum_model->find_forum($id))
		{
			show_404();
		}

		$data = [
			'categories' => $this->forum_model->get_all_forums(0, 'category'),
			'forums'     => $this->forum_model->get_all_forums(null, 'forum'),
			'forum'      => $this->forum_model->get_forum($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|max_length[250]');
			$this->form_validation->set_rules('icon', 'Icon', 'trim');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[category,forum]');
			$this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('admin/edit', $data);
			}
			else
			{
				$type   = $this->input->post('type');
				$parent = $this->input->post('parent');

				if ($type === 'forum' && $parent == 0)
				{
					$this->session->set_flashdata('error', lang('forum_need_related'));
					redirect(site_url('forum/admin/edit/'.$id));
				}

				if ($type === 'category' && $this->forum_model->find_forum($parent, 'forum') || $type === 'category' && $this->forum_model->find_forum($parent, 'category'))
				{
					$this->session->set_flashdata('error', lang('category_not_relate'));
					redirect(site_url('forum/admin/edit/'.$id));
				}

				$this->db->where('id', $id)->update('forum', [
					'name'        => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'icon'        => $this->input->post('icon'),
					'type'        => $type,
					'parent'      => $parent
				]);

				$this->session->set_flashdata('success', lang('forum_updated'));
				redirect(site_url('forum/admin/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('admin/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->forum_model->find_forum($id))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('forum');

		$this->session->set_flashdata('success', lang('forum_deleted'));
		redirect(site_url('forum/admin'));
	}

	public function forum($id = null)
	{
		if (empty($id) || ! $this->forum_model->find_forum($id))
		{
			show_404();
		}

		$data = [
			'id'    => $id,
			'forum' => $this->forum_model->get_forum($id),
			'items' => $this->forum_model->get_all_forums($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('admin/index_items', $data);
	}
}