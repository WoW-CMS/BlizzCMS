<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();

        require_login();

        $this->load->language('user');
    }

    public function index()
    {
        $data = [
            'user' => user()
        ];

        $this->template->title(lang('user_panel'), config_item('app_name'));

        $this->template->build('index', $data);
    }

    public function profile()
    {
        require_permission('editown.profile');

        $user = user();
        $data = [
            'user'      => $user,
            'languages' => $this->multilanguage->languages()
        ];

        $this->template->title(lang('user_panel'), config_item('app_name'));

        $this->form_validation->set_rules('nickname', lang('nickname'), 'trim|required|alpha_dash|max_length[16]');
        $this->form_validation->set_rules('language', lang('language'), 'trim|required|alpha_dash');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $nickname = $this->input->post('nickname');
            $language = $this->input->post('language');
            $columns  = [];

            if ($user->nickname !== $nickname) {
                if ($this->user_model->user_exists($nickname, 'nickname') || $this->user_token_model->userdata_exists($nickname, 'nickname')) {
                    $this->session->set_flashdata('error', lang('alert_nickname_exists'));
                    redirect(site_url('user/profile'));
                }

                $columns['nickname'] = $nickname;
            }

            if ($user->language !== $language) {
                $columns['language'] = $language;
            }

            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
                $this->load->library('upload', [
                    'upload_path'   => FCPATH . 'uploads/avatars',
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size'      => config_item('avatar_max_size') ?? 2048,
                    'min_width'     => 128,
                    'min_height'    => 128,
                    'encrypt_name'  => true
                ]);

                if (! $this->upload->do_upload('file')) {
                    $this->session->set_flashdata('error_list', $this->upload->display_errors('<li>', '</li>'));
                    redirect(site_url('user/profile'));
                }

                if (is_file(FCPATH . 'uploads/avatars/' . $user->avatar)) {
                    unlink(FCPATH . 'uploads/avatars/' . $user->avatar);
                }

                $uploadData = $this->upload->data();

                $columns['avatar'] = $uploadData['file_name'];

                $this->load->library('image_lib', [
                    'image_library'  => 'gd2',
                    'source_image'   => FCPATH . 'uploads/avatars/' . $uploadData['file_name'],
                    'width'          => 128,
                    'height'         => 128,
                    'maintain_ratio' => false
                ]);

                $this->image_lib->resize();
            }

            if ($columns === []) {
                $this->session->set_flashdata('info', lang('alert_own_profile_not_updated'));
                redirect(site_url('user/profile'));
            }

            $this->user_model->update($columns, ['id' => $user->id]);

            if (array_key_exists('nickname', $columns) || array_key_exists('language', $columns)) {
                unset($columns['avatar']);

                $this->session->set_userdata($columns);
            }

            $this->cache->delete('users_avatars');

            $this->session->set_flashdata('success', lang('alert_own_profile_updated'));
            redirect(site_url('user/profile'));
        } else {
            $this->template->build('profile', $data);
        }
    }
}
