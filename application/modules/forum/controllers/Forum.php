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

class Forum extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('forum', true);

        $this->load->model([
            'forum_model'        => 'forum',
            'forum_topics_model' => 'forum_topics',
            'forum_posts_model'  => 'forum_posts'
        ]);

        $this->load->language('forum');

        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $data = [
            'categories' => $this->forum->find_all(0, 'category')
        ];

        $this->template->title(config_item('app_name'), lang('forum'));

        $this->template->build('index', $data);
    }

    /**
     * View forum
     *
     * @param int $id
     * @return string
     */
    public function forum($id = null)
    {
        $forum = $this->forum->find(['id' => $id, 'type' => 'forum']);

        if (empty($forum))
        {
            show_404();
        }

        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 15;

        $this->pagination->initialize([
            'base_url'    => site_url('forum/view/' . $id),
            'total_rows'  => $this->forum_topics->count_all($id),
            'per_page'    => $per_page,
            'uri_segment' => 4
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'forum'        => $forum,
            'subforums'    => $this->forum->find_all($id, 'forum'),
            'topics'       => $this->forum_topics->find_all($id, $per_page, $offset),
            'links'        => $this->pagination->create_links(),
            'total_users'  => $this->users->count_all(),
            'total_topics' => $this->forum_topics->count_all(),
            'total_posts'  => $this->forum_posts->count_all()
        ];

        $this->template->title(config_item('app_name'), lang('forum'));

        $this->template->build('forum', $data);
    }

    /**
     * View topic
     *
     * @param int $id
     * @return string
     */
    public function topic($id = null)
    {
        $topic = $this->forum_topics->find(['id' => $id]);

        if (empty($topic))
        {
            show_404();
        }

        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 15;

        $this->pagination->initialize([
            'base_url'    => site_url('forum/topic/' . $id),
            'total_rows'  => $this->forum_posts->count_all($id),
            'per_page'    => $per_page,
            'uri_segment' => 4
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'topic' => $topic,
            'posts' => $this->forum_posts->find_all($id, $per_page, $offset),
            'links' => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('forum'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/comment.js'));

        $this->template->build('topic', $data);
    }

    /**
     * Create topic
     *
     * @param int $id
     * @return mixed
     */
    public function create_topic($id = null)
    {
        if (empty($id))
        {
            show_404();
        }

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $data = [
            'id' => $id
        ];

        $this->template->title(config_item('app_name'), lang('forum'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/content.js'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', lang('title'), 'trim|required');
            $this->form_validation->set_rules('description', lang('description'), 'trim|required|richtext_min[50]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('create_topic', $data);
            }
            else
            {
                $this->forum_topics->create([
                    'forum_id'    => $id,
                    'user_id'     => $this->session->userdata('id'),
                    'title'       => $this->input->post('title', TRUE),
                    'description' => html_purify($this->input->post('description'), 'content'),
                    'created_at'  => current_date()
                ]);

                $this->session->set_flashdata('success', lang('topic_created'));
                redirect(site_url('forum/view/'.$id));
            }
        }
        else
        {
            $this->template->build('create_topic', $data);
        }
    }

    public function create_post()
    {
        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->form_validation->set_rules('id', lang('id'), 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('comment', lang('comment'), 'trim|required|richtext_min[10]');

        if ($this->form_validation->run() == FALSE)
        {
            $id = $this->input->post('id', TRUE);

            $this->session->set_flashdata('form_error', form_error('comment', '', ''));
            redirect(site_url('forum/topic/' . $id));
        }
        else
        {
            $id    = $this->input->post('id', TRUE);
            $topic = $this->forum_topics->find(['id' => $id]);

            $this->forum_posts->create([
                'topic_id'   => $id,
                'forum_id'   => $topic->forum_id,
                'user_id'    => $this->session->userdata('id'),
                'commentary' => html_purify($this->input->post('comment'), 'comment'),
                'created_at' => current_date()
            ]);

            $this->session->set_flashdata('success', lang('post_sended'));
            redirect(site_url('forum/topic/' . $id));
        }
    }

    /**
     * Edit topic
     *
     * @param int $id
     * @return mixed
     */
    public function edit_topic($id = null)
    {
        $topic = $this->forum_topics->find(['id' => $id]);

        if (empty($topic))
        {
            show_404();
        }

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_moderator() && $this->session->userdata('id') != $topic->user_id)
        {
            $this->session->set_flashdata('error', lang('permission_denied'));
            redirect(site_url('forum/topic/' . $topic->id));
        }

        $data = [
            'topic' => $topic
        ];

        $this->template->title(config_item('app_name'), lang('forum'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/content.js'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', lang('title'), 'trim|required');
            $this->form_validation->set_rules('description', lang('description'), 'trim|required|richtext_min[50]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('edit_topic', $data);
            }
            else
            {
                $this->forum_topics->update([
                    'title'       => $this->input->post('title', TRUE),
                    'description' => html_purify($this->input->post('description'), 'content'),
                    'updated_at'  => current_date()
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('topic_updated'));
                redirect(site_url('forum/topic/'.$id));
            }
        }
        else
        {
            $this->template->build('edit_topic', $data);
        }
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return void
     */
    public function delete_post($id = null)
    {
        $post = $this->forum_posts->find(['id' => $id]);

        if (empty($post))
        {
            show_404();
        }

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if ($this->auth->is_moderator() || $this->session->userdata('id') == $post->user_id)
        {
            $this->forum_posts->delete(['id' => $id]);

            $this->session->set_flashdata('success', lang('post_deleted'));
            redirect(site_url('forum/topic/' . $post->topic_id));
        }

        $this->session->set_flashdata('error', lang('permission_denied'));
        redirect(site_url('forum/topic/' . $post->topic_id));
    }
}
