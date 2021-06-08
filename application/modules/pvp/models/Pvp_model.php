<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp_model extends CI_Model
{
    /**
     * Get the top characters in pvp of a realm
     *
     * @param int $realm
     * @param int $limit
     * @return array
     */
    public function top_pvp($realm, $limit = 20)
    {
        return $this->characters->connect($realm)
                    ->select('name, race, class, gender, level, totalKills, todayKills, yesterdayKills')
                    ->where('name !=', '')
                    ->order_by('totalKills', 'DESC')
                    ->limit($limit)
                    ->get('characters')
                    ->result();
    }

    /**
     * Get the top teams in arena
     *
     * @param int $realm
     * @param int $type
     * @param int $limit
     * @return array
     */
    public function top_teams($realm, $type = 2, $limit = 10)
    {
        $emulator = config_item('emulator');

        if (in_array($emulator, ['cmangos', 'mangos'], true)) {
            return $this->characters->connect($realm)
                        ->select('arena_team.name, arena_team.arenateamid, arena_team_stats.rating, arena_team_stats.wins_season AS seasonwins')
                        ->from('arena_team')
                        ->join('arena_team_stats', 'arena_team.arenateamid = arena_team_stats.arenateamid')
                        ->where('arena_team.type', $type)
                        ->order_by('arena_team_stats.rating', 'DESC')
                        ->limit($limit)
                        ->get()
                        ->result();
        }

        return $this->characters->connect($realm)
                    ->select('name, rating, seasonWins AS seasonwins, arenaTeamId AS arenateamid')
                    ->where('type', $type)
                    ->order_by('rating', 'DESC')
                    ->limit($limit)
                    ->get('arena_team')
                    ->result();
    }

    /**
     * Get the arena team members of a realm
     *
     * @param int $realm
     * @param int $team
     * @return array
     */
    public function team_members($realm, $team)
    {
        $emulator = config_item('emulator');

        if (in_array($emulator, ['cmangos', 'mangos'], true)) {
            return $this->characters->connect($realm)
                        ->select('guid, played_week AS weekgames, wons_week AS weekwins, played_season AS seasongames, wons_season AS seasonwins, personal_rating AS personalrating')
                        ->where('arenateamid', $team)
                        ->get('arena_team_member')
                        ->result();
        }

        return $this->characters->connect($realm)
                    ->select('guid, weekGames AS weekgames, weekWins AS weekwins, seasonGames AS seasongames, seasonWins AS seasonwins, personalRating AS personalrating')
                    ->where('arenaTeamId', $team)
                    ->get('arena_team_member')
                    ->result();
    }
}
