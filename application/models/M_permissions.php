<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permissions extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);
    }

    public function getMaintenance()
    {
        $config = $this->config->item('maintenance_mode');

        if($config == '1' && $this->m_data->isLogged())
        {
            if($this->getMaintenancePermission($this->session->userdata('wow_sess_gmlevel')))
                return true;
            else
                return false;
        }
        else
            return true;
    }

    public function getMaintenancePermission($gmlevel)
    {
        $config = $this->config->item('MOD_Level');

        $qq = $this->auth->select('gmlevel')
                ->where('id', $this->session->userdata('wow_sess_id'))
                ->get('account_access');

        if(!$qq->row('gmlevel'))
            return false;
        else
        {
            if($qq->row('gmlevel') >= $config)
                return false;
            else
            {
                return true;
            }
        }
    }

    public function getRank($gmlevel)
    {
        $qq = $this->auth->select('gmlevel')
                ->where('id', $this->session->userdata('wow_sess_id'))
                ->get('account_access');

        $gmlevel = $this->db->select('comment')
                    ->where('permission', $qq->row('gmlevel'))
                    ->get('ranks_default');

        if($gmlevel->num_rows())
            return $gmlevel->row('comment');
        else
        {
            return 'Player';
        }
    }

    public function getIsAdmin($id)
    {
        $config = $this->config->item('admin_access_level');

        $qq = $this->auth->select('gmlevel')
                ->where('id', $this->session->userdata('wow_sess_id'))
                ->get('account_access');

        if(!$qq->row('gmlevel'))
            return false;
        else
        {
            if($qq->row('gmlevel') >= $config)
                return true;
            else
            {
                return false;
            }
        }
    }

    public function getIsModerator($id)
    {
        $config = $this->config->item('mod_access_level');

        $qq = $this->auth->select('gmlevel')
                ->where('id', $this->session->userdata('wow_sess_id'))
                ->get('account_access');

        if(!$qq->row('gmlevel'))
            return false;
        else
        {
            if($qq->row('gmlevel') >= $config)
                return true;
            else
            {
                return false;
            }
        }
    }
}
