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

class Home extends CI_Controller
{
	public function index()
	{
		if (config_item('migrate_status') == '1')
		{
			$this->load->view('migrate');
		}
		else
		{
			$data = [
				'articles' => [], // $this->news_model->getNewsList()->result()
				'realms'   => $this->realm->getRealms()->result()
			];

			$this->template->title(config_item('app_name'));

			$this->template->build('home', $data);
		}
	}

	public function migrateNow()
	{
		$this->load->library('migration');

		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
		}

		redirect(base_url());
	}

	public function setconfig()
	{
		$this->load->library('config_writer');

		$blizz = $this->config_writer->get_instance(APPPATH.'config/blizzcms.php', 'config');
		$plus = $this->config_writer->get_instance(APPPATH.'config/plus.php', 'config');

		$blizz->write('website_name', $this->input->post('name'));
		$blizz->write('discord_invitation', $this->input->post('invitation'));
		$blizz->write('realmlist', $this->input->post('realmlist'));
		$blizz->write('expansion', $this->input->post('expansion'));
		$blizz->write('migrate_status', '0');
		echo true;
	}
}