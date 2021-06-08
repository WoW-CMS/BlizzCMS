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

class Admin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('forum', true);

        if (! $this->website->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->model([
            'forum_model'        => 'forum',
            'forum_topics_model' => 'forum_topics',
            'forum_posts_model'  => 'forum_posts'
        ]);

        $this->load->language('admin/admin');
        $this->load->language('forum');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $data = [
            'items' => $this->forum->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/index', $data);
    }

    public function create()
    {
        $data = [
            'categories' => $this->forum->find_all(0, 'category'),
            'forums'     => $this->forum->find_all(null, 'forum')
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|max_length[250]');
            $this->form_validation->set_rules('icon', 'Icon', 'trim');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[category,forum]');
            $this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/create', $data);
            }
            else
            {
                $type   = $this->input->post('type');
                $parent = $this->input->post('parent');

                if ($type === 'forum' && $parent == 0)
                {
                    $this->session->set_flashdata('error', lang('forum_need_related'));
                    redirect(site_url('forum/admin/create'));
                }

                $forum_parent = $this->forum->find(['id' => $parent]);

                if ($type === 'category' && $forum_parent->type === 'forum' || $type === 'category' && $forum_parent->type === 'category')
                {
                    $this->session->set_flashdata('error', lang('category_not_relate'));
                    redirect(site_url('forum/admin/create'));
                }

                $this->forum->create([
                    'name'        => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'icon'        => $this->input->post('icon'),
                    'type'        => $type,
                    'parent'      => $parent
                ]);

                $this->session->set_flashdata('success', lang('forum_created'));
                redirect(site_url('forum/admin/create'));
            }
        }
        else
        {
            $this->template->build('admin/create', $data);
        }
    }

    /**
     * Edit forum
     *
     * @param int $forum_id
     * @return mixed
     */
    public function edit($forum_id = null)
    {
        $forum = $this->forum->find(['id' => $forum_id]);

        if (empty($forum))
        {
            show_404();
        }

        $data = [
            'categories' => $this->forum->find_all(0, 'category'),
            'forums'     => $this->forum->find_all(null, 'forum'),
            'forum'      => $forum
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|max_length[250]');
            $this->form_validation->set_rules('icon', 'Icon', 'trim');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[category,forum]');
            $this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/edit', $data);
            }
            else
            {
                $type   = $this->input->post('type');
                $parent = $this->input->post('parent');

                if ($type === 'forum' && $parent == 0)
                {
                    $this->session->set_flashdata('error', lang('forum_need_related'));
                    redirect(site_url('forum/admin/edit/'.$forum_id));
                }

                $forum_parent = $this->forum->find(['id' => $parent]);

                if ($type === 'category' && $forum_parent->type === 'forum' || $type === 'category' && $forum_parent->type === 'category')
                {
                    $this->session->set_flashdata('error', lang('category_not_relate'));
                    redirect(site_url('forum/admin/edit/'.$forum_id));
                }

                $this->forum->update([
                    'name'        => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'icon'        => $this->input->post('icon'),
                    'type'        => $type,
                    'parent'      => $parent
                ], ['id' => $forum_id]);

                $this->session->set_flashdata('success', lang('forum_updated'));
                redirect(site_url('forum/admin/edit/'.$forum_id));
            }
        }
        else
        {
            $this->template->build('admin/edit', $data);
        }
    }

    /**
     * Delete forum
     *
     * @param int $forum_id
     * @return void
     */
    public function delete($forum_id = null)
    {
        $forum = $this->forum->find(['id' => $forum_id]);

        if (empty($forum))
        {
            show_404();
        }

        $this->forum->delete(['id' => $forum_id]);

        $this->session->set_flashdata('success', lang('forum_deleted'));
        redirect(site_url('forum/admin'));
    }

    /**
     * View subforums
     *
     * @param int $forum_id
     * @return string
     */
    public function forum($forum_id = null)
    {
        $forum = $this->forum->find(['id' => $forum_id]);

        if (empty($forum))
        {
            show_404();
        }

        $data = [
            'id'    => $forum_id,
            'forum' => $forum,
            'items' => $this->forum->find_all($forum_id)
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/items', $data);
    }
}