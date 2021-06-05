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

class Mods extends MX_Controller
{
	const EXCLUDE_NAMES = ['CI_Core', 'admin'];

	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin() || $this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		// Load callback
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		$this->load->language('admin');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$data = [
			'mods' => $this->_get_mods()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('mods/index', $data);
	}

	public function install($name = null)
	{
		if (empty($name) || in_array($name, self::EXCLUDE_NAMES, true) || ! mod_exists($name) || mod_located($name))
		{
			show_404();
		}

		$this->load->library('migration');

		if ($this->migration->init_module($name))
		{
			if ($this->migration->current() === FALSE)
			{
				show_error($this->migration->error_string());
			}
		}

		$this->db->insert('modules', [
			'module' => $name
		]);

		// Clear cache
		$this->cache->file->clean();

		$this->session->set_flashdata('success', lang_vars('module_installed', [$name]));
		redirect(site_url('admin/mods'));
	}

	public function uninstall($name = null)
	{
		if (empty($name) || in_array($name, self::EXCLUDE_NAMES, true) || ! mod_exists($name) || ! mod_located($name))
		{
			show_404();
		}

		$this->load->library('migration');

		if ($this->migration->init_module($name))
		{
			if ($this->migration->version(0) === FALSE)
			{
				show_error($this->migration->error_string());
			}
		}

		$this->db->where('module', $name)->delete('migrations');
		$this->db->where('module', $name)->delete('modules');

		// Clear cache
		$this->cache->file->clean();

		$this->session->set_flashdata('success', lang_vars('module_uninstalled', [$name]));
		redirect(site_url('admin/mods'));
	}

	public function delete($name = null)
	{
		if (empty($name) || in_array($name, self::EXCLUDE_NAMES, true) || ! mod_exists($name) || mod_located($name))
		{
			show_404();
		}

		$path = APPPATH . "modules/{$name}/";

		$files  = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS),
			\RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ($files as $file)
		{ 
			$file->isDir() ? rmdir($file) : unlink($file);
		}

		rmdir($path);

		$this->session->set_flashdata('success', lang_vars('module_deleted', [$name]));
		redirect(site_url('admin/mods'));
	}

	public function update($name = null)
	{
		if (empty($name) || in_array($name, self::EXCLUDE_NAMES, true) || ! mod_exists($name) || ! mod_located($name))
		{
			show_404();
		}

		$this->load->library('migration');

		if ($this->migration->init_module($name))
		{
			if ($this->migration->current() === FALSE)
			{
				show_error($this->migration->error_string());
			}
		}

		// Clear cache
		$this->cache->file->clean();

		$this->session->set_flashdata('success', lang_vars('module_updated', [$name]));
		redirect(site_url('admin/mods'));
	}

	public function upload()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('file', 'File', 'callback__file_required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('mods/upload');
			}
			else
			{
				$this->load->library('upload', [
					'upload_path'   => APPPATH . 'modules/',
					'allowed_types' => 'zip'
				]);

				if (! $this->upload->do_upload('file'))
				{
					$this->session->set_flashdata('upload', $this->upload->display_errors('<li><i class="fas fa-times-circle"></i> ', '</li>'));
					redirect(site_url('admin/mods/upload'));
				}

				$uploaded  = $this->upload->data();
				$directory = APPPATH . "modules/{$uploaded['raw_name']}";
				$file      = APPPATH . "modules/{$uploaded['file_name']}";

				if (is_dir($directory))
				{
					unlink($file);

					$this->session->set_flashdata('error', lang('file_name_match'));
					redirect(site_url('admin/mods/upload'));
				}

				$zip    = new \ZipArchive();
				$opened = $zip->open($file);

				if ($opened === TRUE)
				{
					$zip->extractTo(APPPATH . 'modules/');
					$zip->close();

					$this->session->set_flashdata('success', lang('file_uploaded'));
				}
				else
				{
					$this->session->set_flashdata('error', zip_status($opened));
				}

				unlink($file);

				redirect(site_url('admin/mods/upload'));
			}
		}
		else
		{
			$this->template->build('mods/upload');
		}
	}

	/**
	 * Validate upload file
	 *
	 * @return bool
	 */
	public function _file_required()
	{
		if (isset($_FILES['file']['name']) && ! empty($_FILES['file']['name']))
		{
			return true;
		}

		$this->form_validation->set_message('_file_required', 'The {field} is required.');
		return false;
	}

	/**
	 * Get modules information
	 *
	 * @param string|null $name
	 * @return array
	 */
	private function _get_mods($name = null)
	{
		$folders = directory_map(APPPATH.'modules', 1, false);
		$modules = [];

		foreach ($folders as $folder)
		{
			$config = APPPATH . "modules/{$folder}/config/module.php";
			$module = stripslashes(trim($folder, " /\t\n\r\0\x0B"));

			// If the file does not exist in the config folder of a module
			// or if the module is in the exclude names will not show in the list
			if (! file_exists($config) || in_array($module, self::EXCLUDE_NAMES, true))
			{
				continue;
			}

			$modules[$module] = require $config;
		}

		if (! is_null($name) && array_key_exists($name, $modules))
		{
			return $modules[$name];
		}

		return $modules;
	}
}