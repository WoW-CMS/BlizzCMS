<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright   Copyright (c) 2019-2020, WoW-CMS (https://wow-cms.com/)
 * @copyright   Copyright (c) 2008-2009, Haloweb Ltd (http://haloweb.co.uk/)
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions
{
	/**
	 * Reference to the CodeIgniter instance
	 *
	 * @var object
	 */
	private $CI;

	private $user_permission;
	private $permissions;
	private $group;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->permissions = [];
		$this->user_permission = [];

		// set group from session (if set)
		$this->group = (!empty($this->CI->session->userdata('blizz_sess_rank'))) ? $this->CI->session->userdata('blizz_sess_rank') : 0;
	}

	/**
	 * Get permissions of user
	 *
	 * Return all permission of user or a group.
	 *
	 * @param int $group
	 * @return array
	 */
	public function user_permissions($group = null)
	{
		if (is_null($group)) {
			$group = $this->group;
		}

		$query = $this->CI->db->select('key')
			->from('permissions')
			->join('permissions_linked', 'permissions_linked.permission_id = permissions.id')
			->where('group_id', $group)
			->get();

		if ($query->num_rows()) {
			foreach ($query->result_array() as $row) {
				$user_permission[] = $row['key'];
			}
			return $user_permission;
		}

		return [];
	}

	/**
	 * Get permissions
	 *
	 * Return all permission or only permission from a group.
	 *
	 * @param int $group
	 * @return mixed
	 */
	public function get_permissions($group = null)
	{
		$this->CI->db->select('DISTINCT(category)');

		if (!is_null($group)) {
			$this->CI->db->where_in('key', $this->user_permissions($group));
		}

		$this->CI->db->order_by('category');

		$query = $this->CI->db->get('permissions');

		if ($query->num_rows()) {
			foreach ($query->result_array() as $row) {
				if ($category_perms = $this->permissions_from_category($row['category'])) {
					$permissions[$row['category']] = $category_perms;
				}
				else
				{
					$permissions[$row['category']] = 'N/A';
				}
			}
			return $permissions;
		}

		return false;
	}

	/**
	 * Get permissions from category
	 *
	 * Return all permission of a category name.
	 *
	 * @param string $category
	 * @return mixed
	 */
	public function permissions_from_category($category = null)
	{
		if (!empty($category)) {
			$this->CI->db->where('category', $category);
		}

		$query = $this->CI->db->get('permissions');

		if ($query->num_rows()) {
			return $query->result_array();
		}

		return false;
	}

	/**
	 * Permission map
	 *
	 * Return a map of key from a group.
	 *
	 * @param int $group
	 * @return mixed
	 */
	public function permission_map($group)
	{
		$query = $this->CI->db->select('permission_id')
			->where('group_id', $group)
			->get('permissions_linked');

		if ($query->num_rows()) {
			return $query->result_array();
		}

		return false;
	}


	/**
	 * Get Groups
	 *
	 * Return all groups
	 *
	 * @return mixed
	 */
	public function get_groups()
	{
		$query = $this->CI->db->select('*')->get('permissions_groups');

		if ($query->num_rows()) {
			return $query->result_array();
		}

		return false;
	}
}

