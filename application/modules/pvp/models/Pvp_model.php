<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp_model extends CI_Model
{
    /**
     * Pvp_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param object $multirealm
     * @return mixed
     */
    public function getTop20PVP($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('name, race, class, totalKills, todayKills, yesterdayKills')
            ->where('name !=', '')
            ->order_by('totalKills', 'DESC')
            ->limit('20')
            ->get('characters');
    }

    /**
     * @param object $multirealm
     * @return mixed
     */
    public function getTopArena2v2($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('rating, seasonWins, arenaTeamId, name')
            ->where('type', 2)
            ->order_by('rating', 'DESC')
            ->limit('10')
            ->get('arena_team');
    }

    /**
     * @param object $multirealm
     * @return mixed
     */
    public function getTopArena3v3($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('rating, seasonWins, arenaTeamId, name')
            ->where('type', 3)
            ->order_by('rating', 'DESC')
            ->limit('10')
            ->get('arena_team');
    }

    /**
     * @param object $multirealm
     * @return mixed
     */
    public function getTopArena5v5($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('rating, seasonWins, arenaTeamId, name')
            ->where('type', 5)
            ->order_by('rating', 'DESC')
            ->limit('10')
            ->get('arena_team');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getMemberTeam($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('arenaTeamId', $id)
            ->get('arena_team_member');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getRaceGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('race');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getClassGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('class');
    }

    /**
     * @param int $id
     * @param object $multirealm
     * @return mixed
     */
    public function getNameGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('guid', $id)
            ->get('characters')
            ->row('name');
    }
}
