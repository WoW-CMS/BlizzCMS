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

		if(!$this->wowgeneral->getMaintenance())
			redirect(base_url('maintenance'),'refresh');

		if (!$this->wowmodule->getNewsStatus())
			redirect(base_url(),'refresh');
	}

	public function article($id)
	{
		$this->load->model('forum/forum_model');

		if($this->wowauth->getIsAdmin())
			$tiny = $this->wowgeneral->tinyEditor('Admin');
		else
			$tiny = $this->wowgeneral->tinyEditor('User');

		$data = array(
			'idlink' => $id,
			'pagetitle' => lang('tab_news'),
			'lang' => $this->lang->lang(),
			'tiny' => $tiny
		);

		$this->template->build('article', $data);
	}

	public function reply()
	{
		if (!$this->wowauth->isLogged())
			redirect(base_url(),'refresh');

		$ssesid = $this->session->userdata('wow_sess_id');
		$newsid = $this->input->post('news');
		$reply = $_POST['reply'];
		echo $this->news_model->insertComment($reply, $newsid, $ssesid);
	}

	public function deletereply()
	{
		if (!$this->wowauth->isLogged())
			redirect(base_url(),'refresh');

		$id = $this->input->post('value');
		echo $this->news_model->removeComment($id);
	}
}
