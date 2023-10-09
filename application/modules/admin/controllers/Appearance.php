<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Appearance extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('view.appearance');
    }

    public function index()
    {
        $data = [
            'themes' => $this->_get_themes()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('appearance/index', $data);
    }

    /**
     * Activate theme
     *
     * @param string $name
     * @return void
     */
    public function activate($name = null)
    {
        require_permission('activate.themes');

        if (empty($name)) {
            show_404();
        }

        $theme = $this->_get_themes($name);

        if ($theme === []) {
            $this->session->set_flashdata('error', lang('alert_theme_not_found'));
            redirect(site_url('admin/appearance'));
        }

        if (config_item('app_theme') === $name) {
            $this->session->set_flashdata('error', lang_vars('alert_theme_already_activated', [$theme['name']]));
            redirect(site_url('admin/appearance'));
        }

        $this->setting_model->update([
            'value' => $name
        ], ['key' => 'app_theme']);

        $this->log_model->create('theme', 'activate', 'Activated a theme', [
            'theme' => $name
        ]);

        $this->cache->clean();

        $this->session->set_flashdata('success', lang_vars('alert_theme_setted', [$name]));
        redirect(site_url('admin/appearance'));
    }

    /**
     * Deactivate current theme
     *
     * @return void
     */
    public function deactivate()
    {
        require_permission('deactivate.themes');

        if (config_item('app_theme') === null) {
            $this->session->set_flashdata('error', lang('alert_theme_unable_find_active'));
            redirect(site_url('admin/appearance'));
        }

        $this->setting_model->update([
            'value' => null
        ], ['key' => 'app_theme']);

        $this->log_model->create('theme', 'restore', 'Deactivated the current theme');

        $this->cache->clean();

        $this->session->set_flashdata('success', lang('alert_theme_deactivated'));
        redirect(site_url('admin/appearance'));
    }

    /**
     * Delete theme
     *
     * @param string $name
     * @return void
     */
    public function delete($name = null)
    {
        require_permission('delete.themes');

        if (empty($name)) {
            show_404();
        }

        $theme    = $this->_get_themes($name);
        $location = APPPATH . "themes/{$name}/";

        if ($theme === []) {
            $this->session->set_flashdata('error', lang('alert_theme_not_found'));
            redirect(site_url('admin/appearance'));
        }

        if (config_item('app_theme') === $name) {
            $this->session->set_flashdata('error', lang('alert_theme_not_activated_required'));
            redirect(site_url('admin/appearance'));
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($location, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }

        rmdir($location);

        $this->log_model->create('theme', 'delete', 'Deleted a theme', [
            'theme' => $name
        ]);

        $this->session->set_flashdata('success', lang_vars('alert_theme_deleted', [$name]));
        redirect(site_url('admin/appearance'));
    }

    public function upload()
    {
        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->form_validation->set_rules('file', lang('file'), 'callback__file_required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->load->library('upload', [
                'upload_path'   => APPPATH . 'themes',
                'allowed_types' => 'zip'
            ]);

            if (! $this->upload->do_upload('file')) {
                $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                redirect(site_url('admin/appearance/upload'));
            }

            $uploadData  = $this->upload->data();
            $themeFolder = APPPATH . 'themes/' . $uploadData['raw_name'];
            $zipFile     = APPPATH . 'themes/' . $uploadData['file_name'];

            if (is_dir($themeFolder)) {
                unlink($zipFile);

                $this->session->set_flashdata('error', lang('alert_zip_name_matched'));
                redirect(site_url('admin/appearance/upload'));
            }

            $zip = new \ZipArchive();

            if ($zip->open($zipFile) !== true) {
                unlink($zipFile);

                $this->session->set_flashdata('error', lang('alert_zip_cant_uncompressed'));
                redirect(site_url('admin/appearance/upload'));
            }

            if ($zip->locateName('theme.php') === false) {
                $zip->close();

                unlink($zipFile);

                $this->session->set_flashdata('error', lang('alert_zip_not_theme_config'));
                redirect(site_url('admin/appearance/upload'));
            }

            mkdir($themeFolder, 0755);

            $zip->extractTo($themeFolder);
            $zip->close();

            unlink($zipFile);

            $this->session->set_flashdata('success', lang('alert_zip_uncompressed'));
            redirect(site_url('admin/appearance/upload'));
        } else {
            $this->template->build('appearance/upload');
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
     * Get themes information
     *
     * @param string|null $name
     * @return array
     */
    private function _get_themes($name = null)
    {
        $location = APPPATH . 'themes/';
        $files    = directory_map($location, 1);
        $themes   = [];

        foreach ($files as $file) {
            if (! is_dir($location . $file)) {
                continue;
            }

            $config = realpath($location . $file . 'theme.php');
            $folder = trim(str_replace('/', '', stripslashes($file)));

            // If the config file does not exist in the theme folder
            // it will not be shown in the list
            if (! is_file($config)) {
                continue;
            }

            $data = require $config;

            if (! is_array($data)) {
                continue;
            }

            $data['active'] = $folder === config_item('app_theme');

            $themes[$folder] = $data;
        }

        if ($name !== null) {
            if (array_key_exists($name, $themes)) {
                return $themes[$name];
            }

            return [];
        }

        return $themes;
    }
}
