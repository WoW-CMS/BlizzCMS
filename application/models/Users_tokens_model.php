<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_tokens_model extends CI_Model
{
    /**
     * Specific table used in the model
     *
     * @var string
     */
    protected $table = 'users_tokens';

    /**
     * Insert new record
     *
     * @param int $user
     * @param string $type
     * @param string $expiration
     * @param string $data
     * @return string
     */
    public function create($user, $type, $expiration, $data = '')
    {
        $chooser = bin2hex(random_bytes(16));
        $key     = bin2hex(random_bytes(16));
        $token   = $chooser.'_'.$key;
        $hash    = hash('sha512', $key);

        $this->db->insert($this->table, [
            'user_id'    => $id,
            'chooser'    => $chooser,
            'hash'       => $hash,
            'type'       => $type,
            'data'       => $data,
            'created_at' => current_date(),
            'expired_at' => interval_time($expiration)
        ]);

        return $token;
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
     * @return array
     */
    public function find_all()
    {
        return $this->db->order_by('id', 'DESC')
                    ->get($this->table)
                    ->result();
    }

    /**
     * Count all records
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Validate token
     *
     * @param string $token
     * @param string $type
     * @return mixed
     */
    public function validate($token, $type)
    {
        if (strpos($token, '_') === false) {
            return false;
        }

        list($chooser, $validation) = explode('_', $token);
        $validation = hash('sha512', $validation);

        $row = $this->find([
            'chooser'       => $chooser,
            'type'          => $type,
            'expired_at >=' => current_date()
        ]);

        if (empty($row) || ! hash_equals($row->hash, $validation)) {
            return false;
        }

        return $row;
    }

    /**
     * Check if username/email exists on pending accounts
     *
     * @param string $username
     * @param string $email
     * @return bool
     */
    public function pending_account($username, $email)
    {
        $query = $this->db->query("SELECT * FROM users_tokens WHERE (JSON_EXTRACT(data, '$.username') = ? OR JSON_EXTRACT(data, '$.email') = ?) AND type = 'validation' AND expired_at >= ?", [$username, $email, current_date()]);

        return $query->num_rows() >= 1;
    }
}