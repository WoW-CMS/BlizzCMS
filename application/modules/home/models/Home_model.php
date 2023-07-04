<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{
    /**
     * Home_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getSlides()
    {
        return $this->db->order_by('id', 'ASC')
            ->get('slides');
    }

    public function getDiscordInfo()
    {
        error_reporting(0);

        if (! $this->wowmodule->getStatusModule('Discord')) {
            return [];
        }

        $cache = $this->cache->file->get('discordapi');

        if ($cache !== false) {
            return json_decode($cache, true);
        }

        $content = file_get_contents('https://discord.com/api/v10/invites/' . config_item('discord_invitation') . '?with_counts=true');

        $this->cache->file->save('discordapi', $content, 1800);

        return json_decode($content, true);
    }

    public function updateconfigs($data)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH . 'config/blizzcms.php', 'config');

        $bnet = $data['bnet'] == '1' ? true : false;

        $writer->write('website_name', $data['name']);
        $writer->write('discord_invitation', $data['invitation']);
        $writer->write('realmlist', $data['realmlist']);
        $writer->write('expansion', $data['expansion']);
        $writer->write('bnet_enabled', $bnet);
        $writer->write('emulator', $data['emulator']);
        $writer->write('migrate_status', '0');
    }
}
