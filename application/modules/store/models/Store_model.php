<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model
{
	protected $store = 'store';
	protected $store_items = 'store_items';
	protected $store_logs = 'store_logs';

	/**
	 * Get all categories
	 *
	 * @param int $parent
	 * @return array
	 */
	public function get_all_categories($parent = 0)
	{
		return $this->db->where('parent', $parent)->get($this->store)->result();
	}

	/**
	 * Get category
	 *
	 * @param string|int $value
	 * @param string $column
	 * @return object
	 */
	public function get_category($value, $column = 'slug')
	{
		return $this->db->where($column, $value)->get($this->store)->row();
	}

	/**
	 * Find if the category exists
	 *
	 * @param string|int $value
	 * @param string $column
	 * @return boolean
	 */
	public function find_category($value, $column = 'slug')
	{
		$query = $this->db->where($column, $value)->get($this->store)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get all items of a category
	 *
	 * @param int $id
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all_items($id, $limit, $start)
	{
		return $this->db->where('store_id', $id)->limit($limit, $start)->get($this->store_items)->result();
	}

	/**
	 * Count all items of a category
	 *
	 * @param int|null $id
	 * @return int
	 */
	public function count_items($id = null)
	{
		if (is_null($id))
		{
			return $this->db->count_all($this->store_items);
		}

		return $this->db->where('store_id', $id)->count_all_results($this->store_items);
	}

	/**
	 * Get item
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_item($id)
	{
		return $this->db->where('id', $id)->get($this->store_items)->row();
	}

	/**
	 * Find if the item exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_item($id)
	{
		$query = $this->db->where('id', $id)->get($this->store_items)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get top items
	 *
	 * @return array
	 */
	public function get_top_items()
	{
		return $this->db->where('top', 1)->get($this->store_items)->result();
	}

	/**
	 * Purchase
	 *
	 * @return boolean
	 */
	public function purchase()
	{
		$vp = $this->cart->total_vp();
		$dp = $this->cart->total_dp();

		if ($this->website->get_user(null, 'vp') < $vp && $this->website->get_user(null, 'dp') < $dp)
		{
			return false;
		}

		foreach ($this->cart->contents() as $item)
		{
			$count = 1;
			while ($count <= $item['qty'])
			{
				$this->_send_item($item['id'], $item['guid']);
				$count++;
			}
		}

		$this->cart->destroy();

		return true;
	}

	/**
	 * Send item
	 *
	 * @param int $id
	 * @param int $guid
	 * @return boolean
	 */
	private function _send_item($id, $guid)
	{
		$user = $this->session->userdata('id');
		$item = $this->get_item($id);

		if (! $this->realm->character_exists($item->realm_id, $guid))
		{
			return false;
		}

		if (! $this->realm->character_linked($item->realm_id, $accountid, $guid))
		{
			return false;
		}

		$name = $this->realm->character_name($item->realm_id, $guid);

		$placeholders = [
			'{character}' => $name,
			'{subject}'   => lang('soap_send_subject'),
			'{message}'   => lang('soap_send_body')
		];

		$command = strtr(trim($row->command), $placeholders);
		$result  = $this->realm->send_command($item->realm_id, $command);

		switch ($item->price_type)
		{
			case 'dp':
				$this->db->query("UPDATE users SET dp = dp - ? WHERE id = ?", [$item->dp, $user]);
				break;
			case 'vp':
				$this->db->query("UPDATE users SET vp = vp - ? WHERE id = ?", [$item->vp, $user]);
				break;
			case 'and':
				$this->db->query("UPDATE users SET dp = dp - ?, vp = vp - ? WHERE id = ?", [$item->dp, $item->vp, $user]);
				break;
		}

		$this->db->insert($this->store_logs, [
			'store_id'   => $item->store_id,
			'item_id'    => $item->id,
			'user_id'    => $user,
			'guid'       => $guid,
			'character'  => $name,
			'price_type' => $item->price_type,
			'dp'         => $item->dp,
			'vp'         => $item->vp,
			'result'     => $result,
			'created_at' => current_date()
		]);

		return true;
	}

	/**
	 * Count all logs
	 *
	 * @return int
	 */
	public function count_logs($search = '')
	{
		if ($search === '')
		{
			return $this->db->count_all($this->store_logs);
		}

		return $this->db->select('store_logs.*, users.username')->from($this->store_logs)->join('users', 'store_logs.user_id = users.id')->like('store_logs.price_type', $search)->or_like('store_logs.character', $search)->or_like('users.username', $search)->count_all_results();
	}

	/**
	 * Get all logs
	 *
	 * @param int $limit
	 * @param int $start
	 * @param string $search
	 * @return array
	 */
	public function get_all_logs($limit, $start, $search = '')
	{
		if ($search === '')
		{
			return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->store_logs)->result();
		}

		return $this->db->select('store_logs.*, users.username')->from($this->store_logs)->join('users', 'store_logs.user_id = users.id')->like('store_logs.price_type', $search)->or_like('store_logs.character', $search)->or_like('users.username', $search)->order_by('store_logs.id', 'DESC')->limit($limit, $start)->get()->result();
	}

	/**
	 * Get log
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_log($id)
	{
		return $this->db->where('id', $id)->get($this->store_logs)->row();
	}

	/**
	 * Find if the log exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_log($id)
	{
		$query = $this->db->where('id', $id)->get($this->store_logs)->num_rows();

		return $query == 1;
	}
}
