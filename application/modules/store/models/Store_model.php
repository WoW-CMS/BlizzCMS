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

    /**
     * @return object
     */
    public function getStoreTop()
    {
        return $this->db->order_by('id', 'ASC')
            ->limit('15')
            ->get($this->top)
            ->result();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getName($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDescription($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('description');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCategory($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('category');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getType($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPriceType($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('price_type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPriceDP($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('dp');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPriceVP($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('vp');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getIcon($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('icon');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCommand($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row('command');
    }

    /**
     * @param int $id
     * @return int
     */
    public function getItemExist($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRoute($id)
    {
        return $this->db->where('id', $id)
            ->get($this->categories)
            ->row('route');
    }

    /**
     * @param string $route
     * @return int
     */
    public function getCategoryExist($route)
    {
        return $this->db->where('route', $route)
            ->get($this->categories)
            ->num_rows();
    }

    /**
     * @param string $route
     * @return mixed
     */
    public function getCategoryId($route)
    {
        return $this->db->where('route', $route)
            ->get($this->categories)
            ->row('id');
    }

    /**
     * @param string $route
     * @return mixed
     */
    public function getCategoryName($route)
    {
        return $this->db->where('route', $route)
            ->get($this->categories)
            ->row('name');
    }

    /**
     * @param string $route
     * @return mixed
     */
    public function getCategoryRealm($route)
    {
        return $this->db->where('route', $route)
            ->get($this->categories)
            ->row('realmid');
    }

    /**
     * @param int $category
     * @return mixed
     */
    public function getCategoryRealmId($category)
    {
        return $this->db->where('id', $category)
            ->get($this->categories)
            ->row('realmid');
    }

    /**
     * @param string $route
     * @return mixed
     */
    public function getCategoryItems($route)
    {
        $id = $this->getCategoryId($route);

        return $this->db->where('category', $id)
            ->get($this->item)
            ->result();
    }

    /**
     * @param int $realmid
     * @return mixed
     */
    public function getCategories($realmid)
    {
        return $this->db->where('realmid', $realmid)
            ->get($this->categories);
    }

    /**
     * @param int $id
     * @return object
     */
    public function getItem($id)
    {
        return $this->db->where('id', $id)
            ->get($this->item)
            ->row();
    }

    public function insertStoreLog($accountid, $charid, $name, $type, $pricetype, $dp, $vp)
    {
        $this->db->insert('store_logs', [
            'accountid'  => $accountid,
            'charid'     => $charid,
            'item_name'  => $name,
            'type'       => $type,
            'price_type' => $pricetype,
            'dp'         => $dp,
            'vp'         => $vp,
            'date'       => $this->wowgeneral->getTimestamp()
        ]);
    }

    /**
     * @param int $id
     * @param int $charid
     * @return bool
     */
    public function PurchaseItem($id, $charid)
    {
        $item    = $this->getItem($id);
        $realmid = $this->getCategoryRealmId($item->category);

        $userid     = $this->session->userdata('wow_sess_id');
        $multirealm = $this->wowrealm->getRealmConnectionData($realmid);

        if ($this->wowrealm->getCharExistGuid($multirealm, $charid) !== 1) {
            return false;
        }

        if ($this->wowrealm->getAccountCharGuid($multirealm, $charid) !== $userid) {
            return false;
        }

        $subject  = lang('soap_send_subject');
        $message  = lang('soap_send_body');
        $realm    = $this->wowrealm->getRealm($realmid)->row_array();
        $charname = $this->wowrealm->getNameCharacterSpecifyGuid($multirealm, $charid);

        switch ($item->type) {
            case 1:
                $command = '.send items ' . $charname . ' "' . $subject . '" "' . $message . '" ' . $item->command;
                break;

            case 2:
                $command = '.send money ' . $charname . ' "' . $subject . '" "' . $message . '" ' . $item->command;
                break;

            case 3:
                $command = '.character level ' . $charname . ' ' . $item->command;
                break;

            case 4:
                $command = '.character rename ' . $charname;
                break;

            case 5:
                $command = '.character customize ' . $charname;
                break;

            case 6:
                $command = '.character changefaction ' . $charname;
                break;

            case 7:
                $command = '.character changerace ' . $charname;
                break;

            default:
                break;
        }

        if (! isset($command)) {
            return false;
        }

        $this->wowrealm->commandSoap($command, $realm['console_username'], $realm['console_password'], $realm['console_hostname'], $realm['console_port'], $realm['emulator']);

        if ($item->price_type == 1) {
            $this->db->query("UPDATE users SET dp = (dp-$item->dp) WHERE id = $userid");
        } elseif ($item->price_type == 2) {
            $this->db->query("UPDATE users SET vp = (vp-$item->vp) WHERE id = $userid");
        } else {
            $this->db->query("UPDATE users SET dp = (dp-$item->dp), vp = (vp-$item->vp) WHERE id = $userid");
        }

        $this->insertStoreLog($userid, $charid, $item->name, $item->type, $item->price_type, $item->dp, $item->vp);
        return true;
    }

    public function Checkout()
    {
        $userid = $this->session->userdata('wow_sess_id');

        if ($this->wowgeneral->getCharDPTotal($userid) < $this->cart->total_dp()) {
            return 'insPoints';
        }

        if ($this->wowgeneral->getCharVPTotal($userid) < $this->cart->total_vp()) {
            return 'insPoints';
        }

        foreach ($this->cart->contents() as $item) {
            $count = 1;
            while ($count <= $item['qty']) {
                $this->PurchaseItem($item['id'], $item['guid']);
                $count++;
            }
        }

        $this->cart->destroy();
        return true;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getChildStoreCategory($id)
    {
        return $this->db->where('father', $id)
            ->get($this->categories);
    }
}
