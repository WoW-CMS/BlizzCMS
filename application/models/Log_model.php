<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends BS_Model
{
    protected $table = 'logs';

    protected $setCreatedField = true;

    /**
     * Logs status
     *
     * @var string
     */
    public const STATUS_FAILED    = 'failed';
    public const STATUS_SUCCEEDED = 'succeeded';

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
     * Create a new log
     *
     * @param string $object
     * @param string $event
     * @param string $message
     * @param array $data
     * @param string $uri
     * @param string $status
     * @param int|null $user
     * @return bool
     */
    public function create($object, $event, $message, $data = [], $uri = '', $status = self::STATUS_SUCCEEDED, $user = null)
    {
        return $this->insert([
            'user_id' => $user ?? ($this->auth_model->is_logged_in() ? $this->session->userdata('id') : 0),
            'ip'      => $this->input->ip_address(),
            'status'  => $status,
            'object'  => $object,
            'event'   => $event,
            'message' => $message,
            'data'    => json_encode($data),
            'uri'     => $uri
        ]);
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
        $query = $this->db->select('logs.*, users.nickname, users.username')
            ->from($this->table)
            ->join('users', 'logs.user_id = users.id', 'left');

        if (array_key_exists('user', $filters) && $filters['user'] !== '') {
            $query->where('logs.user_id', $filters['user']);
        }

        if (array_key_exists('status', $filters) && $filters['status'] !== '') {
            $query->where('logs.status', $filters['status']);
        }

        if (array_key_exists('object', $filters) && ! empty($filters['object'])) {
            if (is_array($filters['object'])) {
                $query->where_in('logs.object', $filters['object']);
            } else {
                $query->where('logs.object', $filters['object']);
            }
        }

        if (array_key_exists('event', $filters) && ! empty($filters['event'])) {
            if (is_array($filters['event'])) {
                $query->where_in('logs.event', $filters['event']);
            } else {
                $query->where('logs.event', $filters['event']);
            }
        }

        if (array_key_exists('search', $filters) && $filters['search'] !== '') {
            $dataColumn = "JSON_EXTRACT(" . $this->db->dbprefix('logs') . ".data, '$[0].*')";

            $query->group_start()
                ->or_like([
                    'logs.message'   => $filters['search'],
                    $dataColumn      => $filters['search'],
                    'logs.ip'        => $filters['search'],
                    'users.username' => $filters['search']
                ])
                ->group_end();
        }

        return $query->order_by('logs.id', 'DESC')
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
        $query = $this->db->select('logs.*, users.nickname, users.username')
            ->from($this->table)
            ->join('users', 'logs.user_id = users.id', 'left');

        if (array_key_exists('user', $filters) && $filters['user'] !== '') {
            $query->where('logs.user_id', $filters['user']);
        }

        if (array_key_exists('status', $filters) && $filters['status'] !== '') {
            $query->where('logs.status', $filters['status']);
        }

        if (array_key_exists('object', $filters) && ! empty($filters['object'])) {
            if (is_array($filters['object'])) {
                $query->where_in('logs.object', $filters['object']);
            } else {
                $query->where('logs.object', $filters['object']);
            }
        }

        if (array_key_exists('event', $filters) && ! empty($filters['event'])) {
            if (is_array($filters['event'])) {
                $query->where_in('logs.event', $filters['event']);
            } else {
                $query->where('logs.event', $filters['event']);
            }
        }

        if (array_key_exists('search', $filters) && $filters['search'] !== '') {
            $dataColumn = "JSON_EXTRACT(" . $this->db->dbprefix('logs') . ".data, '$[0].*')";

            $query->group_start()
                ->or_like([
                    'logs.message'   => $filters['search'],
                    $dataColumn      => $filters['search'],
                    'logs.ip'        => $filters['search'],
                    'users.username' => $filters['search']
                ])
                ->group_end();
        }

        return $query->count_all_results();
    }
}
