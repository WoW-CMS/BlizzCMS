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

class Vote extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		mod_located('vote', true);

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		$this->load->model('vote_model');
	}

	public function index()
	{
		$data = [
			'topsites' => $this->vote_model->get_all()
		];

		$this->template->title(config_item('app_name'), lang('tab_vote'));

		$this->template->build('index', $data);
	}

	public function site($id = null)
	{
		if (empty($id) || ! $this->vote_model->find_topsite($id))
		{
			show_404();
		}

		if ($this->vote_model->get_expiration($id) >= now())
		{
			$this->session->set_flashdata('error', lang('alert_already_voted'));
			redirect(site_url('vote'));
		}

		$topsite = $this->vote_model->get_topsite($id);
		$user    = $this->website->get_user();

		// Calculate expired_at
		$date     = new \DateTime();
		$new_date = $date->add(new \DateInterval('PT' . $topsite->time . 'H'));

		$this->db->where('id', $user->id)->update('users', ['vp' => ($topsite->points + $user->vp)]);

		$this->db->insert('topsites_logs', [
			'topsite_id' => $id,
			'user_id'    => $user->id,
			'points'     => $topsite->points,
			'created_at' => now(),
			'expired_at' => $new_date->getTimestamp()
		]);

		redirect($topsite->url);
	}
}
