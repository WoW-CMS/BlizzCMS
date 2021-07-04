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

class Store extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();

        mod_located('store', true);

        if (! $this->cms->isLogged())
        {
            redirect(site_url('login'));
        }

        $this->load->model([
            'store_model'       => 'store',
            'store_items_model' => 'store_items',
            'store_logs_model'  => 'store_logs'
        ]);

        $this->load->language('store');

        $this->template->set_partial('alerts', 'static/alerts');
    }

    public function index()
    {
        $this->template->title(config_item('app_name'), lang('store'));

        $this->template->build('index');
    }

    /**
     * View store category
     *
     * @param string $slug
     * @return string
     */
    public function category($slug = null)
    {
        $store = $this->store->find(['slug' => $slug]);

        if (empty($store))
        {
            show_404();
        }

        $raw_page = $this->input->get('page');
        $page     = ctype_digit((string) $raw_page) ? $raw_page : 0;
        $per_page = 15;

        $this->pagination->initialize([
            'base_url'    => site_url('store/' . $slug),
            'total_rows'  => $this->store_items->count_all($store->id),
            'per_page'    => $per_page,
            'uri_segment' => 3
        ]);

        // Calculate offset if use_page_numbers is TRUE on pagination
        $offset = ($page > 1) ? ($page - 1) * $per_page : $page;

        $data = [
            'items' => $this->store_items->find_all($store->id, $per_page, $offset),
            'links' => $this->pagination->create_links()
        ];

        $this->template->title(config_item('app_name'), lang('store'));

        $this->template->build('category', $data);
    }

    /**
     * View item
     *
     * @param int $item_id
     * @return string
     */
    public function item($item_id = null)
    {
        $item = $this->store_items->find(['id' => $item_id]);

        if (empty($item))
        {
            show_404();
        }

        $data = [
            'characters' => $this->characters->account_characters($item->realm_id, $this->session->userdata('id')),
            'item'       => $item
        ];

        $this->template->title(config_item('app_name'), lang('store'));

        if ($this->input->method() == 'post')
        {
            $this->form_validation->set_rules('guid', lang('character'), 'trim|required|is_natural_no_zero');
            $this->form_validation->set_rules('qty', lang('quantity'), 'trim|required|is_natural_no_zero');

            if ($this->form_validation->run() == FALSE)
            {
                $this->template->build('item', $data);
            }
            else
            {
                $guid = $this->input->post('guid');
                $qty  = $this->input->post('qty');

                if (! $this->characters->character_exists($item->realm_id, $guid))
                {
                    $this->session->set_flashdata('error', lang('character_not_exist'));
                    redirect(site_url('store/item/' . $item_id));
                }

                if (! $this->characters->character_linked($item->realm_id, $accountid, $guid))
                {
                    $this->session->set_flashdata('error', lang('character_not_related'));
                    redirect(site_url('store/item/' . $item_id));
                }

                $this->cart->insert([
                    'id'       => $item_id,
                    'name'     => $item->name,
                    'qty'      => $qty,
                    'dp'       => $item->dp,
                    'vp'       => $item->vp,
                    'realm'    => $item->realm_id,
                    'guid'     => $guid,
                    'options'  => [
                        'key'        => uniqid(),
                        'price_type' => $item->price_type
                    ]
                ]);

                $this->session->set_flashdata('success', lang('item_added_cart'));
                redirect(site_url('store/item/' . $item_id));
            }
        }
        else
        {
            $this->template->build('item', $data);
        }
    }

    public function cart()
    {
        $data = [
            'contents' => $this->cart->contents()
        ];

        $this->template->title(config_item('app_name'), lang('cart'));

        $this->template->build('cart', $data);
    }
 
     /**
     * Remove item from cart
     *
     * @param string $id
     * @return void
     */
    public function remove_item($id = null)
    {
        if (empty($id))
        {
            show_404();
        }

        if ($this->cart->remove($id))
        {
            $this->session->set_flashdata('success', lang('item_deleted_cart'));
            redirect(site_url('store/cart'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('item_error_cart'));
            redirect(site_url('store/cart'));
        }
    }

    public function update_quantity()
    {
        $this->form_validation->set_rules('id', lang('id'), 'trim|required');
        $this->form_validation->set_rules('qty', lang('quantity'), 'trim|required|is_natural_no_zero');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', lang('item_quantity_invalid'));
            redirect(site_url('store/cart'));
        }
        else
        {
            $this->cart->update([
                'rowid' => $this->input->post('id', TRUE),
                'qty'   => $this->input->post('qty')
            ]);

            $this->session->set_flashdata('success', lang('item_quantity_update'));
            redirect(site_url('store/cart'));
        }
    }

    public function checkout()
    {
        if (empty($this->cart->count_items()))
        {
            $this->session->set_flashdata('warning', lang('cart_empty'));
            redirect(site_url('store/cart'));
        }

        $ip   = $this->input->ip_address();
        $user = $this->cms->user();

        if ($user->vp < $this->cart->total_vp() && $user->dp < $this->cart->total_dp())
        {
            $this->session->set_flashdata('error', lang('user_not_points'));
            redirect(site_url('store/cart'));
        }

        foreach ($this->cart->contents() as $item)
        {
            $this->_send_item($user->id, $ip, $item);
        }

        $this->cart->destroy();

        $this->session->set_flashdata('success', lang('checkout_success'));
        redirect(site_url('store/cart'));
    }

    /**
     * Send purchased item to realm
     *
     * @param int $user
     * @param string $ip
     * @param array $item
     * @return bool
     */
    private function _send_item($user, $ip, array $item)
    {
        $row  = $this->store_items->find(['id' => $item['id']]);
        $name = $this->characters->character_name($item['realm'], $item['guid']);

        $placeholders = [
            '{character}' => $name,
            '{subject}'   => lang('soap_send_subject'),
            '{message}'   => lang('soap_send_body')
        ];

        $command  = strtr(trim($row->command), $placeholders);
        $total_dp = $item['dp'] * $item['qty'];
        $total_vp = $item['vp'] * $item['qty'];

        for ($i = 1; $i <= $item['qty']; $i++) {
            $result  = $this->realms->send_command($item['realm'], $command);

            $this->store_logs->create([
                'store_id'   => $row->store_id,
                'item_id'    => $item['id'],
                'user_id'    => $user,
                'guid'       => $item['guid'],
                'character'  => $name,
                'price_type' => $item['options']['price_type'],
                'dp'         => $item['dp'],
                'vp'         => $item['vp'],
                'result'     => $result,
                'ip'         => $ip,
                'created_at' => current_date()
            ]);
        }

        switch ($item['options']['price_type']) {
            case 'dp':
                $this->db->query("UPDATE users SET dp = dp - ? WHERE id = ?", [$total_dp, $user]);
                break;
            case 'vp':
                $this->db->query("UPDATE users SET vp = vp - ? WHERE id = ?", [$total_vp, $user]);
                break;
            case 'and':
                $this->db->query("UPDATE users SET dp = dp - ?, vp = vp - ? WHERE id = ?", [$total_dp, $total_vp, $user]);
                break;
        }

        return true;
    }
}
