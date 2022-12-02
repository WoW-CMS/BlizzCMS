<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends BS_Model
{
    protected $table = 'news';

    protected $setCreatedField = true;

    protected $setUpdatedField = true;

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
     * @return array
     */
    public function paginate($limit, $offset)
    {
        return $this->db->from($this->table)
            ->order_by('id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    /**
     * Count total rows to paginate
     *
     * @return int
     */
    public function total_paginate()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Get the latest rows
     *
     * @return array
     */
    public function latest()
    {
        $limit = config_item('articles_max_recently') ?? 5;

        return $this->db->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get($this->table)
            ->result();
    }
}
