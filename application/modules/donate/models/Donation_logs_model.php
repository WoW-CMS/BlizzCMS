<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_logs_model extends CI_Model 
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'donation_logs';

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
     * Set record
     *
     * @param array $keys
     * @param array $where
     * @param bool $escape
     * @return bool
     */
    public function set(array $keys, array $where, $escape = null)
    {
        return $this->db->set($keys, '', $escape)
                    ->where($where)
                    ->update($this->table);
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
        if ($search === '') {
            return $this->db->order_by('id', 'DESC')
                        ->limit($limit, $start)
                        ->get($this->table)
                        ->result();
        }

        return $this->db->select('donation_logs.*, users.username')
                    ->from($this->table)
                    ->join('users', 'donation_logs.user_id = users.id')
                    ->like('donation_logs.order_id', $search)
                    ->or_like('donation_logs.reference_id', $search)
                    ->or_like('donation_logs.payment_id', $search)
                    ->or_like('donation_logs.payment_gateway', $search)
                    ->or_like('users.username', $search)
                    ->order_by('donation_logs.id', 'DESC')
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

        return $this->db->select('donation_logs.*, users.username')
                    ->from($this->table)
                    ->join('users', 'donation_logs.user_id = users.id')
                    ->like('donation_logs.order_id', $search)
                    ->or_like('donation_logs.reference_id', $search)
                    ->or_like('donation_logs.payment_id', $search)
                    ->or_like('donation_logs.payment_gateway', $search)
                    ->or_like('users.username', $search)
                    ->count_all_results();
    }

    /**
     * Find latest records
     *
     * @param int $limit
     * @return array
     */
    public function latest($limit = 5)
    {
        return $this->db->select('donation_logs.*, users.username')
                    ->from($this->table)
                    ->join('users', 'donation_logs.user_id = users.id')
                    ->where_in('donation_logs.payment_status', ['PENDING', 'COMPLETED'])
                    ->order_by('donation_logs.id', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->result();
    }

    /**
     * Payments statistics
     *
     * @return string
     */
    public function statistics()
    {
        $row = $this->db->select('SUM(CASE MONTH(created_at) WHEN 1 THEN amount ELSE 0 END) AS january, SUM(CASE MONTH(created_at) WHEN 2 THEN amount ELSE 0 END) AS february, SUM(CASE MONTH(created_at) WHEN 3 THEN amount ELSE 0 END) AS march, SUM(CASE MONTH(created_at) WHEN 4 THEN amount ELSE 0 END) AS april, SUM(CASE MONTH(created_at) WHEN 5 THEN amount ELSE 0 END) AS may, SUM(CASE MONTH(created_at) WHEN 6 THEN amount ELSE 0 END) AS june, SUM(CASE MONTH(created_at) WHEN 7 THEN amount ELSE 0 END) AS july, SUM(CASE MONTH(created_at) WHEN 8 THEN amount ELSE 0 END) AS august, SUM(CASE MONTH(created_at) WHEN 9 THEN amount ELSE 0 END) AS september, SUM(CASE MONTH(created_at) WHEN 10 THEN amount ELSE 0 END) AS october, SUM(CASE MONTH(created_at) WHEN 11 THEN amount ELSE 0 END) AS november, SUM(CASE MONTH(created_at) WHEN 12 THEN amount ELSE 0 END) AS december', false)
                    ->where([
                        'YEAR(created_at)' => date('Y'),
                        'payment_status'   => 'COMPLETED'
                    ])
                    ->get($this->table)
                    ->row_array();

        $values = array_values($row);

        return json_encode($values);
    }
}
