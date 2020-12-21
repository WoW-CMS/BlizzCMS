<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	public function insertBanAccount($iduser, $reason)
	{
		$date = now();
		$id = $this->session->userdata('id');

		if (empty($reason))
			$reason = lang('log_banned');

		$data2 = array(
			'id' => $iduser,
			'bandate' => $date,
			'unbandate' => $date,
			'bannedby' => $id,
			'banreason' => $reason,
		);

		$this->auth->connect()->insert('account_banned', $data2);

		if (config_item('emulator_bnet') == 'true')
		{
			$this->auth->connect()->insert('battlenet_account_bans', $data2);
		}

		return true;
	}

	public function delBanAccount($id)
	{
		$this->auth->connect()->where('id', $id)->delete('account_banned');

		if (config_item('emulator_bnet') == 'true')
		{
			$this->auth->connect()->where('id', $id)->delete('battlenet_account_bans');
		}

		return true;
	}


	public function insertRankAccount($id, $gmlevel)
	{
		$this->auth->connect()->insert('account_access', [
			'id' => $id,
			'gmlevel' => $gmlevel,
			'RealmID' => '-1'
		]);

		return true;
	}

	public function delRankAccount($id)
	{
		$this->auth->connect()->where('id', $id)->delete('account_access');
		return true;
	}
}
