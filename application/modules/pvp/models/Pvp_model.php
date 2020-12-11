<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp_model extends CI_Model
{
	public function getTop20PVP($realm)
	{
		return $this->realm->char_connect($realm)->select('name, race, class, totalKills, todayKills, yesterdayKills')->where('name !=', '')->order_by('totalKills', 'DESC')->limit('20')->get('characters')->result();
	}

	public function getTopArena2v2($realm)
	{
		return $this->realm->char_connect($realm)->select('rating, seasonWins, arenaTeamId, name')->where('type', '2')->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	public function getTopArena3v3($realm)
	{
		return $this->realm->char_connect($realm)->select('rating, seasonWins, arenaTeamId, name')->where('type', '3')->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	public function getTopArena5v5($realm)
	{
		return $this->realm->char_connect($realm)->select('rating, seasonWins, arenaTeamId, name')->where('type', '5')->order_by('rating', 'DESC')->limit('10')->get('arena_team')->result();
	}

	public function getMemberTeam($realm, $team)
	{
		return $this->realm->char_connect($realm)->where('arenaTeamId', $team)->get('arena_team_member')->result();
	}

	public function getRaceGuid($realm, $guid)
	{
		return $this->realm->char_connect($realm)->where('guid', $guid)->get('characters')->row('race');
	}

	public function getClassGuid($realm, $guid)
	{
		return $this->realm->char_connect($realm)->where('guid', $id)->get('characters')->row('class');
	}

	public function getNameGuid($realm, $guid)
	{
		return $this->realm->char_connect($realm)->where('guid', $id)->get('characters')->row('name');
	}
}
