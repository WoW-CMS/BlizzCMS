<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_model extends CI_Model
{
	public function get_players($realm)
	{
		$data = $this->cache->file->get('online_players');

		if ($data !== false)
		{
			return $data;
		}

		$query = $this->realm->char_connect($realm)->select('name, race, class, level, zone')->where('online', '1')->order_by('name', 'DESC')->get('characters')->result();

		$this->cache->file->save('online_players', $query, 300);

		return $query;
	}
}
