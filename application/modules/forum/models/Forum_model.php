<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model
{
	protected $forum = 'forum';
	protected $forum_topics = 'forum_topics';
	protected $forum_posts = 'forum_posts';

	/**
	 * Get all forums
	 *
	 * @param int|null $parent
	 * @param string|null $type
	 * @return array
	 */
	public function get_all_forums($parent = 0, $type = null)
	{
		$query = $this->db;

		if (! is_null($parent))
		{
			$query = $query->where('parent', $parent);
		}

		if (in_array($type, ['category', 'forum'], true))
		{
			$query = $query->where('type', $type);
		}

		return $query->get($this->forum)->result();
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
	 * @param string|null $type
	 * @return boolean
	 */
	public function find_forum($id, $type = null)
	{
		$query = $this->db->where('id', $id);

		if (! is_null($type))
		{
			$query = $query->where('type', $type);
		}

		return ($query->get($this->forum)->num_rows() == 1);
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
		return $this->db->where('forum_id', $id)->order_by('stick', 'DESC')->order_by('created_at', 'ASC')->limit($limit, $start)->get($this->forum_topics)->result();
	}

	/**
	 * Count all topics of a forum
	 *
	 * @param int|null $id
	 * @return int
	 */
	public function count_topics($id = null)
	{
		if (! is_null($id))
		{
			return $this->db->where('forum_id', $id)->count_all_results($this->forum_topics);
		}

		return $this->db->count_all($this->forum_topics);
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
	 * @param int $limit
	 * @return array
	 */
	public function latest_topics($limit = 5)
	{
		return $this->db->order_by('created_at', 'ASC')->limit($limit)->get($this->forum_topics)->result();
	}

	/**
	 * Get last topic of a forum
	 *
	 * @param int $id
	 * @return array
	 */
	public function last_topic($id)
	{
		return $this->db->where('forum_id', $id)->order_by('created_at', 'DESC')->limit(1)->get($this->forum_topics)->result();
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
		if (! is_null($id))
		{
			return $this->db->where('topic_id', $id)->count_all_results($this->forum_posts);
		}

		return $this->db->count_all($this->forum_posts);
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

	/**
	 * Find if the post exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_post($id)
	{
		$query = $this->db->where('id', $id)->get($this->forum_posts)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get last post of a topic
	 *
	 * @param int $id
	 * @return array
	 */
	public function last_post($id)
	{
		return $this->db->where('topic_id', $id)->order_by('created_at', 'DESC')->limit(1)->get($this->forum_posts)->result();
	}

	public function count_users()
	{
		return $this->db->count_all('users');
	}
}
