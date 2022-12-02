<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('view.modules');

        $this->load->library('migration');
    }

    public function index()
    {
        $data = [
            'modules' => $this->_get_modules()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('modules/index', $data);
    }

    /**
     * Install module
     *
     * @param string $name
     * @return void
     */
    public function install($name = null)
    {
        require_permission('install.modules');

        if (empty($name) || in_array($name, Module_model::RESERVED_NAMES, true)) {
            show_404();
        }

        $module = $this->_get_modules($name);

        if ($module === []) {
            $this->session->set_flashdata('error', lang('alert_module_not_found'));
            redirect(site_url('admin/modules'));
        }

        if (is_module_installed($name)) {
            $this->session->set_flashdata('error', lang_vars('alert_module_already_installed', [$module['name']]));
            redirect(site_url('admin/modules'));
        }

        if ($this->migration->init_module($name)) {
            if ($this->migration->current() === false) {
                show_error($this->migration->error_string());
            }
        }

        $this->module_model->insert([
            'module'  => $name,
            'version' => $module['version']
        ]);

        $this->log_model->create('module', 'install', 'Installed a module', [
            'module' => $name
        ]);

        $this->cache->clean();

        $this->session->set_flashdata('success', lang_vars('alert_module_installed', [$module['name']]));
        redirect(site_url('admin/modules'));
    }

    /**
     * Uninstall module
     *
     * @param string $name
     * @return void
     */
    public function uninstall($name = null)
    {
        require_permission('uninstall.modules');

        if (empty($name) || in_array($name, Module_model::RESERVED_NAMES, true)) {
            show_404();
        }

        $module = $this->_get_modules($name);

        if ($module === []) {
            $this->session->set_flashdata('error', lang('alert_module_not_found'));
            redirect(site_url('admin/modules'));
        }

        if (! is_module_installed($name)) {
            $this->session->set_flashdata('error', lang('alert_module_installed_required'));
            redirect(site_url('admin/modules'));
        }

        if ($this->migration->init_module($name)) {
            if ($this->migration->version(0) === false) {
                show_error($this->migration->error_string());
            }
        }

        $this->db->where('module', $name)->delete('migrations');
        $this->module_model->delete(['module' => $name]);

        $this->log_model->create('module', 'uninstall', 'Uninstalled a module', [
            'module' => $name
        ]);

        $this->cache->clean();

        $this->session->set_flashdata('success', lang_vars('alert_module_uninstalled', [$module['name']]));
        redirect(site_url('admin/modules'));
    }

    /**
     * Delete module
     *
     * @param string $name
     * @return void
     */
    public function delete($name = null)
    {
        require_permission('delete.modules');

        if (empty($name) || in_array($name, Module_model::RESERVED_NAMES, true)) {
            show_404();
        }

        $module   = $this->_get_modules($name);
        $location = APPPATH . "modules/{$name}/";

        if ($module === []) {
            $this->session->set_flashdata('error', lang('alert_module_not_found'));
            redirect(site_url('admin/modules'));
        }

        if (is_module_installed($name)) {
            $this->session->set_flashdata('error', lang('alert_module_uninstalled_required'));
            redirect(site_url('admin/modules'));
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($location, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }

        rmdir($location);

        $this->log_model->create('module', 'delete', 'Deleted a module', [
            'module' => $name
        ]);

        $this->session->set_flashdata('success', lang_vars('alert_module_deleted', [$module['name']]));
        redirect(site_url('admin/modules'));
    }

    /**
     * Force module migrations
     *
     * @param string $name
     * @return void
     */
    public function force($name = null)
    {
        require_permission('migrations.modules');

        if (empty($name) || in_array($name, Module_model::RESERVED_NAMES, true)) {
            show_404();
        }

        $module = $this->_get_modules($name);

        if ($module === []) {
            $this->session->set_flashdata('error', lang('alert_module_not_found'));
            redirect(site_url('admin/modules'));
        }

        if (! is_module_installed($name)) {
            $this->session->set_flashdata('error', lang('alert_module_installed_required'));
            redirect(site_url('admin/modules'));
        }

        if (! $this->migration->init_module($name)) {
            $this->session->set_flashdata('error', lang_vars('alert_module_no_migration_config', [$module['name']]));
            redirect(site_url('admin/modules'));
        }

        $this->config->load('migration', true, false, $name);

        $current = $this->migration->module_version($name);
        $target  = $this->config->item('migration_version', 'migration');

        if ($target <= $current) {
            $this->session->set_flashdata('info', lang_vars('alert_module_no_pending_migration', [$module['name']]));
            redirect(site_url('admin/modules'));
        }

        if ($this->migration->current() === false) {
            show_error($this->migration->error_string());
        }

        $this->cache->clean();

        $this->session->set_flashdata('success', lang_vars('alert_module_migration_processed', [$module['name']]));
        redirect(site_url('admin/modules'));
    }

    public function upload()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('file', lang('file'), 'callback__file_required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->load->library('upload', [
                'upload_path'   => APPPATH . 'modules',
                'allowed_types' => 'zip'
            ]);

            if (! $this->upload->do_upload('file')) {
                $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                redirect(site_url('admin/modules/upload'));
            }

            $uploadData   = $this->upload->data();
            $moduleFolder = APPPATH . 'modules/' . $uploadData['raw_name'];
            $zipFile      = APPPATH . 'modules/' . $uploadData['file_name'];

            if (is_dir($moduleFolder)) {
                unlink($zipFile);

                $this->session->set_flashdata('error', lang('alert_zip_name_matched'));
                redirect(site_url('admin/modules/upload'));
            }

            $zip = new \ZipArchive();

            if ($zip->open($zipFile) !== true) {
                unlink($zipFile);

                $this->session->set_flashdata('error', lang('alert_zip_cant_uncompressed'));
                redirect(site_url('admin/modules/upload'));
            }

            if ($zip->locateName('config/module.php') === false) {
                $zip->close();

                unlink($zipFile);

                $this->session->set_flashdata('error', lang('alert_zip_not_module_config'));
                redirect(site_url('admin/modules/upload'));
            }

            mkdir($moduleFolder, 0755);

            $zip->extractTo($moduleFolder);
            $zip->close();

            unlink($zipFile);

            $this->session->set_flashdata('success', lang('alert_zip_uncompressed'));
            redirect(site_url('admin/modules/upload'));
        } else {
            $this->template->build('modules/upload');
        }
    }

    /**
     * Validate upload file
     *
     * @return bool
     */
    public function _file_required()
    {
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
            return true;
        }

        $this->form_validation->set_message('_file_required', lang('form_validation_file_required'));
        return false;
    }

    /**
     * Get modules information
     *
     * @param string|null $name
     * @return array
     */
    private function _get_modules($name = null)
    {
        $location = APPPATH . 'modules/';
        $files    = directory_map($location, 1);
        $modules  = [];

        foreach ($files as $file) {
            if (! is_dir($location . $file)) {
                continue;
            }

            $config = realpath($location . $file . 'config/module.php');
            $folder = trim(str_replace('/', '', stripslashes($file)));

            // If the config file does not exist in the module folder
            // or if the module is in the reserved names it will not show in the list
            if (! is_file($config) || in_array($folder, Module_model::RESERVED_NAMES, true)) {
                continue;
            }

            $data = require $config;

            if (! is_array($data)) {
                continue;
            }

            $data['installed'] = is_module_installed($folder);

            $modules[$folder] = $data;
        }

        if ($name !== null) {
            if (array_key_exists($name, $modules)) {
                return $modules[$name];
            }

            return [];
        }

        return $modules;
    }
}
