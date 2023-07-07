<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model
{
    /**
     * Vote_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->db->get('votes')
            ->result();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopsite($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getVoteTime($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('time');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getVoteUrl($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('url');
    }

    /**
     * @param int $id
     * @param int $userid
     * @return mixed
     */
    public function getVoteLog($id, $userid)
    {
        return $this->db->where('idaccount', $userid)
            ->where('idvote', $id)
            ->limit('1')
            ->order_by('id', 'DESC')
            ->get('votes_logs');
    }

    /**
     * @param int $id
     * @param int $userid
     * @return int
     */
    public function getTimeLogExpired($id, $userid)
    {
        $query = $this->db->where('idaccount', $userid)
            ->where('idvote', $id)
            ->limit('1')
            ->order_by('id', 'DESC')
            ->get('votes_logs')
            ->row('expired_at');

        if (! empty($query)) {
            return (int) $query;
        }

        return 0;
    }

    /**
     * @param int $id
     * @return void
     */
    public function voteNow($id)
    {
        $topsite = $this->getTopsite($id);

        if (empty($topsite)) {
            redirect(site_url('vote'));
        }

        $userid = $this->session->userdata('wow_sess_id');
        $date   = $this->wowgeneral->getTimestamp();

        if ($date <= $this->getTimeLogExpired($id, $userid)) {
            echo '<script type="text/javascript">alert("According to our records you have already voted in this top. Contact with Support Ingame for Resolving this problem")</script>';

            redirect(site_url('vote'));
        }

        $url       = ! preg_match("~^(?:f|ht)tps?://~i", $topsite->url) ? 'http://' . $topsite->url : $topsite->url;
        $datetime  = new DateTime();
        $interval  = $datetime->add(new DateInterval('PT' . $topsite->time . 'H'));
        $expiredat = $interval->getTimestamp();

        $this->db->where('id', $userid)
            ->update('users', ['vp' => $this->wowgeneral->getCharVPTotal($userid) + (int) $topsite->points]);

        $this->db->insert('votes_logs', [
            'idaccount'  => $userid,
            'idvote'     => $id,
            'lasttime'   => $date,
            'expired_at' => $expiredat,
            'points'     => $topsite->points
        ]);

        echo '<script type="text/javascript">
                    window.open("' . $url . '", "_self")
                </script>';

        redirect(site_url('vote'));
    }
}
