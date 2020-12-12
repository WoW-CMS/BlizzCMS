<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model
{
	protected $menu = 'menu';
	protected $news = 'news';
	protected $news_comments = 'news_comments';
	protected $pages = 'pages';
	protected $slides = 'slides';

	/**
	 * Get all menu rows
	 *
	 * @return array
	 */
	public function get_menu()
	{
		if (! $this->db->table_exists($this->menu))
		{
			return [];
		}

		return $this->db->get($this->menu)->result();
	}

	/**
	 * Get all parent menu rows
	 *
	 * @param int $id
	 * @return array
	 */
	public function get_parent_menu($id)
	{
		return $this->db->where('parent', $id)->get($this->menu)->result();
	}

	/**
	 * Get all slides rows
	 *
	 * @return array
	 */
	public function get_slides()
	{
		if (! $this->db->table_exists($this->slides))
		{
			return [];
		}

		return $this->db->get($this->slides)->result();
	}

	/**
	 * Get news
	 *
	 * @param int $id
	 * @return object
	 */
	public function get_news($id)
	{
		return $this->db->where('id', $id)->get($this->news)->row();
	}

	/**
	 * Find if the news exists
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function find_news($id)
	{
		$query = $this->db->where('id', $id)->get($this->news)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get all comments of a news
	 *
	 * @param int $id
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_news_comments($id, $limit, $start)
	{
		return $this->db->where('news_id', $id)->order_by('created_at', 'ASC')->limit($limit, $start)->get($this->news_comments)->result();
	}

	/**
	 * Count all comments of a news
	 *
	 * @param int $id
	 * @return int
	 */
	public function count_news_comments($id)
	{
		return $this->db->where('news_id', $id)->count_all_results($this->news_comments);
	}

	/**
	 * Get news list
	 *
	 * @param int $limit
	 * @return array
	 */
	public function get_news_list($limit = 5)
	{
		return $this->db->order_by('id', 'DESC')->limit($limit)->get($this->news)->result();
	}

	/**
	 * Get page
	 *
	 * @param string $slug
	 * @return object
	 */
	public function get_page($slug)
	{
		return $this->db->where('slug', $slug)->get($this->pages)->row();
	}

	/**
	 * Find if the page exists
	 *
	 * @param string $slug
	 * @return boolean
	 */
	public function find_page($slug)
	{
		$query = $this->db->where('slug', $slug)->get($this->pages)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get all avatars rows
	 *
	 * @return array
	 */
	public function get_avatars()
	{
		return $this->db->get('avatars')->result();
	}

	/**
	 * Find if the module exists
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function find_module($name)
	{
		$data = $this->cache->file->get('modules');

		if ($data !== false)
		{
			return in_array($name, $data, true);
		}

		$query = $this->db->get('modules')->result_array();
		$list  = array_column($query, 'name');

		$this->cache->file->save('modules', $list, 604800);

		return in_array($name, $list, true);
	}

	/**
	 * Get specific name of a zone
	 *
	 * @param int $id
	 * @return string
	 */
	public function zone_name($id)
	{
		$data  = $this->lang->load('zones', '', TRUE);
		$zones = $data['zones'];

		return array_key_exists($id, $zones) ? $zones[$id] : lang('unknown');
	}

	public function tinyEditor($rank)
	{
		switch ($rank) {
			case 'Admin':
				return "<script src=".base_url('assets/tinymce/tinymce.min.js')."></script>
						<script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: true,
							plugins: ['preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr insertdatetime advlist lists wordcount imagetools textpattern help'],
							toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor backcolor | link emoticons image media | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
						</script>";
				break;
			case 'User':
				return "<script src=".base_url('assets/tinymce/tinymce.min.js')."></script>
						<script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: false,
							plugins: ['advlist autolink lists link image charmap textcolor searchreplace fullscreen media paste wordcount emoticons'],
							toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor | link emoticons image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
						</script>";
				break;
		}
	}

	public function send_email($to, $subject, $message)
	{
		$this->load->library('email');

		$this->email->initialize([
			'protocol'    => config_item('email_protocol'),
			'smtp_host'   => config_item('email_hostname'),
			'smtp_user'   => config_item('email_username'),
			'smtp_pass'   => config_item('email_password'),
			'smtp_port'   => config_item('email_port'),
			'smtp_crypto' => config_item('email_crypto'),
			'mailtype'    => 'html',
			'charset'     => 'utf-8',
			'newline'     => "\r\n"
		]);

		$this->email->to($to);
		$this->email->from(config_item('email_sender'), config_item('email_sender_name'));
		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
	}
}
