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

class Forum extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('forum', true);

		$this->load->model('forum_model');
		$this->load->language('forum');

		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'categories' => $this->forum_model->get_all_forums(0, 'category')
		];

		$this->template->title(config_item('app_name'), lang('forum'));

		$this->template->build('index', $data);
	}

	public function forum($id = null)
	{
		if (empty($id) || ! $this->forum_model->find_forum($id, 'forum'))
		{
			show_404();
		}

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('forum/view/' . $id),
			'total_rows'  => $this->forum_model->count_topics($id),
			'per_page'    => 15,
			'uri_segment' => 4
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'forum'     => $this->forum_model->get_forum($id),
			'subforums' => $this->forum_model->get_all_forums($id, 'forum'),
			'topics'    => $this->forum_model->get_all_topics($id, $config['per_page'], $offset),
			'links'     => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('forum'));

		$this->template->build('forum', $data);
	}

	public function topic($id = null)
	{
		if (empty($id) || ! $this->forum_model->find_topic($id))
		{
			show_404();
		}

		$get = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('forum/topic/' . $id),
			'total_rows'  => $this->forum_model->count_posts($id),
			'per_page'    => 15,
			'uri_segment' => 4
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'topic' => $this->forum_model->get_topic($id),
			'posts' => $this->forum_model->get_all_posts($id, $config['per_page'], $offset),
			'links' => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('forum'));

		$this->template->build('topic', $data);
	}

	public function create_topic($forum = null)
	{
		if (empty($forum))
		{
			show_404();
		}

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$data = [
			'id' => $forum
		];

		$this->template->title(config_item('app_name'), lang('forum'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('create_topic', $data);
			}
			else
			{
				$this->db->insert('forum_topics', [
					'forum_id'    => $forum,
					'user_id'     => $this->session->userdata('id'),
					'title'       => $this->input->post('title', TRUE),
					'description' => $this->input->post('description'),
					'created_at'  => now()
				]);

				$this->session->set_flashdata('success', lang('topic_created'));
				redirect(site_url('forum/view/'.$forum));
			}
		}
		else
		{
			$this->template->build('create_topic', $data);
		}
	}

	public function create_post()
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
			redirect(site_url('forum/topic/' . $id));
		}
		else
		{
			$id    = $this->input->post('id', TRUE);
			$topic = $this->forum_model->get_topic($id);

			$this->db->insert('forum_posts', [
				'topic_id'   => $id,
				'forum_id'   => $topic->forum_id,
				'user_id'    => $this->session->userdata('id'),
				'commentary' => $this->input->post('comment'),
				'created_at' => now()
			]);

			$this->session->set_flashdata('success', lang('post_sended'));
			redirect(site_url('forum/topic/' . $id));
		}
	}

	public function edit_topic($id = null)
	{
		if (empty($id) || ! $this->forum_model->find_topic($id))
		{
			show_404();
		}

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$topic = $this->forum_model->get_topic($id);

		if (! $this->auth->is_moderator() && $this->session->userdata('id') != $topic->user_id)
		{
			$this->session->set_flashdata('error', lang('permission_denied'));
			redirect(site_url('forum/topic/' . $topic->id));
		}

		$data = [
			'topic' => $topic
		];

		$this->template->title(config_item('app_name'), lang('forum'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('edit_topic', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('forum_topics', [
					'title'       => $this->input->post('title', TRUE),
					'description' => $this->input->post('description'),
					'updated_at'  => now()
				]);

				$this->session->set_flashdata('success', lang('topic_updated'));
				redirect(site_url('forum/topic/'.$id));
			}
		}
		else
		{
			$this->template->build('edit_topic', $data);
		}
	}

	public function delete_post($id = null)
	{
		if (empty($id) || $this->forum_model->find_post($id))
		{
			show_404();
		}

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$post = $this->forum_model->get_post($id);

		if ($this->auth->is_moderator() || $this->session->userdata('id') == $post->user_id && now() < strtotime('+30 minutes', $post->created_at))
		{
			$this->db->where('id', $id)->delete('forum_posts');

			$this->session->set_flashdata('success', lang('post_deleted'));
			redirect(site_url('forum/topic/' . $post->topic_id));
		}

		$this->session->set_flashdata('error', lang('permission_denied'));
		redirect(site_url('forum/topic/' . $post->topic_id));
	}
}
