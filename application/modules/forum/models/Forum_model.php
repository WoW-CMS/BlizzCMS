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
     * @param null $id
     * 
     * @return [type]
     */
    public function getCategory($id = null)
    {
        $value = is_null($id) ? $this->db->get('forum_category')->result() : $this->db->where('category', $id)->get('forum')->result();
        
        return $value;
    }
    
    /**
     * @param mixed $column
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getCountTopics($column = null, $id = null)
    {
        $value = (is_null($id) && is_null($column)) ? $this->db->get('forum_topics')->num_rows() : 
                    $this->db->where($column, $id)->get('forum_topics')->num_rows();
   
        return $value;
    }
    
        
    /**
     * @param mixed $column
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getCountReplies($column = null, $id = null)
    {
        $value = (is_null($id) && is_null($column)) ? $this->db->get('forum_replies')->num_rows() : 
                    $this->db->where($column, $id)->get('forum_replies')->num_rows();
   
        return $value;
    }
    
    /**
     * @param null $id
     * 
     * @return [type]
     */
    public function getLastPosts($id = null)
    {
        $value = is_null($id) ? $this->db->limit('5')->order_by('date', 'ASC')->get('forum_topics')->result() : 
                    $this->db->select('*')->where('forums', $id)->limit('1')->order_by('date', 'DESC')->get('forum_topics')->result();
        
        return $value;
    }
    
    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getLastReplies($id)
    {
        $value = $this->db->where('topic', $id)->limit('1')->order_by('date', 'DESC')->get('forum_replies');

        return $value;
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function authType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('forum')->row('type');
    }
    
    /**
     * @param mixed $row
     * 
     * @return [type]
     */
    public function getForumRow($id, $row)
    {
        return $this->db->where('id', $id)->get('forum')->row($row);
    }
        
    /**
     * @param mixed $row
     * 
     * @return [type]
     */
    public function getTopicRow($id, $row)
    {
        return $this->db->where('id', $id)->get('forum_topics')->row($row);
    }

    
    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getPosts($id)
    {
        return $this->db->where('forums', $id)->order_by('pinned', 'DESC')->order_by('id', 'ASC')->get('forum_topics');
    }
    
    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getComments($id)
    {
        return $this->db->where('topic', $id)->get('forum_replies');
    }
    
    /**
     * @param mixed $category
     * @param mixed $title
     * @param mixed $userid
     * @param mixed $description
     * @param mixed $locked
     * @param mixed $pinned
     * 
     * @return [type]
     */
    public function newTopic($category, $title, $userid, $description, $locked, $pinned)
    {
        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'forums' => $category,
            'title' => $title,
            'author' => $userid,
            'date' => $date,
            'content' => $description,
            'locked' => $locked,
            'pinned' => $pinned
        );

        $this->db->insert('forum_topics', $data);
        
        $idTopic = $this->db->select('*')->order_by('id',"desc")->limit(1)->get('forum_topics')->row('id');

        $this->service->logsService->send($userid, 1, $idTopic, '[New Topic]', $title);
        
        return true;
    }
    
    /**
     * @param mixed $idlink
     * @param mixed $title
     * @param mixed $description
     * @param mixed $locked
     * @param mixed $pinned
     * 
     * @return [type]
     */
    public function updateTopic($idlink, $title, $description, $locked, $pinned)
    {
        $data = array(
            'title' => $title,
            'content' => $description,
            'locked' => $locked,
            'pinned' => $pinned
        );

        $this->db->where('id', $idlink)->update('forum_topics', $data);
        
        return true;
    }
    
    /**
     * @param mixed $reply
     * @param mixed $topicid
     * @param mixed $author
     * 
     * @return [type]
     */
    public function newComment($reply, $topicid, $author)
    {
        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'topic' => $topicid,
            'author' => $author,
            'commentary' => $reply,
            'date' => $date
        );

        $this->db->insert('forum_replies', $data);
        
        $this->service->logsService->send($author, 2, $topicid, '[New Reply]', $reply);
        return true;
    }
}