<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getShopTop10()
    {
        return $this->db->select('id_store')
                ->order_by('id', "DESC")
                ->limit('10')
                ->get('store_top'); 
    }

    public function getShopTop()
    {
        return $this->db->select('*')
                ->order_by('id', 'ASC')
                ->get('store_top');
    }

    public function getExistItem($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('store_items')
                ->num_rows();
    }

    public function getType($id)
    {
        return $this->db->select('type')
                ->where('id', $id)
                ->get('store_items')
                ->row('type');
    }

    public function getItem($id)
    {
        return $this->db->select('itemid')
                ->where('id', $id)
                ->get('store_items')
                ->row('itemid');
    }

    public function getQuery($id)
    {
        return $this->db->select('qquery')
                ->where('id', $id)
                ->get('store_items')
                ->row('qquery');
    }

    public function getIcon($id)
    {
        return $this->db->select('icon')
                ->where('id', $id)
                ->get('store_items')
                ->row('icon');
    }

    public function getName($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('store_items')
                ->row_array()['name'];
    }

    public function getImage($id)
    {
        return $this->db->select('image')
                ->where('id', $id)
                ->get('store_items')
                ->row_array()['image'];
    }

    public function getGroup($id)
    {
        return $this->db->select('category')
                ->where('id', $id)
                ->get('store_items')
                ->row('category');
    }

    public function getPriceType($id, $type)
    {
        if ($type == "dp")
            return $this->db->select('price_dp')
                    ->where('id', $id)
                    ->get('store_items')
                    ->row('price_dp');

        if ($type == "vp")
            return $this->db->select('price_vp')
                    ->where('id', $id)
                    ->get('store_items')
                    ->row('price_vp');
    }

    public function getVPTrue($id)
    {
        $qq = $this->db->select('price_vp')
                    ->where('id', $id)
                    ->get('store_items')
                    ->row('price_vp');

        if (!is_null($qq) && $qq > 0)
            return true;
        else
            redirect(base_url('store'),'refresh');
    }

    public function getDPTrue($id)
    {
        $qq = $this->db->select('price_dp')
                    ->where('id', $id)
                    ->get('store_items')
                    ->row('price_dp');

        if (!is_null($qq) && $qq > 0)
            return true;
        else
            redirect(base_url('store'),'refresh');
    }

    public function getShopGeneral($id)
    {
        if($id != '' && $id != '0') {
            return $this->db->select('*')
                ->where('category', $id)
                ->get('store_items');
        } else {
            return $this->db->select('*')
                ->get('store_items');
        }
    }

    public function getShopGeneralGP($id)
    {
        return $this->db->select('*')
                ->where('category', $id)
                ->get('store_items');
    }

    public function getGroups()
    {
        return $this->db->select('*')
                ->get('store_categories');
    }

    public function getSpecifyGroup($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('store_categories')
                ->row_array()['name'];
    }

    public function insertHistory($idstore, $itemid, $accountid, $charid, $method, $price, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri, $multirealm)
    {
        $date = $this->m_data->getTimestamp();

        $multirealm = $this->m_data->getRealmConnectionData($multirealm);
        $getCharName = $this->m_characters->getNameCharacterSpecifyGuid($multirealm, $charid);
        
        $subject = $this->lang->line('store_senditem_subject');
        $message = $this->lang->line('store_senditem_text');

        $this->m_soap->commandSoap('.send items '.$getCharName.' "'.$subject.'" "'.$message.'" '.$itemid, $soapUser, $soapPass, $soapHost, $soapPort, $soap_uri);

        $data = array(
            'idstore' => $idstore,
            'itemid' => $itemid,
            'date' => $date,
            'accountid' => $accountid,
            'charid' => $charid,
            'method' => $method,
            );

        $this->db->insert('store_logs', $data);

        if ($method == "dp")
            $this->db->query("UPDATE users_data SET dp = (dp-$price) WHERE accountid = $accountid");
        else
            $this->db->query("UPDATE users_data SET vp = (vp-$price) WHERE accountid = $accountid");

        redirect(base_url('store?complete'),'refresh');
    }
}
