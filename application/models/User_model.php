<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends BS_Model
{
    protected $table = 'users';

    protected $setCreatedField = true;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert a new row
     *
     * @param array $set
     * @return bool
     */
    public function insert(array $set)
    {
        if ($this->setCreatedField) {
            $set[$this->createdField] = current_date();
        }

        if (array_key_exists('password', $set)) {
            $set['password'] = password_hash($set['password'], PASSWORD_ARGON2ID, [
                'memory_cost' => 2<<10,
                'time_cost'   => 2,
                'threads'     => 2
            ]);
        }

        return $this->db->insert($this->table, $set);
    }

    /**
     * Update key/value pairs in rows
     *
     * @param array $set
     * @param array $where
     * @return bool
     */
    public function update(array $set, array $where)
    {
        if ($this->setUpdatedField) {
            $set[$this->updatedField] = current_date();
        }

        if (array_key_exists('password', $set)) {
            $set['password'] = password_hash($set['password'], PASSWORD_ARGON2ID, [
                'memory_cost' => 2<<10,
                'time_cost'   => 2,
                'threads'     => 2
            ]);
        }

        return $this->db->update($this->table, $set, $where);
    }

    /**
     * Get a limit of rows to display per page
     *
     * @param int $limit
     * @param int $offset
     * @param array $filters
     * @return array
     */
    public function paginate($limit, $offset, $filters = [])
    {
        $query = $this->db->from($this->table);

        if (array_key_exists('search', $filters) && $filters['search'] !== '') {
            $query->or_like([
                'nickname' => $filters['search'],
                'username' => $filters['search'],
                'email'    => $filters['search']
            ]);
        }

        return $query->order_by('id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    /**
     * Count total rows to paginate
     *
     * @param array $filters
     * @return int
     */
    public function total_paginate($filters = [])
    {
        $query = $this->db->from($this->table);

        if (array_key_exists('search', $filters) && $filters['search'] !== '') {
            $query->or_like([
                'nickname' => $filters['search'],
                'username' => $filters['search'],
                'email'    => $filters['search']
            ]);
        }

        return $query->count_all_results();
    }

    /**
     * Find user
     *
     * @param string $user
     * @return mixed
     */
    public function find_user($user)
    {
        return $this->db->where('username', $user)
            ->or_where('email', $user)
            ->get($this->table)
            ->row();
    }

    /**
     * Get all user data or a specific one
     *
     * @param string|null $column
     * @param int|null $id
     * @return mixed
     */
    public function user($column = null, $id = null)
    {
        $id ??= $this->session->userdata('id');
        $row = $this->find(['id' => $id]);

        if (empty($row)) {
            return null;
        }

        if ($column === null) {
            return $row;
        }

        if (property_exists($row, $column)) {
            return $row->{$column};
        }

        return null;
    }

    /**
     * Get the user id by searching a value in a column
     *
     * @param string $value
     * @param string $column
     * @return int
     */
    public function user_id($value, $column = 'username')
    {
        if (! in_array($column, ['username', 'email', 'nickname'], true)) {
            return 0;
        }

        $row = $this->find([$column => $value]);

        return empty($row) ? 0 : (int) $row->id;
    }

    /**
     * Get the avatar image of a user
     *
     * @param int|null $id
     * @return string
     */
    public function user_avatar($id = null)
    {
        $id ??= $this->session->userdata('id');
        $cache = $this->cache->get('users_avatars');

        if ($cache !== false) {
            if (array_key_exists($id, $cache)) {
                return $cache[$id];
            }

            return '';
        }

        $list = [];

        // API settings for avatar
        $background = config_item('avatar_api_background') ?? '#0d77d5';
        $color      = config_item('avatar_api_color') ?? '#ffffff';

        foreach ($this->find_all() as $user) {
            if ($user->avatar !== '') {
                $list[$user->id] = base_url('uploads/avatars/' . $user->avatar);
            } else {
                $list[$user->id] = 'https://ui-avatars.com/api/' . http_build_query([
                    'name'       => $user->nickname,
                    'size'       => 128,
                    'background' => trim($background, '#'),
                    'color'      => trim($color, '#'),
                    'length'     => 1,
                    'bold'       => true
                ]);
            }
        }

        $this->cache->save('users_avatars', $list, 86400);

        if (array_key_exists($id, $list)) {
            return $list[$id];
        }

        return '';
    }

    /**
     * Check if a user exists through the search in a column
     *
     * @param string $value
     * @param string $column
     * @return bool
     */
    public function user_exists($value, $column = 'username')
    {
        if (! in_array($column, ['nickname', 'username', 'email'], true)) {
            return false;
        }

        $row = $this->count_all([$column => $value]);

        return $row === 1;
    }
}
