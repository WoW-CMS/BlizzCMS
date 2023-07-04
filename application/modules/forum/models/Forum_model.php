<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model
{
    /**
     * Forum_model constructor.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param mixed $id
     * @return object
     */
    public function getCategory($id = null)
    {
        if (is_null($id)) {
            return $this->db->get('forum_category')
                ->result();
        }

        return $this->db->where('category', $id)
            ->get('forum')
            ->result();
    }

    /**
     * @param mixed $column
     * @param mixed $id
     * @return int
     */
    public function getCountTopics($column = null, $id = null)
    {
        if (is_null($column) && is_null($id)) {
            return $this->db->get('forum_topics')
                ->num_rows();
        }
   
        return $this->db->where($column, $id)
            ->get('forum_topics')
            ->num_rows();
    }
 
    /**
     * @param mixed $column
     * @param mixed $id
     * @return int
     */
    public function getCountReplies($column = null, $id = null)
    {
        if (is_null($column) && is_null($id)) {
            return $this->db->get('forum_replies')
                ->num_rows();
        }
   
        return $this->db->where($column, $id)
            ->get('forum_replies')
            ->num_rows();
    }

    /**
     * @param mixed $id
     * @return object
     */
    public function getLastPosts($id = null)
    {
        if (is_null($id)) {
            return $this->db->order_by('date', 'ASC')
                ->limit('5')
                ->get('forum_topics')
                ->result();
        }
        
        return $this->db->where('forums', $id)
            ->order_by('date', 'DESC')
            ->limit('1')
            ->get('forum_topics')
            ->result();
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function getLastReplies($id)
    {
        $query = $this->db->where('topic', $id)
            ->order_by('date', 'DESC')
            ->limit('1')
            ->get('forum_replies');

        return $query;
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function authType($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row('type');
    }

    /**
     * @param mixed $id
     * @param mixed $row
     * @return mixed
     */
    public function getForumRow($id, $row)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row($row);
    }

    /**
     * @param mixed $id
     * @param mixed $row
     * @return mixed
     */
    public function getTopicRow($id, $row)
    {
        return $this->db->where('id', $id)
            ->get('forum_topics')
            ->row($row);
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function getPosts($id)
    {
        return $this->db->where('forums', $id)
            ->order_by('pinned', 'DESC')
            ->order_by('id', 'ASC')
            ->get('forum_topics');
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function getComments($id)
    {
        return $this->db->where('topic', $id)
            ->get('forum_replies');
    }

    /**
     * @param mixed $category
     * @param mixed $title
     * @param mixed $userid
     * @param mixed $description
     * @param mixed $locked
     * @param mixed $pinned
     * @return bool
     */
    public function newTopic($category, $title, $userid, $description, $locked, $pinned)
    {
        $this->db->insert('forum_topics', [
            'forums'  => $category,
            'title'   => $title,
            'author'  => $userid,
            'date'    => $this->wowgeneral->getTimestamp(),
            'content' => $description,
            'locked'  => $locked,
            'pinned'  => $pinned
        ]);

        $topicId = $this->db->order_by('id', 'DESC')
            ->limit(1)
            ->get('forum_topics')
            ->row('id');

        $this->service->logsService->send($userid, 1, $topicId, '[New Topic]', $title);
        return true;
    }

    /**
     * @param mixed $idlink
     * @param mixed $title
     * @param mixed $description
     * @param mixed $locked
     * @param mixed $pinned
     * @return bool
     */
    public function updateTopic($idlink, $title, $description, $locked, $pinned)
    {
        $this->db->where('id', $idlink)->update('forum_topics', [
            'title'   => $title,
            'content' => $description,
            'locked'  => $locked,
            'pinned'  => $pinned
        ]);

        $this->service->logsService->send($author, 2, $idlink, '[Update topic]', $title);
        return true;
    }

    /**
     * @param mixed $reply
     * @param mixed $topicid
     * @param mixed $author
     * @return bool
     */
    public function newComment($reply, $topicid, $author)
    {
        $this->db->insert('forum_replies', [
            'topic'      => $topicid,
            'author'     => $author,
            'commentary' => $reply,
            'date'       => $this->wowgeneral->getTimestamp()
        ]);

        $this->service->logsService->send($author, 2, $topicid, '[New Reply]', $reply);
        return true;
    }

    /**
     * Remueve un comentario en el foro.
     *
     * @param int $commentId
     * @param int $userId
     * @return bool
     */
    public function removeComment($commentId, $userId)
    {
        // Verificar si el comentario pertenece al usuario
        $comment = $this->db->where('id', $commentId)
            ->where('author', $userId)
            ->get('forum_replies')
            ->row();

        if (empty($comment)) {
            return false;
        }

        // Eliminar el comentario de la base de datos
        $this->db->where('id', $commentId)
                ->delete('forum_replies');

        // Registrar la acción en los logs
        $this->service->logsService->send($userId, 3, $comment->topic, '[Remove Comment]', $comment->commentary);
        return true;
    }
}
