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

        if (! $this->website->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->load->model('vote_model');
        $this->load->language('vote');

        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('vote'),
            'total_rows'  => $this->vote_model->count_all(),
            'per_page'    => 15,
            'uri_segment' => 2
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'topsites' => $this->vote_model->get_all($config['per_page'], $offset),
            'links'    => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('vote'));

        $this->template->build('index', $data);
    }

    public function site($id = null)
    {
        if (empty($id) || ! $this->vote_model->find_id($id))
        {
            show_404();
        }

        if (strtotime($this->vote_model->get_expiration($id)) >= now())
        {
            $this->session->set_flashdata('error', lang('already_voted'));
            redirect(site_url('vote'));
        }

        $topsite = $this->vote_model->get($id);
        $user    = $this->website->get_user();

        $this->db->where('id', $user->id)->update('users', ['vp' => ($topsite->points + $user->vp)]);

        $this->db->insert('topsites_logs', [
            'topsite_id' => $id,
            'user_id'    => $user->id,
            'points'     => $topsite->points,
            'created_at' => current_date(),
            'expired_at' => interval_time('PT' . $topsite->time . 'H')
        ]);

        redirect($topsite->url);
    }
}
