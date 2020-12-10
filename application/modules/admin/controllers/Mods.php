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

class Mods extends MX_Controller
{
	const EXCLUDE_MODULES = ['admin', 'user'];

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

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'mods' => $this->_get_modules()
		];

		$this->template->build('mods/index', $data);
	}

	public function install($module = null)
	{
		if (empty($module) || in_array($module, self::EXCLUDE_MODULES, true) || ! mod_exists($module) || mod_located($module))
		{
			show_404();
		}

		$this->load->library('migration');

		if ($this->migration->init_module($module))
		{
			if ($this->migration->current() === FALSE)
			{
				show_error($this->migration->error_string());
			}
		}

		$this->db->insert('modules', [
			'name' => $module
		]);

		$this->session->set_flashdata('success', lang('alert_module_installed'));
		redirect(site_url('admin/mods'));
	}

	public function uninstall($module = null)
	{
		if (empty($module) || in_array($module, self::EXCLUDE_MODULES, true) || ! mod_exists($module) || ! mod_located($module))
		{
			show_404();
		}

		$this->load->library('migration');

		if ($this->migration->init_module($module))
		{
			if ($this->migration->version(0) === FALSE)
			{
				show_error($this->migration->error_string());
			}
		}

		$this->db->where('name', $module)->delete('modules');

		$this->session->set_flashdata('success', lang('alert_module_uninstalled'));
		redirect(site_url('admin/mods'));
	}

	private function _get_modules()
	{
		$folders = directory_map(APPPATH.'modules', 1, false);
		$modules = [];

		foreach ($folders as $value)
		{
			$file = @file_get_contents(APPPATH . 'modules/' . $value . 'manifest.json');
			$name = stripslashes(trim($value, " /\t\n\r\0\x0B"));

			// If the json file does not exist in the module folder
			// or if the module name is inside the array (exclude names)
			// the module will not show in the list
			if (! $file || in_array($name, self::EXCLUDE_MODULES, true))
			{
				continue;
			}

			$json = json_decode($file, true);

			// Set keys if they don't exist in the array
			if (! array_key_exists('name', $json))
			{
				$json['name'] = ucfirst($name);
			}

			if (! array_key_exists('description', $json))
			{
				$json['description'] = '';
			}

			if (! array_key_exists('author', $json))
			{
				$json['author'] = lang('unknown');
			}

			if (! array_key_exists('website', $json))
			{
				$json['website'] = '';
			}

			if (! array_key_exists('version', $json))
			{
				$json['version'] = '0.1';
			}

			if (! array_key_exists('panel', $json))
			{
				$json['panel'] = [
					'enabled' => false,
					'route' => ''
				];
			}

			$modules[$name] = $json;
		}

		return $modules;
	}
}