<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topsites_logs_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'topsites_logs';

    /**
     * Insert new record
     *
     * @param array $set
     * @return bool
     */
    public function create(array $set)
    {
        return $this->db->insert($this->table, $set);
    }

    /**
     * Update record
     *
     * @param array $set
     * @param array $where
     * @return bool
     */
    public function update(array $set, array $where)
    {
        return $this->db->update($this->table, $set, $where);
    }

    /**
     * Delete record
     *
     * @param array $where
     * @return mixed
     */
    public function delete(array $where)
    {
        return $this->db->delete($this->table, $where);
    }

    /**
     * Find record
     *
     * @param array $where
     * @return mixed
     */
    public function find(array $where)
    {
        return $this->db->where($where)->get($this->table)->row();
    }

    /**
     * Find all records
     *
     * @param int $limit
     * @param int $start
     * @param string $search
     * @return array
     */
    public function find_all($limit, $start, $search = '')
    {
        $query = $this->db->select('topsites_logs.*, topsites.name AS topsite, users.username')
                    ->from($this->table)
                    ->join('topsites', 'topsites_logs.topsite_id = topsites.id')
                    ->join('users', 'topsites_logs.user_id = users.id');

        if ($search !== '') {
            $query = $query->like('topsites.name', $search)->or_like('users.username', $search);
        }

        return $query->order_by('topsites_logs.id', 'DESC')
                    ->limit($limit, $start)
                    ->get()
                    ->result();
    }

    /**
     * Count all records
     *
     * @param string $search
     * @return int
     */
    public function count_all($search = '')
    {
        if ($search === '') {
            return $this->db->count_all($this->table);
        }

        return $this->db->select('topsites_logs.*, users.username, topsites.name')
                    ->from($this->table)
                    ->join('topsites', 'topsites_logs.topsite_id = topsites.id')
                    ->join('users', 'topsites_logs.user_id = users.id')
                    ->like('topsites.name', $search)
                    ->or_like('users.username', $search)
                    ->count_all_results();
    }

    /**
     * Get expiration time to vote again in a topsite
     *
     * @param int $topsite
     * @param int|null $user
     * @return int
     */
    public function expiration($topsite, $user = null)
    {
        $user  = $user ?? $this->session->userdata('id');
        $query = $this->db->where(['topsite_id' => $topsite, 'user_id' => $user])
                    ->order_by('id', 'DESC')
                    ->limit(1)
                    ->get($this->table)
                    ->row('expired_at');

        return ! empty($query) ? strtotime($query) : strtotime('2021-01-01 12:00:00');
    }
}
