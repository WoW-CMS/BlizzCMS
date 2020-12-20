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

class News extends MX_Controller
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

		// Load callback
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		$this->load->model('news_model');
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
			'base_url'    => site_url('admin/news'),
			'total_rows'  => $this->news_model->count_all(),
			'per_page'    => 25,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'news'  => $this->news_model->get_all($config['per_page'], $offset),
			'links' => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('news/index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('image', 'Image', 'callback__image_required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('news/create');
			}
			else
			{
				$this->load->library('upload', [
					'upload_path'   => FCPATH . 'uploads/news/',
					'allowed_types' => 'jpg|jpeg|png',
					'max_size'      => 1024 * 5,
					'encrypt_name'  => TRUE
				]);

				if (! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('upload', $this->upload->display_errors('<li><i class="fas fa-times-circle"></i> ', '</li>'));
					redirect(site_url('admin/news/create'));
				}

				$uploaded = $this->upload->data();
				$img = $uploaded['file_name'];

				$this->db->insert('news', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image'       => $img,
					'created_at'  => now()
				]);

				$this->session->set_flashdata('success', lang('alert_news_created'));
				redirect(site_url('admin/news/create'));
			}
		}
		else
		{
			$this->template->build('news/create');
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->news_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'news' => $this->news_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('news/edit', $data);
			}
			else
			{
				if (isset($_FILES['image']['name']) && ! empty($_FILES['image']['name']))
				{
					$this->load->library('upload', [
						'upload_path'   => FCPATH . 'uploads/news/',
						'allowed_types' => 'jpg|jpeg|png',
						'max_size'      => 1024 * 5,
						'encrypt_name'  => TRUE
					]);

					if ($this->upload->do_upload('image'))
					{
						if (is_readable(FCPATH . 'uploads/news/' . $data['news']->image))
						{
							@unlink(FCPATH . 'uploads/news/' . $data['news']->image);
						}

						$uploaded = $this->upload->data();
						$img = $uploaded['file_name'];

						$this->db->where('id', $id)->update('news', ['image' => $img]);
					}
					else
					{
						$this->session->set_flashdata('upload', $this->upload->display_errors('<li><i class="fas fa-times-circle"></i> ', '</li>'));
						redirect(site_url('admin/news/edit/'.$id));
					}
				}

				$this->db->where('id', $id)->update('news', [
					'title'       => $this->input->post('title'),
					'description' => $this->input->post('description')
				]);

				$this->session->set_flashdata('success', lang('alert_news_updated'));
				redirect(site_url('admin/news/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('news/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->news_model->find_id($id))
		{
			show_404();
		}

		$news = $this->news_model->get($id);

		if (is_readable(FCPATH . 'uploads/news/' . $news->image))
		{
			@unlink(FCPATH . 'uploads/news/' . $news->image);
		}

		$this->db->where('id', $id)->delete('news');
		$this->db->where('news_id', $id)->delete('news_comments');

		$this->session->set_flashdata('success', lang('alert_news_deleted'));
		redirect(site_url('admin/news'));
	}

	/**
	 * Validate upload image
	 *
	 * @return bool
	 */
	public function _image_required()
	{
		if (isset($_FILES['image']['name']) && ! empty($_FILES['image']['name']))
		{
			return true;
		}

		$this->form_validation->set_message('_image_required', 'The {field} is required.');
		return false;
	}
}