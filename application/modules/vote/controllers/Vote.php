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

class Vote extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vote_model');

		if (!$this->wowgeneral->getMaintenance())
			redirect(base_url('maintenance'),'refresh');

		if (!$this->wowmodule->getVoteStatus())
			redirect(base_url(),'refresh');

		if (!$this->wowauth->isLogged())
			redirect(base_url('login'),'refresh');
	}

	public function index()
	{
		$data = array(
			'pagetitle' => lang('tab_vote'),
			'voteList' => $this->vote_model->getVotes(),
		);

		$this->template->build('index', $data);
	}

	public function voteNow($id)
	{
		echo $this->vote_model->voteNow($id);
	}

	public function voteNowCount()
	{
		$id = $this->input->post('value', TRUE);
		$seconds = $this->vote_model->getVoteTime($id);
		echo $this->vote_model->getCountDownHTML($id, $seconds);
	}

	public function voteCallURL()
	{
		$id = $this->input->post('value', TRUE);
		echo $this->vote_model->getVoteUrl($id);
	}
}
