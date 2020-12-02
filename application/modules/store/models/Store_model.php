<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model
{
	protected $top;
	protected $item;
	protected $categories;

	/**
	 * Store_model constructor.
	 */
	public function __construct()
	{
		$this->top = 'store_top';
		$this->item = 'store_items';
		$this->categories = 'store_categories';
	}

	public function getStoreTop()
	{
		return $this->db->order_by('id', 'ASC')->limit('15')->get($this->top)->result();
	}

	public function getName($id)
	{
		return $this->db->select('name')->where('id', $id)->get($this->item)->row('name');
	}

	public function getDescription($id)
	{
		return $this->db->select('description')->where('id', $id)->get($this->item)->row('description');
	}

	public function getCategory($id)
	{
		return $this->db->select('category')->where('id', $id)->get($this->item)->row('category');
	}

	public function getType($id)
	{
		return $this->db->select('type')->where('id', $id)->get($this->item)->row('type');
	}

	public function getPriceType($id)
	{
		return $this->db->select('price_type')->where('id', $id)->get($this->item)->row('price_type');
	}

	public function getPriceDP($id)
	{
		return $this->db->select('dp')->where('id', $id)->get($this->item)->row('dp');
	}

	public function getPriceVP($id)
	{
		return $this->db->select('vp')->where('id', $id)->get($this->item)->row('vp');
	}

	public function getIcon($id)
	{
		return $this->db->select('icon')->where('id', $id)->get($this->item)->row('icon');
	}

	public function getCommand($id)
	{
		return $this->db->select('command')->where('id', $id)->get($this->item)->row('command');
	}

	public function getItemExist($id)
	{
		return $this->db->where('id', $id)->get($this->item)->num_rows();
	}

	public function getRoute($id)
	{
		return $this->db->select('route')->where('id', $id)->get($this->categories)->row('route');
	}

	public function getCategoryExist($route)
	{
		return $this->db->select('route')->where('route', $route)->get($this->categories)->num_rows();
	}

	public function getCategoryId($route)
	{
		return $this->db->select('id')->where('route', $route)->get($this->categories)->row('id');
	}

	public function getCategoryName($route)
	{
		return $this->db->select('name')->where('route', $route)->get($this->categories)->row('name');
	}

	public function getCategoryRealm($route)
	{
		return $this->db->select('realmid')->where('route', $route)->get($this->categories)->row('realmid');
	}

	public function getCategoryRealmId($category)
	{
		return $this->db->select('realmid')->where('id', $category)->get($this->categories)->row('realmid');
	}

	public function getCategoryItems($route)
	{
		$id = $this->getCategoryId($route);
		return $this->db->where('category', $id)->get($this->item)->result();
	}

	public function getCategories($realmid)
	{
		return $this->db->where('realmid', $realmid)->get($this->categories);
	}

	public function getItem($id)
	{
		return $this->db->where('id', $id)->get($this->item)->row_array();
	}

	public function insertStoreLog($accountid, $charid, $name, $type, $pricetype, $dp, $vp)
	{
		$date = now();

		$data = array(
			'accountid' => $accountid,
			'charid' => $charid,
			'item_name' => $name,
			'type' => $type,
			'price_type' => $pricetype,
			'dp' => $dp,
			'vp' => $vp,
			'date' => $date
		);

		$this->db->insert('store_logs', $data);
	}

	public function PurchaseItem($id, $charid)
	{
		$accountid = $this->session->userdata('id');
		$item = $this->getItem($id);
		$realm = $this->getCategoryRealmId($item['category']);
		$info = $this->realm->getRealm($realm)->row_array();

		$dpprice = $item['dp'];
		$vpprice = $item['vp'];

		$multirealm = $this->realm->getRealmConnectionData($realm);
		$charname = $this->realm->getNameCharacterSpecifyGuid($multirealm, $charid);
		$charexist = $this->realm->getCharExistGuid($multirealm, $charid);
		$charcheck = $this->realm->getAccountCharGuid($multirealm, $charid);
		$subject = lang('soap_send_subject');
		$message = lang('soap_send_body');

		if($charexist > 0 && $charcheck == $accountid)
		{
			if($item['price_type'] == 1)
			{
				if ($item['type'] == 1)
				{
					$this->realm->commandSoap('.send items '.$charname.' "'.$subject.'" "'.$message.'" '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 2)
				{
					$this->realm->commandSoap('.send money '.$charname.' "'.$subject.'" "'.$message.'" '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 3)
				{
					$this->realm->commandSoap('.character level '.$charname.' '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 4)
				{
					$this->realm->commandSoap('.character rename '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 5)
				{
					$this->realm->commandSoap('.character customize '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 6)
				{
					$this->realm->commandSoap('.character changefaction '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 7)
				{
					$this->realm->commandSoap('.character changerace '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}

				$this->db->query("UPDATE users SET dp = (dp-$dpprice) WHERE id = $accountid");
				$this->insertStoreLog($accountid, $charid, $item['name'], $item['type'], $item['price_type'], $dpprice, '0');
				return true;
			}
			else if ($item['price_type'] == 2)
			{
				if ($item['type'] == 1)
				{
					$this->realm->commandSoap('.send items '.$charname.' "'.$subject.'" "'.$message.'" '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 2)
				{
					$this->realm->commandSoap('.send money '.$charname.' "'.$subject.'" "'.$message.'" '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 3)
				{
					$this->realm->commandSoap('.character level '.$charname.' '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 4)
				{
					$this->realm->commandSoap('.character rename '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 5)
				{
					$this->realm->commandSoap('.character customize '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 6)
				{
					$this->realm->commandSoap('.character changefaction '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 7)
				{
					$this->realm->commandSoap('.character changerace '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}

				$this->db->query("UPDATE users SET vp = (vp-$vpprice) WHERE id = $accountid");
				$this->insertStoreLog($accountid, $charid, $item['name'], $item['type'], $item['price_type'], '0', $vpprice);
				return true;
			}
			else if ($item['price_type'] == 3)
			{
				if ($item['type'] == 1)
				{
					$this->realm->commandSoap('.send items '.$charname.' "'.$subject.'" "'.$message.'" '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 2)
				{
					$this->realm->commandSoap('.send money '.$charname.' "'.$subject.'" "'.$message.'" '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 3)
				{
					$this->realm->commandSoap('.character level '.$charname.' '.$item['command'], $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 4)
				{
					$this->realm->commandSoap('.character rename '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 5)
				{
					$this->realm->commandSoap('.character customize '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 6)
				{
					$this->realm->commandSoap('.character changefaction '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}
				else if ($item['type'] == 7)
				{
					$this->realm->commandSoap('.character changerace '.$charname.' ', $info['console_username'], $info['console_password'], $info['console_hostname'], $info['console_port'], $info['emulator']);
				}

				$this->db->query("UPDATE users SET dp = (dp-$dpprice), vp = (vp-$vpprice) WHERE id = $accountid");
				$this->insertStoreLog($accountid, $charid, $item['name'], $item['type'], $item['price_type'], $dpprice, $vpprice);
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}

	public function Checkout()
	{
		$dptotal = $this->cart->total_dp();
		$vptotal = $this->cart->total_vp();

		if ($this->website->get_user(null, 'dp') >= $dptotal && $this->website->get_user(null, 'vp') >= $vptotal)
		{
			foreach($this->cart->contents() as $item)
			{
				$count = 1;
				while ($count <= $item['qty'])
				{
					$this->PurchaseItem($item['id'], $item['guid']);
					$count++;
				}
			}

			$this->cart->destroy();
			return true;
		}
		else
			return 'insPoints';
	}

	public function getChildStoreCategory($id)
	{
		return $this->db->where('father', $id)->get($this->categories);
	}
}
