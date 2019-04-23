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
        if ($this->wowmodule->getDiscordStatus())
        {
            $invitation = $this->config->item('discord_invitation');
            $discord = file_get_contents('https://discordapp.com/api/v6/invite/'.$invitation.'?with_counts=true');
            $vars = json_decode($discord, true);
            return $vars;
        }
    }

    public function updateInstallation()
    {
        $this->db->set('status', '0')->where('id', '1')->update('modules');
    }
}
