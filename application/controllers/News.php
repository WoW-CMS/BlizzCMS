<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = config_item('articles_per_page') ?? 25;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('news'),
            'total_rows' => $this->news_model->total_paginate(),
            'per_page'   => $perPage
        ]);

        $data = [
            'articles'   => $this->news_model->paginate($perPage, $offset),
            'pagination' => $this->pagination->create_links()
        ];

        $this->template->title(lang('news'), config_item('app_name'));

        $this->template->build('articles', $data);
    }

    /**
     * View article
     *
     * @param int $id
     * @param string $slug
     * @return string
     */
    public function view($id = null, $slug = null)
    {
        $article = $this->news_model->find([
            'id'   => $id,
            'slug' => $slug
        ]);

        if (empty($article)) {
            show_404();
        }

        $inputPage = $this->input->get('page');
        $page      = ctype_digit((string) $inputPage) ? (int) $inputPage : 0;

        $perPage = config_item('comments_per_page') ?? 25;
        $offset  = $page > 1 ? ($page - 1) * $perPage : $page; // Calculate offset for paginate

        $this->pagination->initialize([
            'base_url'   => site_url('news/' . $id . '/' . $slug),
            'total_rows' => $this->news_comment_model->total_paginate($id),
            'per_page'   => $perPage
        ]);

        $data = [
            'article'    => $article,
            'comments'   => $this->news_comment_model->paginate($perPage, $offset, $id),
            'pagination' => $this->pagination->create_links(),
            'aside'      => $this->news_model->latest()
        ];

        if ($this->pageviews_model->is_first_viewed()) {
            $this->news_model->set([
                'views' => 'views+1'
            ], ['id' => $id], false);
        }

        $this->template->title($article->title, config_item('app_name'));
        $this->template->set_seo_metas([
            'title'       => $article->title,
            'description' => $article->meta_description,
            'robots'      => $article->meta_robots,
            'type'        => 'article',
            'url'         => current_url()
        ]);

        $this->template->add_js(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin'])
            ->add_js(base_url('assets/js/tmce-comment.js'));

        $this->template->build('article', $data);
    }

    /**
     * Add a comment
     *
     * @param int $id
     * @return void
     */
    public function add_comment($id = null)
    {
        require_login();

        require_permission('add.newscomments', ':base:');

        $article = $this->news_model->find(['id' => $id]);

        if (empty($article) || ! $article->discuss) {
            show_404();
        }

        $minimum = config_item('comments_min_length') ?? 10;
        $maximum = config_item('comments_max_length') ?? 1000;

        // If the maximum length is greater than 0,
        // two rules will be added to limit the comment instead of one
        $rule = $maximum > 0 ? "|richtext_min[{$minimum}]|richtext_max[{$maximum}]" : "|richtext_min[{$minimum}]";

        $this->form_validation->set_rules('comment', lang('comment'), 'trim|required' . $rule);

        if ($this->form_validation->run()) {
            $this->news_comment_model->insert([
                'news_id'         => $id,
                'user_id'         => $this->session->userdata('id'),
                'comment_content' => purify($this->input->post('comment'), 'comment')
            ]);

            $commentId = $this->db->insert_id();

            $this->news_model->update([
                'comments' => $this->news_comment_model->total_paginate($id)
            ], ['id' => $id]);

            $this->log_model->create('news comment', 'add', 'Added a comment', [
                'id'      => $commentId,
                'article' => $article->title
            ]);

            $this->session->set_flashdata('success', lang('alert_comment_published'));
            redirect(site_url('news/' . $id . '/' . $article->slug));
        } else {
            $this->session->set_flashdata('form_error', strip_tags(form_error('comment')));
            redirect(site_url('news/' . $id . '/' . $article->slug));
        }
    }

    /**
     * Edit a comment
     *
     * @param int $id
     * @return void
     */
    public function edit_comment($id = null)
    {
        require_login();

        $comment = $this->news_comment_model->find(['id' => $id]);

        if (empty($comment)) {
            show_404();
        }

        if (! (has_permission('edit.newscomments', ':base:') || has_permission('editown.newscomments', ':base:') && $comment->user_id === $this->session->userdata('id'))) {
            show_permission_rejected();
        }

        $data = [
            'comment' => $comment,
            'article' => $this->news_model->find(['id' => $comment->news_id])
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->add_js(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin'])
            ->add_js(base_url('assets/js/tmce-comment.js'));

        $minimum = config_item('comments_min_length') ?? 10;
        $maximum = config_item('comments_max_length') ?? 1000;

        // If the maximum length is greater than 0,
        // two rules will be added to limit the comment instead of one
        $rule = $maximum > 0 ? "|richtext_min[{$minimum}]|richtext_max[{$maximum}]" : "|richtext_min[{$minimum}]";

        $this->form_validation->set_rules('comment', lang('comment'), 'trim|required' . $rule);

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->news_comment_model->update([
                'comment_content' => purify($this->input->post('comment'), 'comment')
            ], ['id' => $id]);

            $this->log_model->create('news comment', 'edit', 'Edited a comment', [
                'id' => $id
            ]);

            $this->session->set_flashdata('success', lang('alert_comment_updated'));
            redirect(site_url('news/comment/edit/' . $id));
        } else {
            $this->template->build('edit_comment', $data);
        }
    }

    /**
     * Delete a comment
     *
     * @param int|null $id
     * @return void
     */
    public function delete_comment($id = null)
    {
        require_login();

        $comment = $this->news_comment_model->find(['id' => $id]);

        if (empty($comment)) {
            show_404();
        }

        if (! (has_permission('delete.newscomments', ':base:') || has_permission('deleteown.newscomments', ':base:') && $comment->user_id === $this->session->userdata('id'))) {
            show_permission_rejected();
        }

        $this->news_comment_model->delete(['id' => $id]);

        $this->news_model->update([
            'comments' => $this->news_comment_model->total_paginate($comment->news_id)
        ], ['id' => $comment->news_id]);

        $article = $this->news_model->find(['id' => $comment->news_id]);

        $this->log_model->create('news comment', 'delete', 'Deleted a comment', [
            'id' => $id
        ]);

        $this->session->set_flashdata('success', lang('alert_comment_deleted'));
        redirect(site_url('news/' . $article->id . '/' . $article->slug));
    }
}
