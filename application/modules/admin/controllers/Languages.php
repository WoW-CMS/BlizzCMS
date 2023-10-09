<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('view.appearance');
    }

    public function index()
    {
        $data = [
            'languages' => $this->_get_languages()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('languages/index', $data);
    }

    /**
     * Add language
     *
     * @param string $name
     * @return void
     */
    public function add($name = null)
    {
        if (empty($name)) {
            show_404();
        }

        $language = $this->_get_languages($name);

        if ($language === []) {
            $this->session->set_flashdata('error', lang('alert_language_not_found'));
            redirect(site_url('admin/languages'));
        }

        $supportedLangs = is_json(config_item('app_supported_languages')) ? json_decode(config_item('app_supported_languages')) : [];

        if (config_item('app_language') === $name || in_array($name, $supportedLangs, true)) {
            $this->session->set_flashdata('warning', lang_vars('alert_language_already_added', [$name]));
            redirect(site_url('admin/languages'));
        }

        $supportedLangs[] = $name;
        sort($supportedLangs, SORT_NATURAL | SORT_FLAG_CASE);

        $this->setting_model->update([
            'value' => json_encode($supportedLangs)
        ], ['key' => 'app_supported_languages']);

        $this->log_model->create('language', 'add', 'Added a language', [
            'language' => $name
        ]);

        $this->cache->delete('settings');

        $this->session->set_flashdata('success', lang_vars('alert_language_added', [$name]));
        redirect(site_url('admin/languages'));
    }

    /**
     * Delete language
     *
     * @param string $name
     * @return void
     */
    public function delete($name = null)
    {
        if (empty($name)) {
            show_404();
        }

        $language = $this->_get_languages($name);

        if ($language === []) {
            $this->session->set_flashdata('error', lang('alert_language_not_found'));
            redirect(site_url('admin/languages'));
        }

        if (config_item('app_language') === $name) {
            $this->session->set_flashdata('error', lang('alert_language_default_not_deleted'));
            redirect(site_url('admin/languages'));
        }

        $supportedLangs = is_json(config_item('app_supported_languages')) ? json_decode(config_item('app_supported_languages')) : [];

        if (! in_array($name, $supportedLangs, true)) {
            $this->session->set_flashdata('error', lang('alert_language_not_found'));
            redirect(site_url('admin/languages'));
        }

        $diff = array_diff($supportedLangs, [$name]);
        sort($diff, SORT_NATURAL | SORT_FLAG_CASE);

        $this->setting_model->update([
            'value' => json_encode($diff)
        ], ['key' => 'app_supported_languages']);

        if ($this->session->userdata('language') === $name) {
            $this->session->set_userdata('language', config_item('app_language'));
        }

        $this->log_model->create('language', 'delete', 'Deleted a language', [
            'language' => $name
        ]);

        $this->cache->delete('settings');

        $this->session->set_flashdata('success', lang_vars('alert_language_deleted', [$name]));
        redirect(site_url('admin/languages'));
    }

    /**
     * Set default language
     *
     * @param string $name
     * @return void
     */
    public function set($name = null)
    {
        if (empty($name)) {
            show_404();
        }

        $language = $this->_get_languages($name);

        if ($language === []) {
            $this->session->set_flashdata('error', lang('alert_language_not_found'));
            redirect(site_url('admin/languages'));
        }

        if (config_item('app_language') === $name) {
            $this->session->set_flashdata('error', lang('alert_language_already_default'));
            redirect(site_url('admin/languages'));
        }

        $this->load->library('config_writer');

        $configWriter = $this->config_writer->get_instance();
        $configWriter->write('language', $name);

        $supportedLangs = is_json(config_item('app_supported_languages')) ? json_decode(config_item('app_supported_languages')) : [];
        $supportedLangs[] = config_item('app_language');

        $diff = array_diff($supportedLangs, [$name]);
        sort($diff, SORT_NATURAL | SORT_FLAG_CASE);

        $this->setting_model->update_batch([
            [
                'key'   => 'app_language',
                'value' => $name
            ],
            [
                'key'   => 'app_supported_languages',
                'value' => json_encode($diff)
            ]
        ], 'key');

        $this->log_model->create('language', 'set', 'Set a default language', [
            'language' => $name
        ]);

        $this->cache->delete('settings');

        $this->session->set_flashdata('success', lang_vars('alert_language_set_default', [$name]));
        redirect(site_url('admin/languages'));
    }

    /**
     * Get languages information
     *
     * @param string|null $name
     * @return array
     */
    private function _get_languages($name = null)
    {
        $location = APPPATH . 'language/';
        $files    = directory_map($location, 1);

        $supportedLangs = is_json(config_item('app_supported_languages')) ? json_decode(config_item('app_supported_languages')) : [];
        $supportedLangs[] = config_item('app_language');

        $languages = [];

        foreach ($files as $file) {
            if (! is_dir($location . $file)) {
                continue;
            }

            $config = realpath($location . $file . 'language.php');
            $folder = trim(str_replace('/', '', stripslashes($file)));

            // If the config file does not exist in the language folder
            // it will not be shown in the list
            if (! is_file($config)) {
                continue;
            }

            $data = require $config;

            if (! is_array($data)) {
                continue;
            }

            $data['default'] = $folder === config_item('app_language');
            $data['active'] = in_array($folder, $supportedLangs, true);

            $languages[$folder] = $data;
        }

        if ($name !== null) {
            if (array_key_exists($name, $languages)) {
                return $languages[$name];
            }

            return [];
        }

        return $languages;
    }
}
