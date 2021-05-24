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

if (! function_exists('current_date'))
{
	/**
	 * Get current datetime
	 * 
	 * @param string $timezone
	 * @return string
	 */
	function current_date($timezone = null)
	{
		if (empty($timezone))
		{
			$timezone = config_item('time_reference');
		}

		if ($timezone === 'local' || $timezone === date_default_timezone_get())
		{
			return date('Y-m-d H:i:s');
		}

		$datetime = new DateTime('now', new \DateTimeZone($timezone));

		return $datetime->format('Y-m-d H:i:s');
	}
}

if (! function_exists('elapsed_time'))
{
	/**
	 * Convert timestamp to elapsed time
	 *
	 * @param int $time
	 * @return string
	 */
	function elapsed_time($time)
	{
		$datetime = new \DateTime();
		$elapsed  = new \DateTime('@' . $time);

		return $datetime->diff($elapsed)->format('%aD %hH %iM %sS');
	}
}

if (! function_exists('interval_time'))
{
	/**
	 * Add interval to current time
	 * 
	 * @param string $string
	 * @param string $timezone
	 * @return string
	 */
	function interval_time($string, $timezone = null)
	{
		if (empty($timezone))
		{
			$timezone = config_item('time_reference');
		}

		$datetime = ($timezone === 'local' || $timezone === date_default_timezone_get()) ? new \DateTime('now') : new \DateTime('now', new \DateTimeZone($timezone));
		$interval = $datetime->add(new \DateInterval($string));

		return $interval->format('Y-m-d H:i:s');
	}
}