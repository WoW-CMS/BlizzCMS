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

class Vote extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('vote', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->load->model([
            'topsites_model'      => 'topsites',
            'topsites_logs_model' => 'topsites_logs'
        ]);

        $this->load->language('vote', $this->language->current());

        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 15;

        $this->pagination->initialize([
            'base_url'    => site_url('vote'),
            'total_rows'  => $this->topsites->count_all(),
            'per_page'    => $per_page,
            'uri_segment' => 2
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'topsites' => $this->topsites->find_all($per_page, $offset),
            'links'    => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('vote'));

        $this->template->build('index', $data);
    }

    /**
     * Redirect to topsite for vote
     *
     * @param int $id
     * @return void
     */
    public function site($id = null)
    {
        $topsite = $this->topsites->find(['id' => $id]);
        $ip      = $this->input->ip_address();

        if (empty($topsite))
        {
            show_404();
        }

        if ($this->topsites_logs->expiration($id) >= now())
        {
            $this->session->set_flashdata('error', lang('already_voted'));
            redirect(site_url('vote'));
        }

        $user = $this->cms->user();

        $this->users->update(['vp' => ($topsite->points + $user->vp)], ['id' => $user->id]);

        $this->topsites_logs->create([
            'topsite_id' => $id,
            'user_id'    => $user->id,
            'points'     => $topsite->points,
            'ip'         => $ip,
            'created_at' => current_date(),
            'expired_at' => interval_time('PT' . $topsite->time . 'H')
        ]);

        redirect($topsite->url);
    }
}
