<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_comment_model extends BS_Model
{
    protected $table = 'news_comments';

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
     * Get all rows in a limited range by news id
     *
     * @param int $limit
     * @param int $offset
     * @param int $id
     * @return array
     */
    public function paginate($limit, $offset, $id)
    {
        return $this->db->select('news_comments.*, users.nickname')
            ->from($this->table)
            ->join('users', 'news_comments.user_id = users.id')
            ->where('news_comments.news_id', $id)
            ->order_by('news_comments.created_at', 'ASC')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    /**
     * Count all rows by news id
     *
     * @param int $id
     * @return int
     */
    public function total_paginate($id)
    {
        return $this->count_all(['news_id' => $id]);
    }
}
