<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

    /**
     * Forum_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategory()
    {
        return $this->db->select('id, name')->get('forum_category')->result();
    }

    public function insertComment($reply, $topicid, $author)
    {
        $function = '[Guardian/comment]';
        $type = '2';
        $log_enter = $this->logs->__setLogs($author, $type, $topicid, $function, $reply);

        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'topic' => $topicid,
            'author' => $author,
            'commentary' => $reply,
            'date' => $date
        );

        $this->db->insert('forum_replies', $data);
        return true;
    }

    public function removeComment($id)
    {
        $this->db->where('id', $id)->delete('forum_replies');
        return true;
    }

    public function getComments($id)
    {
        return $this->db->select('*')->where('topic', $id)->get('forum_replies');
    }

    public function getCountPostAuthor($id)
    {
        return $this->db->select('author')->where('author', $id)->get('forum_topics')->num_rows();
    }

    public function getCountPostCategory($id)
    {
        return $this->db->select('author')->where('forums', $id)->get('forum_topics')->num_rows();
    }

    public function getCountPostGeneral()
    {
        return $this->db->select('*')->get('forum_topics')->num_rows();
    }

    public function getCountPostReplies()
    {
        return $this->db->select('*')->get('forum_replies')->num_rows();
    }

    public function getCountUsers()
    {
        return $this->db->select('*')->get('users')->num_rows();
    }

    public function getLastPostCategory($id)
    {
        return $this->db->select('*')->where('forums', $id)->limit('1')->order_by('date', 'DESC')->get('forum_topics');
    }

    public function getLastPosts()
    {
        return $this->db->select('*')->limit('5')->order_by('date', 'ASC')->get('forum_topics');
    }

    public function getLastReplies($id)
    {
        return $this->db->select('*')->where('topic', $id)->limit('1')->order_by('date', 'DESC')->get('forum_replies');
    }

    public function getLastRepliesCount($id)
    {
        return $this->db->select('id')->where('topic', $id)->get('forum_replies')->num_rows();
    }

    public function getRowTopicExist($id)
    {
        return $this->db->select('id')->where('id', $id)->get('forum_topics')->num_rows();
    }

    public function insertTopic($category, $title, $userid, $description, $locked, $pinned)
    {
        $function = '[Guardian/Topic]';
        $type = '1';
        $log_enter = $this->logs->__setLogs($userid, $category, $type, $function, $title);
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
        return true;
    }

    public function getIDPostPerDate($date)
    {
        return $this->db->select('id')->where('date', $date)->get('forum_topics')->row('id');
    }

    public function updateTopic($idlink, $title, $description, $locked, $pinned)
    {
        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'title' => $title,
            'content' => $description,
            'locked' => $locked,
            'pinned' => $pinned
        );

        $this->db->where('id', $idlink)->update('forum_topics', $data);

        redirect(base_url('forum/topic/').$idlink,'refresh');
    }

    public function getType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('forum')->row('type');
    }

    public function getTopicTitle($id)
    {
        return $this->db->select('title')->where('id', $id)->get('forum_topics')->row('title');
    }

    public function getTopicDescription($id)
    {
        return $this->db->select('content')->where('id', $id)->get('forum_topics')->row('content');
    }

    public function getCategoryForums($category)
    {
        return $this->db->select('id, name, category, description, icon, type')->where('category', $category)->get('forum')->result();
    }

    public function getCategoryName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('forum')->row('name');
    }

    public function getCategoryRows($id)
    {
        return $this->db->select('category')->where('category', $id)->get('forum')->num_rows();
    }

    public function getForumName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('forum')->row('name');
    }

    public function getSpecifyCategoryPosts($id)
    {
        return $this->db->select('*')->where('forums', $id)->order_by('id', 'ASC')->get('forum_topics');
    }

    public function getSpecifyCategoryPostsPined($id)
    {
        return $this->db->select('*')->where('forums', $id)->where('pinned', '1')->order_by('id', 'DESC')->get('forum_topics');
    }

    public function getSpecifyPostName($id)
    {
        return $this->db->select('title')->where('id', $id)->get('forum_topics')->row('title');
    }

    public function getSpecifyPostAuthor($id)
    {
        return $this->db->select('author')->where('id', $id)->get('forum_topics')->row('author');
    }

    public function getSpecifyPostDate($id)
    {
        return $this->db->select('date')->where('id', $id)->get('forum_topics')->row('date');
    }

    public function getSpecifyPostContent($id)
    {
        return $this->db->select('content')->where('id', $id)->get('forum_topics')->row('content');
    }

    public function getTopicLocked($id)
    {
        return $this->db->select('locked')->where('id', $id)->get('forum_topics')->row('locked');
    }

    public function getTopicPinned($id)
    {
        return $this->db->select('pinned')->where('id', $id)->get('forum_topics')->row('pinned');
    }

    public function getTopicForum($id)
    {
        return $this->db->select('forums')->where('id', $id)->get('forum_topics')->row('forums');
    }

    public function addReportByUserId($report, $reportuser, $idtopic)
    {
      $data = array(
        'userid' => $report,
        'userreported' => $reportuser,
        'topic' => $idtopic
      );
      $this->db->insert('mod_report');
    }
}
