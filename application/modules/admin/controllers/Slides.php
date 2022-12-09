<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Slides extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_permission('view.appearance');

        $data = [
            'slides' => $this->slide_model->find_all(),
            'last'   => $this->slide_model->last_item_sort()
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->build('slides/index', $data);
    }

    public function add()
    {
        require_permission('add.slides');

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->body_tags([
            ['script', ['src' => base_url('assets/js/media-preview.js')]]
        ]);

        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        $this->form_validation->set_rules('description', lang('description'), 'trim');
        $this->form_validation->set_rules('file', lang('file'), 'callback__file_required');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $directory = current_date('Y') . '/' . current_date('m') . '/';

            if (! is_dir(FCPATH . 'uploads/' . $directory)) {
                mkdir(FCPATH . 'uploads/' . $directory, 0755, true);
            }

            $this->load->library('upload', [
                'upload_path'   => FCPATH . 'uploads/' . $directory,
                'allowed_types' => 'gif|jpg|jpeg|png|mpeg|mpg|mp4|webm|ogg',
                'encrypt_name'  => true
            ]);

            if (! $this->upload->do_upload('file')) {
                $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                redirect(site_url('admin/slides/add'));
            }

            $uploadData = $this->upload->data();

            $this->slide_model->insert([
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description', true),
                'type'        => strpos($uploadData['file_type'], 'video/') !== false ? SLIDE_VIDEO : SLIDE_IMAGE,
                'path'        => $directory . $uploadData['file_name'],
                'sort'        => $this->slide_model->last_item_sort() + 1
            ]);

            $slideId = $this->db->insert_id();

            $this->log_model->create('slide', 'add', 'Added a slide', [
                'slide' => $this->input->post('title')
            ], 'admin/slides/edit/' . $slideId);

            $this->session->set_flashdata('success', lang('alert_slide_added'));
            redirect(site_url('admin/slides/edit/' . $slideId));
        } else {
            $this->template->build('slides/add');
        }
    }

    /**
     * Edit slide
     *
     * @param int $id
     * @return string|void
     */
    public function edit($id = null)
    {
        require_permission('edit.slides');

        $slide = $this->slide_model->find(['id' => $id]);

        if (empty($slide)) {
            show_404();
        }

        $data = [
            'slide' => $slide
        ];

        $this->template->title(lang('admin_panel'), config_item('app_name'));

        $this->template->body_tags([
            ['script', ['src' => base_url('assets/js/media-preview.js')]]
        ]);

        $this->form_validation->set_rules('title', lang('title'), 'trim|required');
        $this->form_validation->set_rules('description', lang('description'), 'trim');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
                $directory = current_date('Y') . '/' . current_date('m') . '/';

                if (! is_dir(FCPATH . 'uploads/' . $directory)) {
                    mkdir(FCPATH . 'uploads/' . $directory, 0755, true);
                }

                $this->load->library('upload', [
                    'upload_path'   => FCPATH . 'uploads/' . $directory,
                    'allowed_types' => 'gif|jpg|jpeg|png|mpeg|mpg|mp4|webm|ogg',
                    'encrypt_name'  => true
                ]);

                if (! $this->upload->do_upload('file')) {
                    $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                    redirect(site_url('admin/slides/edit/' . $id));
                }

                if (is_file(FCPATH . 'uploads/' . $slide->path)) {
                    unlink(FCPATH . 'uploads/' . $slide->path);
                }

                $uploadData = $this->upload->data();

                $this->slide_model->update([
                    'type' => strpos($uploadData['file_type'], 'video/') !== false ? SLIDE_VIDEO : SLIDE_IMAGE,
                    'path' => $directory . $uploadData['file_name']
                ], ['id' => $id]);
            }

            $this->slide_model->update([
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description', true)
            ], ['id' => $id]);

            $this->log_model->create('slide', 'edit', 'Edited a slide', [
                'slide' => $this->input->post('title')
            ], 'admin/slides/edit/' . $id);

            $this->session->set_flashdata('success', lang('alert_slide_updated'));
            redirect(site_url('admin/slides/edit/' . $id));
        } else {
            $this->template->build('slides/edit', $data);
        }
    }

    /**
     * Move slide order
     *
     * @param int $id
     * @param string $action
     * @return void
     */
    public function move($id = null, $action = null)
    {
        require_permission('edit.slides');

        $slide = $this->slide_model->find(['id' => $id]);

        if (empty($slide) || ! in_array($action, ['up', 'down'], true)) {
            show_404();
        }

        $slideSort = (int) $slide->sort;
        $lastSort  = $this->slide_model->last_item_sort();

        if ($slideSort <= 1 && $action === 'up' || ($slideSort + 1) > $lastSort && $action === 'down') {
            show_404();
        }

        if ($action === 'up') {
            $this->slide_model->set(['sort' => 'sort+1'], ['sort' => $slideSort - 1], false);
        } else {
            $this->slide_model->set(['sort' => 'sort-1'], ['sort' => $slideSort + 1], false);
        }

        $this->slide_model->update([
            'sort' => $action === 'up' ? $slideSort - 1 : $slideSort + 1
        ], ['id' => $id]);

        $this->session->set_flashdata('success', lang('alert_slide_moved'));
        redirect(site_url('admin/slides'));
    }

    /**
     * Delete slide
     *
     * @param int $id
     * @return void
     */
    public function delete($id = null)
    {
        require_permission('delete.slides');

        $slide = $this->slide_model->find(['id' => $id]);

        if (empty($slide)) {
            show_404();
        }

        if (is_file(FCPATH . 'uploads/' . $slide->path)) {
            unlink(FCPATH . 'uploads/' . $slide->path);
        }

        $this->slide_model->delete(['id' => $id]);

        $this->slide_model->set(['sort' => 'sort-1'], ['sort >' => (int) $slide->sort], false);

        $this->log_model->create('slide', 'delete', 'Deleted a slide', [
            'slide' => $slide->title
        ]);

        $this->session->set_flashdata('success', lang('alert_slide_deleted'));
        redirect(site_url('admin/slides'));
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
