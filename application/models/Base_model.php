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
		return $this->db->where('child', $id)->get($this->menu)->result();
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
		return $this->db->where('id_new', $id)->order_by('date', 'ASC')->limit($limit, $start)->get($this->news_comments)->result();
	}

	/**
	 * Count all comments of a news
	 *
	 * @param int $id
	 * @return int
	 */
	public function count_news_comments($id)
	{
		return $this->db->where('id_new', $id)->count_all_results($this->news_comments);
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
	 * @param string $uri
	 * @return object
	 */
	public function get_page($uri)
	{
		return $this->db->where('uri_friendly', $uri)->get($this->pages)->row();
	}

	/**
	 * Find if the page exists
	 *
	 * @param string $uri
	 * @return boolean
	 */
	public function find_page($uri)
	{
		$query = $this->db->where('uri_friendly', $uri)->get($this->pages)->num_rows();

		return ($query == 1);
	}

	/**
	 * Get all avatars rows
	 *
	 * @return array
	 */
	public function get_avatars()
	{
		return $this->db->order_by('id', 'ASC')->get('avatars')->result();
	}

	public function getSpecifyZone($zoneid)
	{
		$qq = $this->db->select('zone_name')->where('id', $zoneid)->get('zones');

		if($qq->num_rows())
			return $qq->row('zone_name');
		else
			return lang('unknown');
	}

	public function tinyEditor($rank)
	{
		switch ($rank) {
			case 'Admin':
				return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
						<script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: true,
							plugins: ['preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr insertdatetime advlist lists wordcount imagetools textpattern help'],
							toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor backcolor | link emoticons image media | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
						</script>";
				break;
			case 'User':
				return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
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
