<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_table_settings extends CI_Migration
{
    public function up()
    {
        $this->db->insert_batch('settings', [
            ['key' => 'paypal_currency', 'value' => 'USD'],
            ['key' => 'paypal_gateway', 'value' => 'false'],
            ['key' => 'paypal_mode', 'value' => NULL],
            ['key' => 'paypal_client', 'value' => NULL],
            ['key' => 'paypal_secret', 'value' => NULL],
            ['key' => 'paypal_minimal_amount', 'value' => 1],
            ['key' => 'paypal_currency_rate', 'value' => 1],
            ['key' => 'paypal_points_rate', 'value' => 1]
        ]);
    }

    public function down()
    {
        $this->db->where_in('key', [
            'paypal_currency',
            'paypal_gateway',
            'paypal_mode',
            'paypal_client',
            'paypal_secret',
            'paypal_minimal_amount',
            'paypal_currency_rate',
            'paypal_points_rate'
        ])->delete('settings');
    }
}