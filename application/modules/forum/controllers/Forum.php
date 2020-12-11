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

class Forum extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('forum', true);

		$this->load->model('forum_model');
		$this->load->model('logs_model', 'logs');
	}

	public function index()
	{
		$this->template->title(config_item('app_name'), lang('tab_forum'));

		$this->template->build('index');
	}

	public function category($id = null)
	{
		if (empty($id))
		{
			show_404();
		}

		if($this->auth->is_admin())
			$tiny = $this->base->tinyEditor('Admin');
		else
			$tiny = $this->base->tinyEditor('User');

		$data = [
			'idlink' => $id,
			'tiny' => $tiny
		];

		$this->template->title(config_item('app_name'), lang('tab_forum'));

		$this->template->build('category', $data);
	}

	public function topic($id = null)
	{
		if (empty($id))
		{
			show_404();
		}

		if($this->auth->is_admin())
			$tiny = $this->base->tinyEditor('Admin');
		else
			$tiny = $this->base->tinyEditor('User');

		$data = [
			'idlink' => $id,
			'tiny' => $tiny
		];

		$this->template->title(config_item('app_name'), lang('tab_forum'));

		$this->template->build('topic', $data);
	}

	public function newtopic($idlink = null)
	{
		if (empty($idlink))
		{
			show_404();
		}

		if($this->auth->is_admin())
			$tiny = $this->base->tinyEditor('Admin');
		else
			$tiny = $this->base->tinyEditor('User');

		$data = [
			'idlink' => $idlink,
			'tiny' => $tiny
		];

		$this->template->title(config_item('app_name'), lang('tab_forum'));

		$this->template->build('new_topic', $data);
	}

	public function reply()
	{
		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$ssesid = $this->session->userdata('id');
		$topicid = $this->input->post('topic');
		$reply = $_POST['reply'];
		echo $this->forum_model->insertComment($reply, $topicid, $ssesid);
	}

	public function deletereply()
	{
		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$id = $this->input->post('value');
		echo $this->forum_model->removeComment($id);
	}

	public function addtopic()
	{
		if (!$this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$category = $this->input->post('category');
		$title = $this->input->post('title');
		$ssesid = $this->session->userdata('id');
		$description = $_POST['description'];
		echo $this->forum_model->insertTopic($category, $title, $ssesid, $description, '0', '0');
	}
}
