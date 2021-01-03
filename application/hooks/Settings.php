<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings
{
	public function initialize()
	{
		$CI =& get_instance();

		$options = ($CI->load->database() === FALSE) ? $CI->Settings_model->get_all() : FALSE;

		if ($options)
		{
			foreach ($options as $option)
			{
				$CI->config->set_item($option->key, $option->value);
			}
		}
	}
}