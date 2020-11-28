<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

	public function article($id)
	{
		$this->load->model('forum/forum_model');

		if($this->website->getIsAdmin())
			$tiny = $this->base->tinyEditor('Admin');
		else
			$tiny = $this->base->tinyEditor('User');

		$data = array(
			'idlink' => $id,
			'pagetitle' => lang('tab_news'),
			'tiny' => $tiny
		);

		$this->template->build('article', $data);
	}

	public function reply()
	{
		if (!$this->website->isLogged())
			redirect(base_url(),'refresh');

		$ssesid = $this->session->userdata('id');
		$newsid = $this->input->post('news');
		$reply = $_POST['reply'];
		echo $this->news_model->insertComment($reply, $newsid, $ssesid);
	}

	public function deletereply()
	{
		if (!$this->website->isLogged())
			redirect(base_url(),'refresh');

		$id = $this->input->post('value');
		echo $this->news_model->removeComment($id);
	}
}
