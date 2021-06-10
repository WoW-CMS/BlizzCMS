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

        mod_located('store', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        if (! $this->auth->is_admin() || $this->auth->is_banned())
        {
            redirect(site_url('user'));
        }

        $this->load->model([
            'store_model'       => 'store',
            'store_items_model' => 'store_items',
            'store_logs_model'  => 'store_logs'
        ]);

        $this->load->language('admin/admin');
        $this->load->language('store');

        $this->template->set_theme();
        $this->template->set_layout('admin_layout');
        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $data = [
            'categories' => $this->store->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/index', $data);
    }

    public function create()
    {
        $data = [
            'parents' => $this->store->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[store.slug]');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[default,accordion]');
            $this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/create', $data);
            }
            else
            {
                $this->store->create([
                    'name'   => $this->input->post('name'),
                    'slug'   => $this->input->post('slug'),
                    'type'   => $this->input->post('type'),
                    'parent' => $this->input->post('parent')
                ]);

                $this->session->set_flashdata('success', lang('category_created'));
                redirect(site_url('store/admin/create'));
            }
        }
        else
        {
            $this->template->build('admin/create', $data);
        }
    }

    /**
     * Edit store
     *
     * @param int $store_id
     * @return mixed
     */
    public function edit($store_id = null)
    {
        $store = $this->store->find(['id' => $store_id]);

        if (empty($store))
        {
            show_404();
        }

        $data = [
            'parents'  => $this->store->find_all(),
            'category' => $store
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|update_unique[store.slug.'.$store_id.']');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|in_list[default,accordion]');
            $this->form_validation->set_rules('parent', 'Parent', 'trim|required|is_natural');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/edit', $data);
            }
            else
            {
                $this->store->update([
                    'name'   => $this->input->post('name'),
                    'slug'   => $this->input->post('slug'),
                    'type'   => $this->input->post('type'),
                    'parent' => $this->input->post('parent')
                ], ['id' => $store_id]);

                $this->session->set_flashdata('success', lang('category_updated'));
                redirect(site_url('store/admin/edit/'.$store_id));
            }
        }
        else
        {
            $this->template->build('admin/edit', $data);
        }
    }

    /**
     * Delete store
     *
     * @param int $store_id
     * @return void
     */
    public function delete($store_id = null)
    {
        $store = $this->store->find(['id' => $store_id]);

        if (empty($store))
        {
            show_404();
        }

        $this->store->delete(['id' => $store_id]);
        $this->store_items->delete(['store_id' => $store_id]);

        $this->session->set_flashdata('success', lang('category_deleted'));
        redirect(site_url('store/admin'));
    }

    /**
     * View category
     *
     * @param int $store_id
     * @return string
     */
    public function category($store_id = null)
    {
        $store = $this->store->find(['id' => $store_id]);

        if (empty($store))
        {
            show_404();
        }

        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $config = [
            'base_url'    => site_url('store/admin'),
            'total_rows'  => $this->store_items->count_all($store_id),
            'per_page'    => 25,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'id'       => $store_id,
            'category' => $store,
            'items'    => $this->store_items->find_all($store_id, $config['per_page'], $offset),
            'links'    => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/items', $data);
    }

    /**
     * Create item
     *
     * @param int $store_id
     * @return mixed
     */
    public function create_item($store_id = null)
    {
        $store = $this->store->find(['id' => $store_id]);

        if (empty($store))
        {
            show_404();
        }

        $data = [
            'id'       => $store_id,
            'category' => $store,
            'realms'   => $this->realms->find_all()
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('image', 'Image', 'trim');
            $this->form_validation->set_rules('price_type', 'Price type', 'trim|required|in_list[dp,vp,and]');
            $this->form_validation->set_rules('dp', 'DP', 'trim|is_natural');
            $this->form_validation->set_rules('vp', 'VP', 'trim|is_natural');
            $this->form_validation->set_rules('top', 'Top', 'trim');
            $this->form_validation->set_rules('command', 'Command', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/create_item', $data);
            }
            else
            {
                $this->store_items->create([
                    'store_id'    => $store_id,
                    'realm_id'    => $this->input->post('realm'),
                    'name'        => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'image'       => $this->input->post('image'),
                    'price_type'  => $this->input->post('price_type'),
                    'dp'          => $this->input->post('dp'),
                    'vp'          => $this->input->post('vp'),
                    'top'         => empty($this->input->post('top', TRUE)) ? 0 : 1,
                    'command'     => $this->input->post('command')
                ]);

                $this->session->set_flashdata('success', lang('item_created'));
                redirect(site_url('store/admin/'. $store_id));
            }
        }
        else
        {
            $this->template->build('admin/create_item', $data);
        }
    }

    /**
     * Edit item
     *
     * @param int $store_id
     * @param int $item_id
     * @return mixed
     */
    public function edit_item($store_id = null, $item_id = null)
    {
        $store = $this->store->find(['id' => $store_id]);
        $item  = $this->store_items->find(['id' => $item_id]);

        if (empty($store) || empty($item))
        {
            show_404();
        }

        $data = [
            'id'       => $store_id,
            'category' => $store,
            'realms'   => $this->realms->find_all(),
            'item'     => $item
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('realm', 'Realm', 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('image', 'Image', 'trim');
            $this->form_validation->set_rules('price_type', 'Price type', 'trim|required|in_list[dp,vp,and]');
            $this->form_validation->set_rules('dp', 'DP', 'trim|is_natural');
            $this->form_validation->set_rules('vp', 'VP', 'trim|is_natural');
            $this->form_validation->set_rules('top', 'Top', 'trim');
            $this->form_validation->set_rules('command', 'Command', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('admin/edit_item', $data);
            }
            else
            {
                $this->store_items->update([
                    'realm_id'    => $this->input->post('realm'),
                    'name'        => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'image'       => $this->input->post('image'),
                    'price_type'  => $this->input->post('price_type'),
                    'dp'          => $this->input->post('dp'),
                    'vp'          => $this->input->post('vp'),
                    'top'         => empty($this->input->post('top', TRUE)) ? 0 : 1,
                    'command'     => $this->input->post('command')
                ], ['id' => $id]);

                $this->session->set_flashdata('success', lang('item_updated'));
                redirect(site_url('store/admin/'.$store_id.'/edit/'.$item_id));
            }
        }
        else
        {
            $this->template->build('admin/edit_item', $data);
        }
    }

    /**
     * Delete item
     *
     * @param int $store_id
     * @param int $item_id
     * @return void
     */
    public function delete_item($store_id = null, $item_id = null)
    {
        $item = $this->store_items->find(['id' => $item_id]);

        if (empty($item))
        {
            show_404();
        }

        $this->store_items->delete(['id' => $item_id]);

        $this->session->set_flashdata('success', lang('item_deleted'));
        redirect(site_url('store/admin/'.$store_id));
    }

    public function logs()
    {
        $get  = $this->input->get('page', TRUE);
        $page = ctype_digit((string) $get) ? $get : 0;

        $search       = $this->input->get('search');
        $search_clean = $this->security->xss_clean($search);

        $config = [
            'base_url'    => site_url('store/admin/logs'),
            'total_rows'  => $this->store_logs->count_all($search_clean),
            'per_page'    => 25,
            'uri_segment' => 4
        ];

        $this->pagination->initialize($config);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

        $data = [
            'logs'  => $this->store_logs->find_all($config['per_page'], $offset, $search_clean),
            'links'  => $this->pagination->create_links(),
            'search' => $search
        ];

        $this->template->title(config_item('app_name'), lang('admin_panel'));

        $this->template->build('admin/logs', $data);
    }
}