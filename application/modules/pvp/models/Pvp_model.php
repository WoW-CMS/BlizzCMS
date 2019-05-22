<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp_model extends CI_Model {

    /**
     * Pvp_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getTop20PVP($MultiRealm)
    {
        $this->multirealm = $MultiRealm;
        return $this->multirealm->select('name, race, class, totalKills, todayKills, yesterdayKills')->where('name !=', '')->order_by('totalKills', 'DESC')->limit('20')->get('characters');
    }

    public function getTopArena2v2($multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('rating, seasonWins, arenaTeamId, name')->where('type', '2')->order_by('rating', 'DESC')->limit('10')->get('arena_team');
    }

    public function getTopArena3v3($multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('rating, seasonWins, arenaTeamId, name')->where('type', '3')->order_by('rating', 'DESC')->limit('10')->get('arena_team');
    }

    public function getTopArena5v5($multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('rating, seasonWins, arenaTeamId, name')->where('type', '5')->order_by('rating', 'DESC')->limit('10')->get('arena_team');
    }

    public function getMemberTeam($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('*')->where('arenaTeamId', $id)->get('arena_team_member');
    }

    public function getRaceGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('race')->where('guid', $id)->get('characters')->row('race');
    }

    public function getClassGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('class')->where('guid', $id)->get('characters')->row('class');
    }

    public function getNameGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')->where('guid', $id)->get('characters')->row('name');
    }
}
