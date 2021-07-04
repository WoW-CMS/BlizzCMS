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

class News extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        // Load callback
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

        $this->load->language('admin', $this->language->current());

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 25;

        $this->pagination->initialize([
            'base_url'    => site_url('admin/news'),
            'total_rows'  => $this->news->count_all(),
            'per_page'    => $per_page,
            'uri_segment' => 3
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'news'  => $this->news->find_all($per_page, $offset),
            'links' => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('news/index', $data);
    }

    public function create()
    {
        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/content.js'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', lang('title'), 'trim|required');
            $this->form_validation->set_rules('description', lang('description'), 'trim|required');
            $this->form_validation->set_rules('image', lang('image'), 'callback__image_required');
            $this->form_validation->set_rules('comments', lang('comments'), 'trim');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('news/create');
            }
            else
            {
                $this->load->library('upload', [
                    'upload_path'   => FCPATH . 'uploads/news/',
                    'allowed_types' => 'jpg|jpeg|png',
                    'max_size'      => 1024 * 5,
                    'encrypt_name'  => TRUE
                ]);

                if (! $this->upload->do_upload('image'))
                {
                    $this->session->set_flashdata('upload', $this->upload->display_errors('<li><i class="fas fa-times-circle"></i> ', '</li>'));
                    redirect(site_url('admin/news/create'));
                }

                $uploaded = $this->upload->data();
                $img = $uploaded['file_name'];

                $this->news->create([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'image'       => $img,
                    'comments'    => empty($this->input->post('comments', TRUE)) ? 0 : 1,
                    'created_at'  => current_date()
                ]);

                $this->session->set_flashdata('success', lang('news_created'));
                redirect(site_url('admin/news/create'));
            }
        }
        else
        {
            $this->template->build('news/create');
        }
    }

    /**
     * Edit news
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $news = $this->news->find(['id' => $id]);

        if (empty($news))
        {
            show_404();
        }

        $data = [
            'news' => $news
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->add_js(base_url('assets/tinymce/tinymce.min.js'));
        $this->template->add_js(base_url('assets/tinymce/content.js'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('title', lang('title'), 'trim|required');
            $this->form_validation->set_rules('description', lang('description'), 'trim|required');
            $this->form_validation->set_rules('comments', lang('comments'), 'trim');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('news/edit', $data);
            }
            else
            {
                if (isset($_FILES['image']['name']) && ! empty($_FILES['image']['name']))
                {
                    $this->load->library('upload', [
                        'upload_path'   => FCPATH . 'uploads/news/',
                        'allowed_types' => 'jpg|jpeg|png',
                        'max_size'      => 1024 * 5,
                        'encrypt_name'  => TRUE
                    ]);

                    if ($this->upload->do_upload('image'))
                    {
                        if (is_readable(FCPATH . 'uploads/news/' . $news->image))
                        {
                            @unlink(FCPATH . 'uploads/news/' . $news->image);
                        }

                        $uploaded = $this->upload->data();
                        $image    = $uploaded['file_name'];

                        $this->news->update(['image' => $image], ['id' => $id]);
                    }
                    else
                    {
                        $this->session->set_flashdata('upload', $this->upload->display_errors('<li><i class="fas fa-times-circle"></i> ', '</li>'));
                        redirect(site_url('admin/news/edit/'.$id));
                    }
                }

                $this->news->update([
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'comments'    => empty($this->input->post('comments', TRUE)) ? 0 : 1
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('news_updated'));
                redirect(site_url('admin/news/edit/'.$id));
            }
        }
        else
        {
            $this->template->build('news/edit', $data);
        }
    }

    /**
     * Delete news
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        $news = $this->news->find(['id' => $id]);

        if (empty($news))
        {
            show_404();
        }

        if (is_readable(FCPATH . 'uploads/news/' . $news->image))
        {
            @unlink(FCPATH . 'uploads/news/' . $news->image);
        }

        $this->news->delete(['id' => $id]);
        $this->db->where('news_id', $id)->delete('news_comments');

        $this->session->set_flashdata('success', lang('news_deleted'));
        redirect(site_url('admin/news'));
    }

    /**
     * Validate upload image
     *
     * @return bool
     */
    public function _image_required()
    {
        if (isset($_FILES['image']['name']) && ! empty($_FILES['image']['name']))
        {
            return true;
        }

        $this->form_validation->set_message('_image_required', 'The {field} is required.');
        return false;
    }
}