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
	 * Get the top teams in arena 2v2 of a realm
	 *
	 * @param int $realm
	 * @return array
	 */
	public function get_teams_2v2($realm)
	{
		return $this->realm->char_connect($realm)->select('rating, seasonWins, arenaTeamId, name')->where('type', '2')->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	/**
	 * Get the top teams in arena 3v3 of a realm
	 *
	 * @param int $realm
	 * @return array
	 */
	public function get_teams_3v3($realm)
	{
		return $this->realm->char_connect($realm)->select('rating, seasonWins, arenaTeamId, name')->where('type', '3')->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	/**
	 * Get the top teams in arena 5v5 of a realm
	 *
	 * @param int $realm
	 * @return array
	 */
	public function get_teams_5v5($realm)
	{
		return $this->realm->char_connect($realm)->select('rating, seasonWins, arenaTeamId, name')->where('type', '5')->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	/**
	 * Get the arena team members of a realm
	 *
	 * @param int $realm
	 * @return array
	 */
	public function get_team_members($realm, $team)
	{
		return $this->realm->char_connect($realm)->where('arenaTeamId', $team)->get('arena_team_member')->result();
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
