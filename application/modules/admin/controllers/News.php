<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.news');

        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = 50;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('admin/news'),
            'total_rows' => $this->news_model->total_paginate(),
            'per_page'   => $perPage
        ]);

        $data = [
            'articles'   => $this->news_model->paginate($perPage, $offset),
            'pagination' => $this->pagination->create_links()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('news/index', $data);
    }

    public function add()
    {
        require_permission('add.news');

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->add_js(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin'])
            ->add_js(base_url('assets/js/tmce-content.js'))
            ->add_js(base_url('assets/js/media-preview.js'));

        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        $this->form_validation->set_rules('summary', lang('summary'), 'trim|required|max_length[255]');
        $this->form_validation->set_rules('content', lang('content'), 'trim|required');
        $this->form_validation->set_rules('slug', lang('slug'), 'trim|required|alpha_dash');
        $this->form_validation->set_rules('file', lang('file'), 'callback__file_required');
        $this->form_validation->set_rules('discuss', lang('allow_comments'), 'trim');
        $this->form_validation->set_rules('meta_description', lang('meta_description'), 'trim|max_length[155]');
        $this->form_validation->set_rules('meta_robots', lang('meta_robots'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $directory = current_date('Y') . '/' . current_date('m') . '/';

            if (! is_dir(FCPATH . 'uploads/' . $directory)) {
                mkdir(FCPATH . 'uploads/' . $directory, 0755, true);
            }

            $this->load->library('upload', [
                'upload_path'   => FCPATH . 'uploads/' . $directory,
                'allowed_types' => 'gif|jpg|jpeg|png',
                'encrypt_name'  => true
            ]);

            if (! $this->upload->do_upload('file')) {
                $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                redirect(site_url('admin/news/add'));
            }

            $uploadData = $this->upload->data();

            $this->news_model->insert([
                'title'            => $this->input->post('title'),
                'summary'          => $this->input->post('summary'),
                'content'          => purify($this->input->post('content'), 'article'),
                'slug'             => strtolower($this->input->post('slug')),
                'image'            => $directory . $uploadData['file_name'],
                'meta_description' => $this->input->post('meta_description', true),
                'meta_robots'      => $this->input->post('meta_robots', true),
                'discuss'          => empty($this->input->post('discuss', true)) ? 0 : 1
            ]);

            $newsId = $this->db->insert_id();

            $this->log_model->create('news', 'add', 'Added a news', [
                'article' => $this->input->post('title')
            ], 'admin/news/edit/' . $newsId);

            $this->session->set_flashdata('success', lang('alert_news_added'));
            redirect(site_url('admin/news/edit/' . $newsId));
        } else {
            $this->template->build('news/add');
        }
    }

    /**
     * Edit article
     *
     * @param int $id
     * @return string|void
     */
    public function edit($id = null)
    {
        require_permission('edit.news');

        $article = $this->news_model->find(['id' => $id]);

        if (empty($article)) {
            show_404();
        }

        $data = [
            'article' => $article
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->add_js(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin'])
            ->add_js(base_url('assets/js/tmce-content.js'))
            ->add_js(base_url('assets/js/media-preview.js'));

        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        $this->form_validation->set_rules('summary', lang('summary'), 'trim|required|max_length[255]');
        $this->form_validation->set_rules('content', lang('content'), 'trim|required');
        $this->form_validation->set_rules('slug', lang('slug'), 'trim|required|alpha_dash');
        $this->form_validation->set_rules('discuss', lang('allow_comments'), 'trim');
        $this->form_validation->set_rules('meta_description', lang('meta_description'), 'trim|max_length[155]');
        $this->form_validation->set_rules('meta_robots', lang('meta_robots'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
                $directory = current_date('Y') . '/' . current_date('m') . '/';

                if (! is_dir(FCPATH . 'uploads/' . $directory)) {
                    mkdir(FCPATH . 'uploads/' . $directory, 0755, true);
                }

                $this->load->library('upload', [
                    'upload_path'   => FCPATH . 'uploads/' . $directory,
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'encrypt_name'  => true
                ]);

                if (! $this->upload->do_upload('file')) {
                    $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                    redirect(site_url('admin/news/edit/' . $id));
                }

                if (is_file(FCPATH . 'uploads/' . $article->image)) {
                    unlink(FCPATH . 'uploads/' . $article->image);
                }

                $uploadData = $this->upload->data();

                $this->news_model->update([
                    'image' => $directory . $uploadData['file_name']
                ], ['id' => $id]);
            }

            $this->news_model->update([
                'title'            => $this->input->post('title'),
                'summary'          => $this->input->post('summary'),
                'content'          => purify($this->input->post('content'), 'article'),
                'slug'             => strtolower($this->input->post('slug')),
                'meta_description' => $this->input->post('meta_description', true),
                'meta_robots'      => $this->input->post('meta_robots', true),
                'discuss'          => empty($this->input->post('discuss', true)) ? 0 : 1
            ], ['id' => $id]);

            $this->log_model->create('news', 'edit', 'Edited a news', [
                'article' => $this->input->post('title')
            ], 'admin/news/edit/' . $id);

            $this->session->set_flashdata('success', lang('alert_news_updated'));
            redirect(site_url('admin/news/edit/' . $id));
        } else {
            $this->template->build('news/edit', $data);
        }
    }

    /**
     * Delete article
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        require_permission('delete.news');

        $article = $this->news_model->find(['id' => $id]);

        if (empty($article)) {
            show_404();
        }

        if (is_file(FCPATH . 'uploads/' . $article->image)) {
            unlink(FCPATH . 'uploads/' . $article->image);
        }

        $this->news_model->delete(['id' => $id]);

        $this->log_model->create('news', 'delete', 'Deleted a news', [
            'article' => $article->title
        ]);

        $this->session->set_flashdata('success', lang('alert_news_deleted'));
        redirect(site_url('admin/news'));
    }

    /**
     * Delete article comments
     *
     * @param int $id
     * @return void
     */
    public function delete_comments($id = null)
    {
        require_permission('delete.news');

        $article = $this->news_model->find(['id' => $id]);

        if (empty($article)) {
            show_404();
        }

        $this->news_model->update([
            'comments' => 0
        ], ['id' => $id]);

        $this->news_comment_model->delete(['news_id' => $id]);

        $this->log_model->create('news', 'delete', 'Deleted all comments from a news', [
            'article' => $article->title
        ]);

        $this->session->set_flashdata('success', lang('alert_news_comments_deleted'));
        redirect(site_url('admin/news'));
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
}
