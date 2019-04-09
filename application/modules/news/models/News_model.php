<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insertComment($reply, $newsid, $idsession)
    {
        $date = $this->m_data->getTimestamp();

        $data = array(
            'id_new' => $newsid,
            'commentary' => $reply,
            'date' => $date,
            'author' => $idsession
        );

        $this->db->insert('news_comments', $data);
        return true;
    }

    public function removeComment($id, $link)
    {
        $this->db->where('id', $id)
            ->delete('news_comments');

        redirect(base_url('news/'.$link),'refresh');
    }

    public function getComments($idlink)
    {
        return $this->db->select('*')
                ->where('id_new', $idlink)
                ->get('news_comments');
    }

    public function getNewTitle($id)
    {
        return $this->db->select('title')
                ->where('id', $id)
                ->get('news')
                ->row_array()['title'];
    }

    public function getNewImage($id)
    {
        return $this->db->select('image')
                ->where('id', $id)
                ->get('news')
                ->row_array()['image'];
    }

    public function getNewDescription($id)
    {
        return $this->db->select('description')
                ->where('id', $id)
                ->get('news')
                ->row_array()['description'];
    }

    public function getNewlogDate($id)
    {
        return $this->db->select('date')
                ->where('id', $id)
                ->get('news')
                ->row('date');
    }

    public function getCommentCount($id)
    {
        return $this->db->select('id')
                ->where('id_new', $id)
                ->get('news_comments');
    }

    public function getNewSpecifyID($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('news');
    }

    public function getNewsTree()
    {
        return $this->db->select('*')
                ->order_by('id', 'DESC')
                ->limit('4')
                ->get('news');
    }

    public function getNewsList()
    {
        return $this->db->select('*')
                ->order_by('id', 'DESC')
                ->limit('30')
                ->get('news');
    }
}
