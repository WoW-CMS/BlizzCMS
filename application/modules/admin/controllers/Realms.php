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

class Realms extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin())
		{
			redirect(site_url('user'));
		}

		if ($this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('realms_model');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'realms' => $this->realms_model->get_all()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('realms/index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('max_cap', 'Max Capacity', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('char_host', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('char_user', 'Username', 'trim|required|alpha_dash|max_length[32]');
			$this->form_validation->set_rules('char_pass', 'Password', 'trim|required|max_length[32]');
			$this->form_validation->set_rules('char_db', 'Database', 'trim|required|alpha_dash|max_length[64]');
			$this->form_validation->set_rules('char_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('console_host', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('console_user', 'Username', 'trim|required');
			$this->form_validation->set_rules('console_pass', 'Password', 'trim|required');
			$this->form_validation->set_rules('console_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('realm_host', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('realm_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('realms/create');
			}
			else
			{
				$this->db->insert('realms', [
					'name'             => $this->input->post('name', TRUE),
					'max_cap'          => $this->input->post('max_cap'),
					'char_hostname'    => $this->input->post('char_host'),
					'char_username'    => $this->input->post('char_user'),
					'char_password'    => $this->input->post('char_pass'),
					'char_database'    => $this->input->post('char_db'),
					'char_port'        => $this->input->post('char_port'),
					'console_hostname' => $this->input->post('console_host'),
					'console_username' => $this->input->post('console_user'),
					'console_password' => $this->input->post('console_pass'),
					'console_port'     => $this->input->post('console_port'),
					'realm_hostname'   => $this->input->post('realm_host'),
					'realm_port'       => $this->input->post('realm_port')
				]);

				$this->session->set_flashdata('success', lang('alert_realm_created'));
				redirect(site_url('admin/realms/create'));
			}
		}
		else
		{
			$this->template->build('realms/create');
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->realms_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'realm' => $this->realms_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('max_cap', 'Maximum capacity', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('char_host', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('char_user', 'Username', 'trim|required|alpha_dash|max_length[32]');
			$this->form_validation->set_rules('char_pass', 'Password', 'trim|required|max_length[32]');
			$this->form_validation->set_rules('char_db', 'Database', 'trim|required|alpha_dash|max_length[64]');
			$this->form_validation->set_rules('char_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('console_host', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('console_user', 'Username', 'trim|required');
			$this->form_validation->set_rules('console_pass', 'Password', 'trim|required');
			$this->form_validation->set_rules('console_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');
			$this->form_validation->set_rules('realm_host', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('realm_port', 'Port', 'trim|required|numeric|less_than_equal_to[65535]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('realms/edit', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('realms', [
					'name'             => $this->input->post('name', TRUE),
					'max_cap'          => $this->input->post('max_cap'),
					'char_hostname'    => $this->input->post('char_host'),
					'char_username'    => $this->input->post('char_user'),
					'char_password'    => $this->input->post('char_pass'),
					'char_database'    => $this->input->post('char_db'),
					'char_port'        => $this->input->post('char_port'),
					'console_hostname' => $this->input->post('console_host'),
					'console_username' => $this->input->post('console_user'),
					'console_password' => $this->input->post('console_pass'),
					'console_port'     => $this->input->post('console_port'),
					'realm_hostname'   => $this->input->post('realm_host'),
					'realm_port'       => $this->input->post('realm_port')
				]);

				$this->session->set_flashdata('success', lang('alert_realm_updated'));
				redirect(site_url('admin/realms/edit/' . $id));
			}
		}
		else
		{
			$this->template->build('realms/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->realms_model->find_id($id))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('realms');

		$this->session->set_flashdata('success', lang('alert_realm_deleted'));
		redirect(site_url('admin/realms'));
	}

	public function check($id = null)
	{
		if (empty($id) || ! $this->realms_model->find_id($id))
		{
			show_404();
		}

		// $this->realm->send_command($id, '.server info');
	}
}