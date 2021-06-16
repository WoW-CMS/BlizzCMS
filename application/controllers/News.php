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

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->template->set_partial('alerts', 'static/alerts');
    }

    /**
     * Show news article
     *
     * @param int $id
     * @return string
     */
    public function index($id = null)
    {
        $news = $this->news->find(['id' => $id]);

        if (empty($news))
        {
            show_404();
        }

        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('news/' . $id),
            'total_rows'  => $this->news_comments->count_all($id),
            'per_page'    => 15,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'news'     => $news,
            'comments' => $this->news_comments->find_all($id, $config['per_page'], $offset),
            'links'    => $this->pagination->create_links(),
            'aside'    => $this->news->latest()
        ];

        $this->template->title(config_item('app_name'), lang('news'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/comment.js'));

        $this->template->build('article', $data);
    }

    public function comment()
    {
        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->form_validation->set_rules('id', 'Id', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|richtext_min[10]');

        if ($this->form_validation->run() == FALSE)
        {
            $id = $this->input->post('id', TRUE);

            $this->session->set_flashdata('form_error', form_error('comment', '', ''));
            redirect(site_url('news/' . $id));
        }
        else
        {
            $id = $this->input->post('id', TRUE);

            $this->news_comments->create([
                'news_id'    => $id,
                'user_id'    => $this->session->userdata('id'),
                'commentary' => html_purify($this->input->post('comment'), 'comment'),
                'created_at' => current_date()
            ]);

            $this->session->set_flashdata('success', lang('comment_sended'));
            redirect(site_url('news/' . $id));
        }
    }

    /**
     * Delete comment
     *
     * @param int|null $id
     * @return void
     */
    public function delete_comment($id = null)
    {
        $comment = $this->news_comments->find(['id' => $id]);

        if (empty($comment))
        {
            show_404();
        }

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if ($this->auth->is_moderator() || $this->session->userdata('id') == $comment->user_id)
        {
            $this->news_comments->delete(['id' => $id]);

            $this->session->set_flashdata('success', lang('comment_deleted'));
            redirect(site_url('news/' . $comment->news_id));
        }

        $this->session->set_flashdata('error', lang('permission_denied'));
        redirect(site_url('news/' . $comment->news_id));
    }
}