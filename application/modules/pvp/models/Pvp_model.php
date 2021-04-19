<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp_model extends CI_Model
{
	/**
	 * Get the top characters in pvp of a realm
	 *
	 * @param int $realm
	 * @return array
	 */
	public function get_top_pvp($realm)
	{
		return $this->realm->char_connect($realm)->select('name, race, class, totalKills, todayKills, yesterdayKills')->where('name !=', '')->order_by('totalKills', 'DESC')->limit('20')->get('characters')->result();
	}

	/**
	 * Get the top teams in arena
	 *
	 * @param int $realm
	 * @param int $type
	 * @return array
	 */
	public function get_top_teams($realm, $type = 2)
	{
		$emulator = config_item('emulator');

		if (in_array($emulator, ['cmangos', 'mangos'], true))
		{
			return $this->realm->char_connect($realm)->select('arena_team.name, arena_team.arenateamid, arena_team_stats.rating, arena_team_stats.wins_season AS seasonwins')->from('arena_team')->join('arena_team_stats', 'arena_team.arenateamid = arena_team_stats.arenateamid')->where('arena_team.type', $type)->order_by('arena_team_stats.rating', 'DESC')->limit('10')->get()->result();
		}

		return $this->realm->char_connect($realm)->select('name, rating, seasonWins AS seasonwins, arenaTeamId AS arenateamid')->where('type', $type)->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	/**
	 * Get the arena team members of a realm
	 *
	 * @param int $realm
	 * @return array
	 */
	public function get_team_members($realm, $team)
	{
		$emulator = config_item('emulator');

		if (in_array($emulator, ['cmangos', 'mangos'], true))
		{
			return $this->realm->char_connect($realm)->select('guid, played_week AS weekgames, wons_week AS weekwins, played_season AS seasongames, wons_season AS seasonwins, personal_rating AS personalrating')->where('arenateamid', $team)->get('arena_team_member')->result();
		}

		return $this->realm->char_connect($realm)->select('guid, weekGames AS weekgames, weekWins AS weekwins, seasonGames AS seasongames, seasonWins AS seasonwins, personalRating AS personalrating')->where('arenaTeamId', $team)->get('arena_team_member')->result();
	}

	/**
	 * Get the race of a character in a realm
	 *
	 * @param int $realm
	 * @param int $guid
	 * @return int
	 */
	public function get_char_race($realm, $guid)
	{
		return $this->realm->char_connect($realm)->where('guid', $guid)->get('characters')->row('race');
	}

	/**
	 * Get the class of a character in a realm
	 *
	 * @param int $realm
	 * @param int $guid
	 * @return int
	 */
	public function get_char_class($realm, $guid)
	{
		return $this->realm->char_connect($realm)->where('guid', $guid)->get('characters')->row('class');
	}

	/**
	 * Get the name of a character in a realm
	 *
	 * @param int $realm
	 * @param int $guid
	 * @return string
	 */
	public function get_char_name($realm, $guid)
	{
		return $this->realm->char_connect($realm)->where('guid', $guid)->get('characters')->row('name');
	}
}
