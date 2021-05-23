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

		mod_located('store', true);

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin() || $this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('store_model');
		$this->load->language('admin/admin');
		$this->load->language('store');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'categories' => $this->store_model->get_all_categories()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('admin/index', $data);
	}

	public function create()
	{
		$data = [
			'parents' => $this->store_model->get_all_categories()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[store.slug]');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[default,accordion]');
			$this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('admin/create', $data);
			}
			else
			{
				$this->db->insert('store', [
					'name'   => $this->input->post('name'),
					'slug'   => $this->input->post('slug'),
					'type'   => $this->input->post('type'),
					'parent' => $this->input->post('parent')
				]);

				$this->session->set_flashdata('success', lang('category_created'));
				redirect(site_url('store/admin/create'));
			}
		}
		else
		{
			$this->template->build('admin/create', $data);
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->store_model->find_category($id, 'id'))
		{
			show_404();
		}

		$data = [
			'parents'  => $this->store_model->get_all_categories(),
			'category' => $this->store_model->get_category($id, 'id')
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|update_unique[store.slug.'.$id.']');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[default,accordion]');
			$this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('admin/edit', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('store', [
					'name'   => $this->input->post('name'),
					'slug'   => $this->input->post('slug'),
					'type'   => $this->input->post('type'),
					'parent' => $this->input->post('parent')
				]);

				$this->session->set_flashdata('success', lang('category_updated'));
				redirect(site_url('store/admin/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('admin/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->store_model->find_category($id, 'id'))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('store');

		$this->session->set_flashdata('success', lang('category_deleted'));
		redirect(site_url('store/admin'));
	}

	public function category($category = null)
	{
		if (empty($category) || ! $this->store_model->find_category($category, 'id'))
		{
			show_404();
		}

		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('store/admin'),
			'total_rows'  => $this->store_model->count_items($category),
			'per_page'    => 25,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'id'       => $category,
			'category' => $this->store_model->get_category($category, 'id'),
			'items'    => $this->store_model->get_all_items($category, $config['per_page'], $offset),
			'links'    => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('admin/items', $data);
	}

	public function create_item($category = null)
	{
		if (empty($category) || ! $this->store_model->find_category($category, 'id'))
		{
			show_404();
		}

		$data = [
			'id'       => $category,
			'category' => $this->store_model->get_category($category, 'id'),
			'realms'   => $this->realm->get_realms()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('description', 'Description', 'trim');
			$this->form_validation->set_rules('image', 'Image', 'trim');
			$this->form_validation->set_rules('price_type', 'Price type', 'trim|required|in_list[dp,vp,and]');
			$this->form_validation->set_rules('dp', 'DP', 'trim|is_natural');
			$this->form_validation->set_rules('vp', 'VP', 'trim|is_natural');
			$this->form_validation->set_rules('top', 'Top', 'trim');
			$this->form_validation->set_rules('command', 'Command', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('admin/create_item', $data);
			}
			else
			{
				$this->db->insert('store_items', [
					'store_id'    => $category,
					'realm_id'    => $this->input->post('realm'),
					'name'        => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'image'       => $this->input->post('image'),
					'price_type'  => $this->input->post('price_type'),
					'dp'          => $this->input->post('dp'),
					'vp'          => $this->input->post('vp'),
					'top'         => empty($this->input->post('top', TRUE)) ? 0 : 1,
					'command'     => $this->input->post('command')
				]);

				$this->session->set_flashdata('success', lang('item_created'));
				redirect(site_url('store/admin/'. $category));
			}
		}
		else
		{
			$this->template->build('admin/create_item', $data);
		}
	}

	public function edit_item($category = null, $item = null)
	{
		if (empty($category) || empty($item) || ! $this->store_model->find_item($item))
		{
			show_404();
		}

		$data = [
			'id'       => $category,
			'category' => $this->store_model->get_category($category, 'id'),
			'realms'   => $this->realm->get_realms(),
			'item'     => $this->store_model->get_item($item)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('description', 'Description', 'trim');
			$this->form_validation->set_rules('image', 'Image', 'trim');
			$this->form_validation->set_rules('price_type', 'Price type', 'trim|required|in_list[dp,vp,and]');
			$this->form_validation->set_rules('dp', 'DP', 'trim|is_natural');
			$this->form_validation->set_rules('vp', 'VP', 'trim|is_natural');
			$this->form_validation->set_rules('top', 'Top', 'trim');
			$this->form_validation->set_rules('command', 'Command', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('admin/edit_item', $data);
			}
			else
			{
				$this->db->where('id', $item)->update('store_items', [
					'realm_id'    => $this->input->post('realm'),
					'name'        => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'image'       => $this->input->post('image'),
					'price_type'  => $this->input->post('price_type'),
					'dp'          => $this->input->post('dp'),
					'vp'          => $this->input->post('vp'),
					'top'         => empty($this->input->post('top', TRUE)) ? 0 : 1,
					'command'     => $this->input->post('command')
				]);

				$this->session->set_flashdata('success', lang('item_updated'));
				redirect(site_url('store/admin/'.$category.'/edit/'.$item));
			}
		}
		else
		{
			$this->template->build('admin/edit_item', $data);
		}
	}

	public function delete_item($category = null, $item = null)
	{
		if (empty($category) || empty($item) || ! $this->store_model->find_item($item))
		{
			show_404();
		}

		$this->db->where('id', $item)->delete('store_items');

		$this->session->set_flashdata('success', lang('item_deleted'));
		redirect(site_url('store/admin/'.$category));
	}

	public function logs()
	{

		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$search       = $this->input->get('search');
		$search_clean = $this->security->xss_clean($search);

		$config = [
			'base_url'    => site_url('store/admin/logs'),
			'total_rows'  => $this->store_model->count_logs($search_clean),
			'per_page'    => 25,
			'uri_segment' => 4
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'logs'  => $this->store_model->get_all_logs($config['per_page'], $offset, $search_clean),
			'links'  => $this->pagination->create_links(),
			'search' => $search
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('admin/logs', $data);
	}
}