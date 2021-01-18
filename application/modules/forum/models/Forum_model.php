<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model
{
	protected $forum = 'forum';
	protected $forum_topics = 'forum_topics';
	protected $forum_posts = 'forum_posts';

	/**
	 * Get all categories
	 *
	 * @param int $parent
	 * @return array
	 */
	public function get_all_categories($parent = 0)
	{
		return $this->db->where(['type' => 'category', 'parent' => $parent])->get($this->forum)->result();
	}

	/**
	 * Get all forums of a category
	 *
	 * @param int $parent
	 * @return array
	 */
	public function get_all_forums($parent = 0)
	{
		return $this->db->where(['type' => 'forum', 'parent' => $parent])->get($this->forum)->result();
	}

	/**
	 * Get forum
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_forum($id)
	{
		return $this->db->where('id', $id)->get($this->forum)->row();
	}

	/**
	 * Find if the forum exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_forum($id)
	{
		$query = $this->db->where('id', $id)->get($this->forum)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get all topics of a forum
	 *
	 * @param int $id
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all_topics($id, $limit, $start)
	{
		return $this->db->where('forum_id', $id)->order_by('created_at', 'ASC')->limit($limit, $start)->get($this->forum_topics)->result();
	}

	/**
	 * Count all topics of a forum
	 *
	 * @param int|null $id
	 * @return int
	 */
	public function count_topics($id = null)
	{
		if (is_null($id))
		{
			return $this->db->count_all($this->forum_topics);
		}

		return $this->db->where('forum_id', $id)->count_all_results($this->forum_topics);
	}

	/**
	 * Get topic
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_topic($id)
	{
		return $this->db->where('id', $id)->get($this->forum_topics)->row();
	}

	/**
	 * Find if the topic exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_topic($id)
	{
		$query = $this->db->where('id', $id)->get($this->forum_topics)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get the latest topics
	 *
	 * @param $limit
	 * @return array
	 */
	public function latest_topics($limit = 5)
	{
		return $this->db->limit($limit)->order_by('created_at', 'ASC')->get($this->forum_topics)->result();
	}

	/**
	 * Get last topic of a forum
	 *
	 * @param int $id
	 * @return array
	 */
	public function last_topic($id)
	{
		return $this->db->where('forum_id', $id)->limit(1)->order_by('created_at', 'DESC')->get($this->forum_topics)->result();
	}

	/**
	 * Get all posts of a topic
	 *
	 * @param int $id
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_all_posts($id, $limit, $start)
	{
		return $this->db->where('topic_id', $id)->order_by('created_at', 'ASC')->limit($limit, $start)->get($this->forum_posts)->result();
	}

	/**
	 * Count all posts of a topic
	 *
	 * @param int|null $id
	 * @return int
	 */
	public function count_posts($id = null)
	{
		if (is_null($id))
		{
			return $this->db->count_all($this->forum_posts);
		}

		return $this->db->where('topic_id', $id)->count_all_results($this->forum_posts);
	}

	/**
	 * Get post
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_post($id)
	{
		return $this->db->where('id', $id)->get($this->forum_posts)->row();
	}

	public function count_users()
	{
		return $this->db->count_all('users');
	}
}
