<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model
{
    /**
     * News_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $reply
     * @param int $newsid
     * @param int $idsession
     * @return bool
     */
    public function insertComment($reply, $newsid, $idsession)
    {
        $this->db->insert('news_comments', [
            'id_new'     => $newsid,
            'commentary' => $reply,
            'date'       => $this->wowgeneral->getTimestamp(),
            'author'     => $idsession
        ]);

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeComment($id)
    {
        $this->db->where('id', $id)->delete('news_comments');

        return true;
    }

    /**
     * @param int $idlink
     * @return mixed
     */
    public function getComments($idlink)
    {
        return $this->db->where('id_new', $idlink)
            ->get('news_comments');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewTitle($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewImage($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('image');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewDescription($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('description');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewlogDate($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('date');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCommentCount($id)
    {
        return $this->db->where('id_new', $id)
            ->get('news_comments')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewSpecifyID($id)
    {
        return $this->db->where('id', $id)
            ->get('news');
    }

    /**
     * @return mixed
     */
    public function getNewsList()
    {
        return $this->db->order_by('id', 'DESC')
            ->limit('4')
            ->get('news');
    }

    /**
     * @return mixed
     */
    public function getExtendedNewsList()
    {
        return $this->db->order_by('id', 'DESC')
            ->limit('8')
            ->get('news');
    }
}
