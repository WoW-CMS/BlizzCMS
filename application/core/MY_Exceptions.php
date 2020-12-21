<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * 404 Error Handler
	 *
	 * @param string $page
	 * @param bool $log_error
	 * @return void
	 */
	public function show_404($page = '', $log_error = TRUE)
	{
		if (is_cli())
		{
			$heading = 'Not Found';
			$message = 'The controller/method pair you requested was not found.';

			// By default we log this, but allow a dev to skip it
			if ($log_error)
			{
				log_message('error', $heading.': '.$page);
			}

			echo parent::show_error($heading, $message, 'error_404', 404);
			exit(4); // EXIT_UNKNOWN_FILE
		}
		else
		{
			$data['heading'] = '404 Page Not Found';
			$data['message'] = 'The page you requested was not found.';

			// By default we log this, but allow a dev to skip it
			if ($log_error)
			{
				log_message('error', $data['heading'].': '.$page);
			}

			$CI =& get_instance();
			$CI->load->helper('url');
			$CI->load->library('template');

			$CI->template->title($CI->lang->line('error_404'));
			$output = $CI->template->build('404', $data, TRUE);

			set_status_header(404);
			echo $output;
			exit(4); // EXIT_UNKNOWN_FILE
		}
	}
}