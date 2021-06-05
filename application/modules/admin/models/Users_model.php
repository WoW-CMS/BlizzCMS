<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    protected $users = 'users';

    /**
     * Count all users
     *
     * @param string $search
     * @return int
     */
    public function count_all($search = '')
    {
        if ($search === '')
        {
            return $this->db->count_all($this->users);
        }

        return $this->db->from($this->users)->like('nickname', $search)->or_like('username', $search)->or_like('email', $search)->count_all_results();
    }

    /**
     * Get all users
     *
     * @param int $limit
     * @param int $start
     * @param string $search
     * @return array
     */
    public function get_all($limit, $start, $search = '')
    {
        if ($search === '')
        {
            return $this->db->order_by('id', 'DESC')->limit($limit, $start)->get($this->users)->result();
        }

        return $this->db->like('nickname', $search)->or_like('username', $search)->or_like('email', $search)->order_by('id', 'DESC')->limit($limit, $start)->get($this->users)->result();
    }

    /**
     * Get user
     *
     * @param int $id
     * @return array
     */
    public function get($id)
    {
        return $this->db->where('id', $id)->get($this->users)->row();
    }

    /**
     * Check if user exists
     *
     * @param int $id
     * @return boolean
     */
    public function find_id($id)
    {
        $result = $this->db->where('id', $id)->get($this->users)->num_rows();

        return $result == 1;
    }

    /**
     * Count all bans
     *
     * @param string $search
     * @return int
     */
    public function count_all_bans($search = '')
    {
        if ($search === '')
        {
            return $this->auth->connect()->where('active', 1)->from('account_banned')->count_all_results();
        }

        $emulator = config_item('emulator');

        if (in_array($emulator, ['cmangos'], true))
        {
            return $this->auth->connect()->select('account.username, account_banned.id')->from('account')->join('account_banned', 'account.id = account_banned.account_id')->like('account.username', $search)->where('account_banned.active', 1)->count_all_results();
        }

        return $this->auth->connect()->select('account.username, account_banned.id')->from('account')->join('account_banned', 'account.id = account_banned.id')->like('account.username', $search)->where('account_banned.active', 1)->count_all_results();
    }

    /**
     * Get all bans
     *
     * @param int $limit
     * @param int $start
     * @param string $search
     * @return array
     */
    public function get_all_bans($limit, $start, $search = '')
    {
        $emulator = config_item('emulator');

        if (in_array($emulator, ['cmangos'], true))
        {
            $query = $this->auth->connect()->select('account.username, account_banned.id, account_banned.account_id AS account, account_banned.banned_at AS bandate, account_banned.expires_at AS unbandate, account_banned.banned_by AS bannedby, account_banned.reason AS banreason')->from('account')->join('account_banned', 'account.id = account_banned.account_id')->where('account_banned.active', 1);
        }
        else
        {
            $query = $this->auth->connect()->select('account.username, account_banned.id, account_banned.id AS account, account_banned.bandate, account_banned.unbandate, account_banned.bannedby, account_banned.banreason')->from('account')->join('account_banned', 'account.id = account_banned.id')->where('account_banned.active', 1);
        }

        if ($search !== '')
        {
            $query = $query->like('account.username', $search);
        }

        if (in_array($emulator, ['cmangos'], true))
        {
            $query = $query->order_by('account_banned.banned_at', 'DESC');
        }
        else
        {
            $query = $query->order_by('account_banned.bandate', 'DESC');
        }

        return $query->limit($limit, $start)->get()->result();
    }

    /**
     * Get ban
     *
     * @param int $id
     * @return array
     */
    public function get_ban($id)
    {
        $emulator = config_item('emulator');

        if (in_array($emulator, ['cmangos'], true))
        {
            return $this->auth->connect()->select('id, account_id AS account, banned_at AS bandate, expires_at AS unbandate, banned_by AS bannedby, reason AS banreason')->where(['id' => $id, 'active' => 1])->get('account_banned')->row();
        }

        return $this->auth->connect()->select('id, id AS account, bandate, unbandate, bannedby, banreason')->where(['id' => $id, 'active' => 1])->get('account_banned')->row();
    }

    /**
     * Check if ban exists
     *
     * @param int $id
     * @return boolean
     */
    public function find_ban($id)
    {
        $result = $this->auth->connect()->where(['id' => $id, 'active' => 1])->get('account_banned')->num_rows();

        return $result == 1;
    }
}