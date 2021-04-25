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

class Store extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('store', true);

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('store_model');
		$this->load->language('store');

		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('store'));

		$this->template->build('index');
	}

	public function category($slug = null)
	{
		if (empty($slug) || ! $this->store_model->find_category($slug))
		{
			show_404();
		}

		$category = $this->store_model->get_category($slug);

		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('store/' . $slug),
			'total_rows'  => $this->store_model->count_items($category->id),
			'per_page'    => 15,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'category' => $category,
			'items'    => $this->store_model->get_all_items($category->id, $config['per_page'], $offset),
			'links'    => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('store'));

		$this->template->build('category', $data);
	}

	public function item($id = null)
	{
		if (empty($id) || ! $this->store_model->find_item($id))
		{
			show_404();
		}

		$item = $this->store_model->get_item($id);

		$data = [
			'characters' => $this->realm->account_characters($item->realm_id, $this->session->userdata('id')),
			'item'       => $item
		];

		$this->template->title(config_item('app_name'), lang('store'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('guid', 'Character', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('qty', 'Quantity', 'trim|required|is_natural_no_zero');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('item', $data);
			}
			else
			{
				$this->cart->insert([
					'id'       => $id,
					'name'     => $item->name,
					'qty'      => $this->input->post('qty'),
					'dp'       => $item->dp,
					'vp'       => $item->vp,
					'realm'    => $item->realm_id,
					'guid'     => $this->input->post('guid'),
					'options'  => [
						'key'        => uniqid(),
						'price_type' => $item->price_type
					]
				]);

				$this->session->set_flashdata('success', lang('item_added'));
				redirect(site_url('store/item/' . $id));
			}
		}
		else
		{
			$this->template->build('item', $data);
		}
	}

	public function cart()
	{
		$data = [
			'contents' => $this->cart->contents()
		];

		$this->template->title(config_item('app_name'), lang('cart'));

		$this->template->build('cart', $data);
	}
 
	public function remove_item($id = null)
	{
		if (empty($id) || $this->input->method() != 'get')
		{
			show_404();
		}

		if ($this->cart->remove($id))
		{
			$this->session->set_flashdata('success', lang('item_deleted'));
			redirect(site_url('store/cart'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('item_error'));
			redirect(site_url('store/cart'));
		}
	}

	public function update_quantity()
	{
		if ($this->input->method() != 'post')
		{
			show_404();
		}

		$this->form_validation->set_rules('id', 'Id', 'trim|required');
		$this->form_validation->set_rules('qty', 'Quantity', 'trim|required|is_natural_no_zero');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('quantity_error'));
			redirect(site_url('store/cart'));
		}
		else
		{
			$this->cart->update([
				'rowid' => $this->input->post('id', TRUE),
				'qty'   => $this->input->post('qty')
			]);

			$this->session->set_flashdata('success', lang('quantity_updated'));
			redirect(site_url('store/cart'));
		}
	}

	public function checkout()
	{
		if ($this->input->method() != 'get')
		{
			show_404();
		}

		if ($this->cart->count_items() != $this->cart->valid_items())
		{
			$this->session->set_flashdata('warning', lang('checkout_selection'));
			redirect(site_url('store/cart'));
		}

		if (! $this->store_model->purchase())
		{
			$this->session->set_flashdata('error', lang('checkout_error'));
			redirect(site_url('store/cart'));
		}

		$this->session->set_flashdata('success', lang('checkout_success'));
		redirect(site_url('store/cart'));
	}
}
