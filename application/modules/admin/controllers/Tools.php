<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_permission('run.tools');
    }

    public function cache()
    {
        if (! $this->cache->clean()) {
            $this->session->set_flashdata('error', lang('alert_cache_failed'));
        } else {
            $this->session->set_flashdata('success', lang('alert_cache_deleted'));
        }

        $this->log_model->create('cache', 'purge', 'Purged the cache');

        redirect(site_url('admin'));
    }

    public function sessions()
    {
        $this->log_model->create('sessions', 'purge', 'Purged all sessions');

        $this->user_token_model->delete(['type' => User_token_model::TOKEN_REMEMBER]);
        $this->db->truncate('sessions');

        redirect(site_url());
    }

    public function migrate_accounts()
    {
        $auth       = $this->server_auth_model->connect();
        $accounts   = $auth->get('account')->result_array();
        $accountIds = array_column($accounts, 'id');

        $users    = $this->user_model->find_all([], 'array');
        $usersIds = array_column($users, 'id');

        $missingIds = array_filter($accountIds, fn($v) => ! in_array($v, $usersIds, true));
        $countIds   = count($missingIds);

        if ($missingIds === []) {
            $this->session->set_flashdata('info', lang('alert_no_accounts_migrated'));
            redirect(site_url('admin'));
        }

        $result = $auth->where_in('id', $missingIds)
            ->get('account')
            ->result();

        foreach ($result as $account) {
            $this->user_model->insert([
                'id'       => $account->id,
                'nickname' => $account->username,
                'username' => $account->username,
                'email'    => ! empty($account->email) ? $account->email : strtolower($account->username) . '@localhost',
                'role'     => Role_model::ROLE_USER
            ]);
        }

        $this->log_model->create('accounts', 'migrate', 'Migrated missing accounts');

        $this->session->set_flashdata('success', lang_vars('alert_migrate_accounts', [$countIds]));
        redirect(site_url('admin'));
    }
}
