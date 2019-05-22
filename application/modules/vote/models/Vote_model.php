<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

    /**
     * Vote_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getVotes()
    {
        return $this->db->get('votes')->result();
    }

    public function getVotePoints($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('points');
    }

    public function getVoteTime($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('time');
    }

    public function getVoteLog($id, $userid)
    {
        return $this->db->where('idaccount', $userid)->where('idvote', $id)->limit('1')->order_by('id', 'DESC')->get('votes_logs');
    }

    public function getTimeLogExpired($id, $userid)
    {
        return $this->db->where('idaccount', $userid)->where('idvote', $id)->limit('1')->order_by('id', 'DESC')->get('votes_logs')->row('expired_at');
    }

    public function getCredits($userid)
    {
        return $this->db->where('id', $userid)->limit('1')->get('users')->row('vp');
    }

    public function getVoteUrl($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('url');
    }

    public function voteNow($id)
    {
        $userid = $this->session->userdata('wow_sess_id');
        $mytime = $this->wowgeneral->getTimestamp();
        $ppoints = $this->getVotePoints($id);
        $votetime = $this->getVoteTime($id);

        $qqcheck = $this->getVoteLog($id, $userid);

        $url = $this->getVoteUrl($id);

        $fecha = new DateTime();
        $expired = $fecha->add(new DateInterval('PT'.$votetime.'H'));

        $expired_at = $expired->getTimestamp();

        if(!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        $comprobetime = $qqcheck->row('expired_at');

        if($this->wowgeneral->getTimestamp() >= $comprobetime)
        {
            $vp2 = $this->db->where('id', $userid)->get('users')->row('vp');
            $vp = ($vp2+$ppoints);

            $data = array('vp' => $vp);

            $logs = array(
                'idaccount' => $userid,
                'idvote' => $id,
                'lasttime' => $mytime,
                'expired_at' => $expired_at,
                'points' => $ppoints
            );

            $this->db->where('id', $userid)->update('users', $data);
            $this->db->insert('votes_logs', $logs);

            echo '<script type="text/javascript">
                    window.open( "'.$url.'","_self")
                </script>';

            redirect(base_url('vote'),'refresh');
        } else {
            echo '<script type="text/javascript">alert("According to our records you have already voted in this top. Contact with Support Ingame for Resolving this problem")</script>';
            redirect(base_url('vote'),'refresh');
        }
    }
}
