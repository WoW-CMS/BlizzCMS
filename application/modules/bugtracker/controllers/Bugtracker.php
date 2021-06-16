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

class Bugtracker extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('bugtracker', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->load->model([
            'bugtracker_model'            => 'bugtracker',
            'bugtracker_comments_model'   => 'bugtracker_comments',
            'bugtracker_categories_model' => 'bugtracker_categories'
        ]);

        $this->load->language('bugtracker');

        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $search         = $this->input->get('search');
        $category       = $this->input->get('category');
        $search_cleaned = $this->security->xss_clean($search);
        $cat_cleaned    = $this->security->xss_clean($category);

        $config = [
            'base_url'    => site_url('bugtracker'),
            'total_rows'  => $this->bugtracker->count_all($search_cleaned, $cat_cleaned),
            'per_page'    => 15,
            'uri_segment' => 2
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'reports'    => $this->bugtracker->find_all($config['per_page'], $offset, $search_cleaned, $cat_cleaned),
            'links'      => $this->pagination->create_links(),
            'categories' => $this->bugtracker_categories->get_categories(),
            'latest'     => $this->bugtracker_comments->latest(),
            'search'     => $search,
            'category'   => $category
        ];

        $this->template->title(config_item('app_name'), lang('bugtracker'));

        $this->template->build('index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('bugtracker'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/content.js'));

        $data = [
            'realms'     => $this->realms->find_all(),
            'categories' => $this->bugtracker_categories->get_categories()
        ];

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|richtext_min[50]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('create_report', $data);
            }
            else
            {
                $this->bugtracker->create([
                    'user_id'     => $this->session->userdata('id'),
                    'realm_id'    => $this->input->post('realm', TRUE),
                    'title'       => $this->input->post('title', TRUE),
                    'description' => html_purify($this->input->post('description'), 'content'),
                    'category_id' => $this->input->post('category', TRUE),
                    'created_at'  => current_date()
                ]);

                $this->session->set_flashdata('success', lang('report_created'));
                redirect(site_url('bugtracker/create'));
            }
        }
        else
        {
            $this->template->build('create_report', $data);
        }
    }

    /**
     * Edit report
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $report = $this->bugtracker->find(['id' => $id]);

        if (empty($report) || ! $this->auth->is_moderator() || $this->session->userdata('id') != $report->user_id)
        {
            show_404();
        }

        $data = [
            'realms'     => $this->realms->find_all(),
            'categories' => $this->bugtracker_categories->get_categories(),
            'report'     => $report
        ];

        $this->template->title(config_item('app_name'), lang('bugtracker'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/content.js'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            if ($this->auth->is_moderator())
            {
                $this->form_validation->set_rules('priority', 'Priority', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('edit_report', $data);
            }
            else
            {
                $data = [
                    'realm_id'    => $this->input->post('realm', TRUE),
                    'title'       => $this->input->post('title', TRUE),
                    'description' => html_purify($this->input->post('description'), 'content'),
                    'category_id' => $this->input->post('category', TRUE)
                ];

                if ($this->auth->is_moderator())
                {
                    $data['priority'] = $this->input->post('priority', TRUE);
                    $data['status']   = $this->input->post('status', TRUE);
                }

                $this->bugtracker->update($data, ['id' => $id]);

                $this->session->set_flashdata('success', lang('report_edited'));
                redirect(site_url('bugtracker/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('edit_report', $data);
        }
    }

    /**
     * View report
     *
     * @param int $id
     * @return string
     */
    public function report($id = null)
    {
        $report = $this->bugtracker->find(['id' => $id]);

        if (empty($report))
        {
            show_404();
        }

        $get = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('bugtracker/report/' . $id),
            'total_rows'  => $this->bugtracker_comments->count_all($id),
            'per_page'    => 15,
            'uri_segment' => 4
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'report'   => $report,
            'comments' => $this->bugtracker_comments->find_all($id, $config['per_page'], $offset),
            'links'    => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('bugtracker'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/comment.js'));

        $this->template->build('report', $data);
    }

    public function comment()
    {
        $this->form_validation->set_rules('id', 'Id', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|richtext_min[10]');

        if ($this->form_validation->run() == FALSE)
        {
            $id = $this->input->post('id', TRUE);

            $this->session->set_flashdata('form_error', form_error('comment', '', ''));
            redirect(site_url('bugtracker/report/' . $id));
        }
        else
        {
            $id = $this->input->post('id', TRUE);

            $this->bugtracker_comments->create([
                'report_id'  => $id,
                'user_id'    => $this->session->userdata('id'),
                'commentary' => html_purify($this->input->post('comment'), 'comment'),
                'created_at' => current_date()
            ]);

            $this->session->set_flashdata('success', lang('comment_sended'));
            redirect(site_url('bugtracker/report/' . $id));
        }
    }

    /**
     * Delete comment
     *
     * @param int $id
     * @return void
     */
    public function delete_comment($id = null)
    {
        $comment = $this->bugtracker_comments->find(['id' => $id]);

        if (empty($comment))
        {
            show_404();
        }

        if ($this->auth->is_moderator() || $this->session->userdata('id') == $comment->user_id)
        {
            $this->bugtracker_comments->delete(['id' => $id]);

            $this->session->set_flashdata('success', lang('comment_deleted'));
            redirect(site_url('bugtracker/report/' . $comment->report_id));
        }

        $this->session->set_flashdata('error', lang('permission_denied'));
        redirect(site_url('bugtracker/report/' . $comment->report_id));
    }
}
