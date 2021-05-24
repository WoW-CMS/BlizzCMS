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

if (! function_exists('money_converter'))
{
	/**
	 * Convert an amount of game money to a format
	 *
	 * @param int|string $amount
	 * @return string
	 */
	function money_converter($amount)
	{
		$gold_piece   = substr($amount, 0, -4);
		$silver_piece = substr($amount, -4, -2);
		$copper_piece = substr($amount, -2);

		$g = is_string($gold_piece) ? (int) $gold_piece : 0;
		$s = is_string($silver_piece) ? (int) $silver_piece : 0;
		$c = is_string($copper_piece) ? (int) $copper_piece : 0;

		return sprintf('%1$dg %2$ds %3$dc', $g, $s, $c);
	}
}

if (! function_exists('ordinal'))
{
	/**
	 * Set suffix indicator to number
	 * 
	 * @param int $number
	 * @return string
	 */
	function ordinal($number)
	{
		$nf = new \NumberFormatter('en', \NumberFormatter::ORDINAL);

		return $nf->format($number);
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