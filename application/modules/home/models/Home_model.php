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
    }

    public function getSlides()
    {
        return $this->db->select('*')->order_by('id', 'ASC')->get('slides');
    }

    public function getDiscordInfo()
    {
        $invitation = $this->config->item('discord_invitation');
        error_reporting(0);

        if ($this->wowmodule->getDiscordStatus() && strlen($invitation) == 7)
        {
            $discordapi = $this->cache->file->get('discordapi');

            if ($discordapi !== false) {
                $api = json_decode($discordapi, true);
                return $api;
            }
            else {
                $this->cache->file->save('discordapi', file_get_contents('https://discordapp.com/api/v6/invite/'.$invitation.'?with_counts=true'), 300);
                $check = $this->cache->file->get('discordapi');

                if ($check !== false)
                    return $this->getDiscordInfo();
            }
        }
    }

    public function updateconfigs($name, $discord, $realmlist, $expansion, $license)
    {
        $this->load->library('config_writer');
        $blizz = $this->config_writer->get_instance(APPPATH.'config/blizzcms.php', 'config');
        $plus = $this->config_writer->get_instance(APPPATH.'config/plus.php', 'config');

        $blizz->write('website_name', $name);
        $blizz->write('discord_invitation', $discord);
        $blizz->write('realmlist', $realmlist);
        $blizz->write('expansion', $expansion);
        $blizz->write('migrate_status', '0');
        $plus->write('license_plus', $license);
        return true;
    }
}
