<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    /**
     * Home_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
        $this->load->config('home');
    }

    public function getSlides()
    {
        return $this->db->select('*')->order_by('id', 'ASC')->get('slides');
    }

    public function getDiscordInfo()
    {
        $invitation = $this->config->item('discord_invitation');
        error_reporting(0);

		if ($this->wowmodule->getStatusModule('Discord'))
        {
            $discordapi = $this->cache->file->get('discordapi');

            if ($discordapi !== false) {
                $api = json_decode($discordapi, true);
                return $api;
            }
            else {
                $this->cache->file->save('discordapi', file_get_contents('https://discordapp.com/api/v8/invites/'.$invitation.'?with_counts=true'), 300);
                $check = $this->cache->file->get('discordapi');

                if ($check !== false)
                    return $this->getDiscordInfo();
            }
        }
    }

    public function updateconfigs($data)
    {
        $this->load->library('config_writer');
        $blizz = $this->config_writer->get_instance(APPPATH.'config/blizzcms.php', 'config');
       
        if ($this->config_writer->isEnabled($data['bnet'])) 
            $bnet_enable = true;
        else
            $bnet_enable = false;

        $blizz->write('website_name', $data['name']);
        $blizz->write('discord_invitation', $data['invitation']);
        $blizz->write('realmlist', $data['realmlist']);
        $blizz->write('expansion', $data['expansion']);
        $blizz->write('bnet_enabled', $bnet_enable);
        $blizz->write('emulator', $data['emulator']);
        $blizz->write('migrate_status', '0');
        
    }
}
