<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model
{
	public function getUserInfoGeneral($id)
	{
		return $this->db->where('id', $id)->get('users');
	}

	public function getCharDPTotal($id)
	{
		$qq = $this->db->select('dp')->where('id', $id)->get('users');

		if ($qq->num_rows())
			return $qq->row('dp');
		else
			return '0';
	}

	public function getCharVPTotal($id)
	{
		$qq = $this->db->select('vp')->where('id', $id)->get('users');

		if ($qq->num_rows())
			return $qq->row('vp');
		else
			return '0';
	}

	public function getEmulatorAction()
	{
		$emulator = config_item('emulator_legacy');

		if($emulator == true)
		{
			switch($emulator)
			{
				case true:
					return "1";
				break;
			}
		}

	}

	public function getExpansionAction()
	{
		$expansion = config_item('expansion');
		switch ($expansion)
		{
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
				return "1";
			break;
			case 6:
			case 7:
			case 8:
				return "2";
			break;
		}
	}

	public function getRealExpansionDB()
	{
		$expansion = config_item('expansion');
		switch ($expansion)
		{
			case 1:
				return "0";
				break;
			case 2:
				return "1";
				break;
			case 3:
				return "2";
				break;
			case 4:
				return "3";
				break;
			case 5:
				return "4";
				break;
			case 6:
				return "5";
				break;
			case 7:
				return "6";
				break;
			case 8:
				return "7";
				break;
		}
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

	public function smtpSendEmail($to, $subject, $message)
	{
		$this->load->library('email');

		$this->email->initialize([
			'protocol'    => 'smtp',
			'smtp_host'   => config_item('smtp_host'),
			'smtp_user'   => config_item('smtp_user'),
			'smtp_pass'   => config_item('smtp_pass'),
			'smtp_port'   => config_item('smtp_port'),
			'smtp_crypto' => config_item('smtp_crypto'),
			'mailtype'    => 'html',
			'charset'     => 'utf-8'
		]);

		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$this->email->to($to);
		$this->email->from(config_item('email_settings_sender'), config_item('email_settings_sender_name'));
		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
	}

	public function getMenu()
	{
		return $this->db->get('menu')->result();
	}

	public function getMenuChild($id)
	{
		return $this->db->where('child', $id)->get('menu')->result();
	}
}
