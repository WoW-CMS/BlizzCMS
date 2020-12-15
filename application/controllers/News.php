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

class News extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($id = null)
	{
		if (empty($id) || ! $this->base->find_news($id))
		{
			show_404();
		}

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('news/' . $id),
			'total_rows'  => $this->base->count_news_comments($id),
			'per_page'    => 15,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'news'     => $this->base->get_news($id),
			'comments' => $this->base->get_news_comments($id, $config['per_page'], $offset),
			'links'    => $this->pagination->create_links(),
			'aside'    => $this->base->get_news_list(),
			'tiny'     => $this->base->tinyEditor('User')
		];

		$this->template->title(config_item('app_name'), lang('tab_news'));

		$this->template->build('article', $data);
	}

	public function reply()
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
			redirect(site_url('news/' . $id));
		}
		else
		{
			$id = $this->input->post('id', TRUE);

			$this->db->insert('news_comments', [
				'news_id'    => $id,
				'user_id'    => $this->session->userdata('id'),
				'commentary' => $this->input->post('comment'),
				'created_at' => now()
			]);

			$this->session->set_flashdata('success', lang('alert_reply_created'));
			redirect(site_url('news/' . $id));
		}
	}

	public function delete_reply($id = null)
	{
		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->db->where('id', $id)->delete('news_comments');

		$this->session->set_flashdata('success', lang('alert_reply_deleted'));
		redirect(site_url('news/' . $id));
	}
}