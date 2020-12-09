<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	public function getUserHistoryDonate($id)
	{
		return $this->db->where('user_id', $id)->order_by('id', 'DESC')->get('donate_logs')->result();
	}

	public function getDonateStatus($id)
	{
		switch ($id) {
			case 0: return lang('status_cancelled'); break;
			case 1: return lang('status_completed'); break;
		}
	}

	public function updateAccountData($id, $dp, $vp)
	{
		$this->db->where('id', $id)->update('users', [
			'dp' => $dp,
			'vp' => $vp
		]);

		return true;
	}

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

	public function getDropDownsSpecify()
	{
		return $this->db->where('main', '2')->where('father', '0')->get('store_categories');
	}

	public function getCategoryStore()
	{
		return $this->db->get('store_categories');
	}

	public function getStoreCategoryName($id)
	{
		return $this->db->select('name')->where('id', $id)->get('store_categories')->row('name');
	}

	public function getStoreCategoryRealm($id)
	{
		return $this->db->select('realmid')->where('id', $id)->get('store_categories')->row('realmid');
	}

	public function getStoreItems()
	{
		return $this->db->order_by('id', 'ASC')->get('store_items')->result();
	}

	public function getItemSpecifyName($id)
	{
		return $this->db->select('name')->where('id', $id)->get('store_items')->row('name');
	}

	public function getItemSpecifyCategory($id)
	{
		return $this->db->select('category')->where('id', $id)->get('store_items')->row('category');
	}

	public function getForumCategoryList()
	{
		return $this->db->order_by('id', 'ASC')->get('forum_category');
	}
}
