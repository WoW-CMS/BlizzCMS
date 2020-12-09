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

		$config = [
			'base_url'    => site_url('news/' . $id),
			'total_rows'  => $this->base->count_news_comments($id),
			'per_page'    => 15,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$data = [
			'news'     => $this->base->get_news($id),
			'comments' => $this->base->get_news_comments($id, $config['per_page'], $page),
			'links'    => $this->pagination->create_links(),
			'aside'    => $this->base->get_news_list(),
			'tiny'     => $this->base->tinyEditor('User')
		];

		$this->template->title(config_item('app_name'), lang('tab_news'));

		$this->template->build('article', $data);
	}

	public function reply()
	{
		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->db->insert('news_comments', [
			'news_id'    => $this->input->post('news', TRUE),
			'user_id'    => $this->session->userdata('id'),
			'commentary' => $this->input->post('reply'),
			'created_at' => now()
		]);

		echo true;
	}

	public function deletereply()
	{
		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->db->where('id', $this->input->post('value', TRUE))->delete('news_comments');

		echo true;
	}
}