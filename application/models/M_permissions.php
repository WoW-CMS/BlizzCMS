<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permissions extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMyRank($id)
    {
        return $this->db->select('idrank')
                ->where('iduser', $this->session->userdata('fx_sess_id'))
                ->get('users_permission');
    }

    public function getMaintenance()
    {
        $config = $this->config->item('maintenance_mode');

        if($config == '1' && $this->m_data->isLogged())
        {
            if($this->getMyPermissions('Permission_Maintenance'))
                return true;
            else
                return false;
        }
        else
            return true;
    }

    public function getMyPermissions($expr)
    {
        if($expr == 'Permission_FREE')
            return true;
        else
        {
            if(!$this->m_data->isLogged())
                $rank = '2';
            else
            {
                $qq = $this->getMyRank($this->session->userdata('fx_sess_id'));
                if($qq->num_rows())
                    $rank = $qq->row('idrank');
                else
                    $rank = '3';
            }

            $qq = $this->db->select('permission')
                    ->where('id', $rank)
                    ->where('permission', $this->getPermissionClasification($expr))
                    ->get('ranks_linked');

            if($qq->num_rows())
                return true;
            else
                return false;
        }
    }

    public function getPermissionClasification($expr)
    {
        switch ($expr) {
            case 'Permission_ACP': 
                return '1'; break;
            case 'Permission_Panel': 
                return '2'; break;
            case 'Permission_Login': 
                return '3'; break;
            case 'Permission_Register': 
                return '4'; break;
            case 'Permission_Faq': 
                return '5'; break;
            case 'Permission_Bugtracker': 
                return '6'; break;
            case 'Permission_PVPStats': 
                return '7'; break;
            case 'Permission_ArenaStats': 
                return '8'; break;
            case 'Permission_News': 
                return '9'; break;
            case 'Permission_Forums': 
                return '10'; break;
            case 'Permission_Store': 
                return '11'; break;
            case 'Permission_Changelogs': 
                return '14'; break;
            case 'Permission_Donate': 
                return '15'; break;
            case 'Permission_Vote': 
                return '16'; break;
            case 'Permission_Events': 
                return '17'; break;
            case 'Permission_Maintenance': 
                return '19'; break;
        }
    }

    public function getIsAdmin($id)
    {
        if($this->m_permissions->getMyRank($id)->row('idrank') == '1')
            return true;
        else
            return false;
    }
}
