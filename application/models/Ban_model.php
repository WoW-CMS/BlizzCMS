<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ban_model extends BS_Model
{
    protected $table = 'bans';

    /**
     * Bans types
     *
     * @var int
     */
    public const TYPE_EMAIL = 'email';
    public const TYPE_IP    = 'ip';
    public const TYPE_USER  = 'user';

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
     * Get a limit of rows to display per page
     *
     * @param int $limit
     * @param int $offset
     * @param string $type
     * @param string $search
     * @return array
     */
    public function paginate($limit, $offset, $type, $search = '')
    {
        switch ($type) {
            case self::TYPE_USER:
                $query = $this->db->select('bans.*, users.nickname, users.username')
                    ->from($this->table)
                    ->join('users', 'bans.value = users.id')
                    ->where('bans.type', self::TYPE_USER);

                if ($search !== '') {
                    $query->like('users.username', $search);
                }

                $query->order_by('bans.id', 'DESC');
                break;

            default:
                $query = $this->db->from($this->table)
                    ->where('type', $type);

                if ($search !== '') {
                    $query->like('value', $search);
                }

                $query->order_by('id', 'DESC');
                break;
        }

        return $query->limit($limit, $offset)
            ->get()
            ->result();
    }

    /**
     * Count total rows to paginate
     *
     * @param string $type
     * @param string $search
     * @return int
     */
    public function total_paginate($type, $search = '')
    {
        switch ($type) {
            case self::TYPE_USER:
                $query = $this->db->select('bans.*, users.nickname, users.username')
                    ->from($this->table)
                    ->join('users', 'bans.value = users.id')
                    ->where('bans.type', self::TYPE_USER);

                if ($search !== '') {
                    $query->like('users.username', $search);
                }
                break;

            default:
                $query = $this->db->from($this->table)
                    ->where('type', $type);

                if ($search !== '') {
                    $query->like('value', $search);
                }
                break;
        }

        return $query->count_all_results();
    }

    /**
     * Check if a email is banned
     *
     * @param string $email
     * @return bool
     */
    public function is_email_banned($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }

        $cache = $this->cache->get('banned_emails');

        if ($cache !== false) {
            [$name, $domain] = explode('@', $email);

            return in_array($domain, $cache, true);
        }

        $findAll = $this->find_all(['type' => self::TYPE_EMAIL], 'array');
        $values  = array_column($findAll, 'value');

        $this->cache->save('banned_emails', $values, 604800);

        [$name, $domain] = explode('@', $email);

        return in_array($domain, $values, true);
    }

    /**
     * Check if a IP is banned
     *
     * @param string $ip
     * @return bool
     */
    public function is_ip_banned($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return false;
        }

        $ipType = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? 'ipv4' : 'ipv6';
        $cache  = $this->cache->get('banned_ips');

        if ($cache !== false) {
            if ($cache === []) {
                return false;
            }

            $ipMatches    = array_filter($cache[$ipType], fn($v) => inet_pton($v) === inet_pton($ip));
            $rangeMatches = array_filter($cache['ranges'], fn($v) => \IPLib\Factory::parseRangeString($v)->contains(\IPLib\Factory::parseAddressString($ip)));

            $totalMatches = count($ipMatches) + count($rangeMatches);

            return $totalMatches >= 1;
        }

        $findAll = $this->find_all(['type' => self::TYPE_IP], 'array');
        $values  = array_column($findAll, 'value');

        if (count($values) === 0) {
            $this->cache->save('banned_ips', [], 604800);

            return false;
        }

        $list  = [
            'ipv4'   => array_filter($values, fn($v) => filter_var($v, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)),
            'ipv6'   => array_filter($values, fn($v) => filter_var($v, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)),
            'ranges' => array_filter($values, fn($v) => strpos($v, '/') !== false || strpos($v, '*') !== false)
        ];

        $ipMatches    = array_filter($list[$ipType], fn($v) => inet_pton($v) === inet_pton($ip));
        $rangeMatches = array_filter($list['ranges'], fn($v) => \IPLib\Factory::parseRangeString($v)->contains(\IPLib\Factory::parseAddressString($ip)));

        $totalMatches = count($ipMatches) + count($rangeMatches);

        $this->cache->save('banned_ips', $list, 604800);

        return $totalMatches >= 1;
    }

    /**
     * Check if a user is banned
     *
     * @param int $id
     * @param bool $permanent
     * @return bool
     */
    public function is_user_banned($id, $permanent = false)
    {
        $find = $this->find([
            'type'  => self::TYPE_USER,
            'value' => $id
        ]);

        if (empty($find)) {
            return false;
        }

        // Check if it's just a permanent ban
        if ($permanent) {
            return $find->end_at === '0000-00-00 00:00:00';
        }

        // Check if the temporary ban has ended to remove it
        if (strtotime($find->end_at) <= now() && $find->end_at !== '0000-00-00 00:00:00') {
            $this->delete([
                'type'  => self::TYPE_USER,
                'value' => $id
            ]);

            return false;
        }

        return true;
    }
}
