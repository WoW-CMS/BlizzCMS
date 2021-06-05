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

if (! function_exists('encrypt'))
{
	/**
	 * Encrypt
	 *
	 * @param mixed $string
	 * @return mixed
	 */
	function encrypt($data)
	{
		$CI = &get_instance();

		$CI->load->library('encryption');

		$CI->encryption->initialize([
			'driver' => 'openssl',
			'cipher' => 'aes-192',
			'mode'   => 'cbc',
			'key'    => hex2bin(config_item('encryption_key'))
		]);

		return $CI->encryption->encrypt($data);
	}
}

if (! function_exists('decrypt'))
{
	/**
	 * Decrypt
	 *
	 * @param mixed $data
	 * @return mixed
	 */
	function decrypt($data)
	{
		$CI = &get_instance();

		$CI->load->library('encryption');

		$CI->encryption->initialize([
			'driver' => 'openssl',
			'cipher' => 'aes-192',
			'mode'   => 'cbc',
			'key'    => hex2bin(config_item('encryption_key'))
		]);

		return $CI->encryption->decrypt($data);
	}
}

if (! function_exists('race_name'))
{
	/**
	 * Get race name
	 *
	 * @param int $id
	 * @return string
	 */
	function race_name($id)
	{
		$data  = get_instance()->lang->load('wow', '', TRUE);
		$races = $data['races'];

		return array_key_exists($id, $races) ? $races[$id] : lang('unknown');
	}
}

if (! function_exists('class_name'))
{
	/**
	 * Get class name
	 *
	 * @param int $id
	 * @return string
	 */
	function class_name($id)
	{
		$data    = get_instance()->lang->load('wow', '', TRUE);
		$classes = $data['classes'];

		return array_key_exists($id, $classes) ? $classes[$id] : lang('unknown');
	}
}

if (! function_exists('zone_name'))
{
	/**
	 * Get specific name of a zone
	 *
	 * @param int $id
	 * @return string
	 */
	function zone_name($id)
	{
		$data  = get_instance()->lang->load('wow', '', TRUE);
		$zones = $data['zones'];

		return array_key_exists($id, $zones) ? $zones[$id] : lang('unknown');
	}
}

if (! function_exists('faction_name'))
{
	/**
	 * Get faction name from race
	 *
	 * @param int $id
	 * @return string
	 */
	function faction_name($id)
	{
		$alliance = [1, 3, 4, 7, 11, 22, 25, 29, 30, 32, 34, 37];
		$horde    = [2, 5, 6, 8, 9, 10, 26, 27, 28, 31, 35, 36];

		if (in_array($id, $alliance))
		{
			return lang('alliance');
		}

		if (in_array($id, $horde))
		{
			return lang('horde');
		}

		return lang('unknown');
	}
}

if (! function_exists('zip_status'))
{
	/**
	 * Get zip status from code
	 *
	 * @param int $value
	 * @return string
	 */
	function zip_status($value)
	{
		switch ($value)
		{
			case \ZipArchive::ER_EXISTS:
				return lang('zip_already_exists');
				break;
			case \ZipArchive::ER_INCONS:
				return lang('zip_inconsistent');
				break;
			case \ZipArchive::ER_MEMORY:
				return lang('zip_memory_error');
				break;
			case \ZipArchive::ER_NOENT:
				return lang('zip_not_exist');
				break;
			case \ZipArchive::ER_NOZIP:
				return lang('zip_not_format');
				break;
			case \ZipArchive::ER_OPEN:
				return lang('zip_cant_open');
				break;
			case \ZipArchive::ER_READ:
				return lang('zip_read_error');
				break;
			case \ZipArchive::ER_SEEK:
				return lang('zip_seek_error');
				break;
			default:
				return lang('unknown');
				break;
		}
	}
}