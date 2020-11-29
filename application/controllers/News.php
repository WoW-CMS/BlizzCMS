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
	public function index($id)
	{
		if (empty($id) || ! $this->base->find_news($id))
		{
			show_404();
		}

		$config = [
			'base_url'    => site_url('news/' . $id),
			'total_rows'  => $this->base->count_news_comments($id),
			'per_page'    => 10,
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
			redirect(base_url(),'refresh');

		$this->db->insert('news_comments', [
			'id_new'     => $this->input->post('news', TRUE),
			'commentary' => $this->input->post('reply'),
			'date'       => now(),
			'author'     => $this->session->userdata('id')
		]);

		echo true;
	}

	public function deletereply()
	{
		if (! $this->website->isLogged())
			redirect(base_url(),'refresh');

		$this->db->where('id', $this->input->post('value', TRUE))->delete('news_comments');

		echo true;
	}
}