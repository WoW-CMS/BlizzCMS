<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_characters extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getItemInstace($multiRealm, $item)
    {
        $this->multiRealm = $multiRealm;
        $qq = $this->multiRealm->select('itemEntry')
                ->where('guid', $item)
                ->get('item_instance');

        if($qq->num_rows())
            return $qq->row('itemEntry');
        else
            return '0';
    }

    public function getGeneralCharactersSpecifyAcc($multiRealm, $id)
    {
        $this->multiRealm = $multiRealm;
        return $this->multiRealm->select('*')
                ->where('account', $id)
                ->get('characters');
    }

    public function getGuidCharacterSpecifyName($multiRealm, $name)
    {
        $this->multiRealm = $multiRealm;
        return $this->multiRealm->select('guid')
                ->where('name', $name)
                ->get('characters')
                ->row('guid');
    }

    public function getGeneralCharactersSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('*')
                ->where('guid', $id)
                ->get('characters');
    }

    public function getNameCharacterSpecifyGuid($multirealm, $id)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')
                ->where('guid', $id)
                ->get('characters')
                ->row_array()['name'];
    }

    public function getCharNameAlreadyExist($name, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')
                ->where('name', $name)
                ->get('characters');
    }

    public function getCharBanSpecifyGuid($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('guid')
                ->where('guid', $id)
                ->where('active', '1')
                ->get('character_banned');
    }

    public function getCharName($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('name')
                ->where('guid', $id)
                ->get('characters')
                ->row_array()['name'];
    }

    public function getCharLevel($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('level')
                ->where('guid', $id)
                ->get('characters')
                ->row('level');
    }

    public function getCharActive($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('online')
                ->where('guid', $id)
                ->get('characters')
                ->row('online');
    }

    public function getCharRace($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('race')
                ->where('guid', $id)
                ->get('characters')
                ->row('race');
    }

    public function getCharClass($id, $multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('class')
                ->where('guid', $id)
                ->get('characters')
                ->row('class');
    }

    public function getCharactersOnlineAlliance($multiRealm)
    {
        $this->multiRealm = $multiRealm;
        $races = array('1','3','4','7','11','22','25');

        return $this->multiRealm->select('guid')
                ->where_in('race', $races)
                ->where('online', '1')
                ->get('characters')
                ->num_rows();
    }

    public function getCharactersOnlineHorde($multiRealm)
    {
        $this->multiRealm = $multiRealm;
        $races = array('2','5','6','8','10','9','26');

        return $this->multiRealm->select('guid')
                ->where_in('race', $races)
                ->where('online', '1')
                ->get('characters')
                ->num_rows();
    }

    public function getAllCharactersOnline($multiRealm)
    {
        $this->multiRealm = $multiRealm;

        return $this->multiRealm->select('online')
                ->where('online', '1')
                ->get('characters')
                ->num_rows();
    }

    public function getInformationCharacter($MultiRealm, $id)
    {
        $this->multirealm = $MultiRealm;
        
        return $this->multirealm->select('*')
                ->where('guid', $id)
                ->get('characters');
    }

}
