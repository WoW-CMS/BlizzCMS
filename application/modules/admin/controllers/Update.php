<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('update.cms');

        $this->load->library(['updater', 'migration']);
    }

    public function index()
    {
        $data = [
            'latest_version' => $this->updater->latest_version(),
            'versions'       => $this->_get_wowcms_versions()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('update/index', $data);
    }

    public function run()
    {
        $update = $this->updater->update();

        if (in_array($update['alert'], ['error', 'info', 'warning'], true)) {
            $this->session->set_flashdata($update['alert'], $update['message']);
            redirect(site_url('admin/update'));
        }

        if ($this->migration->current() === false) {
            show_error($this->migration->error_string());
        }

        $this->session->set_flashdata('success', $update['message']);
        redirect(site_url('admin/update'));
    }

    public function force()
    {
        $migrate = $this->migration->current();

        if ($migrate === true) {
            $this->session->set_flashdata('info', lang('cms_migration_not_files'));
            redirect(site_url('admin/update'));
        }

        if ($migrate === false) {
            show_error($this->migration->error_string());
        }

        $this->session->set_flashdata('success', lang('cms_migration_processed'));
        redirect(site_url('admin/update'));
    }

    private function _get_wowcms_versions()
    {
        $cache = $this->cache->get('wowcms_versions');

        if ($cache !== false) {
            return $cache;
        }

        $request = curl_request('https://wow-cms.com/api/versions/blizzcms', [
            CURLOPT_TIMEOUT       => 2,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $versions = is_json($request) ? json_decode($request) : [];

        $this->cache->save('wowcms_versions', $versions, 10800);

        return $versions;
    }
}
