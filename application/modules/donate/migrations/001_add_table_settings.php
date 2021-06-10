<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_table_settings extends CI_Migration
{
    public function up()
    {
        $data = array(
            array('key' => 'paypal_currency', 'value' => 'USD'),
            array('key' => 'paypal_gateway', 'value' => 'false'),
            array('key' => 'paypal_mode', 'value' => NULL),
            array('key' => 'paypal_client', 'value' => NULL),
            array('key' => 'paypal_secret', 'value' => NULL),
            array('key' => 'paypal_minimal_amount', 'value' => 1),
            array('key' => 'paypal_currency_rate', 'value' => 1),
            array('key' => 'paypal_points_rate', 'value' => 1)
        );
        $this->db->insert_batch('settings', $data);
    }

    public function down()
    {
        $data = array(
            'paypal_currency',
            'paypal_gateway',
            'paypal_mode',
            'paypal_client',
            'paypal_secret',
            'paypal_minimal_amount',
            'paypal_currency_rate',
            'paypal_points_rate'
        );
        $this->db->where_in('key', $data)->delete('settings');
    }
}