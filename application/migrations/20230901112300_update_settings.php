<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_settings extends CI_Migration
{
    public function up()
    {
        $this->setting_model->update([
            'key' => 'social_x'
        ], ['key' => 'social_twitter']);

        $this->setting_model->insert_batch([
            ['key' => 'social_reddit', 'value' => NULL, 'type' => 'string'],
            ['key' => 'social_twitch', 'value' => NULL, 'type' => 'string']
        ]);
    }

    public function down()
    {
        $this->setting_model->update([
            'key' => 'social_twitter'
        ], ['key' => 'social_x']);

        $this->setting_model->delete_in('key', [
            'social_reddit',
            'social_twitch'
        ]);
    }
}
