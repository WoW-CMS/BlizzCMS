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

if (! function_exists('game_hash'))
{
	/**
	 * Generate hashed password for game account
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $type
	 * @param mixed $salt
	 * @return mixed
	 */
	function game_hash($username, $password, $type = 'classic', $salt = null)
	{
		switch ($type)
		{
			case 'classic':
				return strtoupper(sha1(strtoupper($username) . ':' . strtoupper($password)));
				break;
			case 'bnet':
				return strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($username)) . ':' . strtoupper($password))))))));
				break;
			case 'srp6':
				// Constants
				$g = gmp_init(7);
				$N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
				// Calculate first hash
				$h1 = sha1(strtoupper($username.':'.$password), TRUE);
				// Calculate second hash
				$h2 = sha1($salt.$h1, TRUE);
				// Convert to integer (little-endian)
				$h2 = gmp_import($h2, 1, GMP_LSW_FIRST);
				// g^h2 mod N
				$verifier = gmp_powm($g, $h2, $N);
				// Convert back to a byte array (little-endian)
				$verifier = gmp_export($verifier, 1, GMP_LSW_FIRST);
				// Pad to 32 bytes, remember that zeros go on the end in little-endian!
				$verifier = str_pad($verifier, 32, chr(0), STR_PAD_RIGHT);
				return $verifier;
				break;
			default:
				return '';
				break;
		}
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

if (! function_exists('time_converter'))
{
	/**
	 * Convert timestamp to elapsed time
	 *
	 * @param int $time
	 * @return string
	 */
	function time_converter($time)
	{
		$init    = new \DateTime('@0');
		$elapsed = new \DateTime('@' . $time);

		return $init->diff($elapsed)->format('%aD %hH %iM %sS');
	}
}

if (! function_exists('interval_time'))
{
	/**
	 * Add interval to current time
	 * 
	 * @param string $string
	 * @return int
	 */
	function interval_time($string)
	{
		if (! is_string($string))
		{
			return 0;
		}

		$date = new \DateTime();
		$new  = $date->add(new \DateInterval($string));

		return $new->getTimestamp();
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
		switch ($id)
		{
			case 1:
				return lang('human');
				break;
			case 2:
				return lang('orc');
				break;
			case 3:
				return lang('dwarf');
				break;
			case 4:
				return lang('night_elf');
				break;
			case 5:
				return lang('undead');
				break;
			case 6:
				return lang('tauren');
				break;
			case 7:
				return lang('gnome');
				break;
			case 8:
				return lang('troll');
				break;
			case 9:
				return lang('goblin');
				break;
			case 10:
				return lang('blood_elf');
				break;
			case 11:
				return lang('draenei');
				break;
			case 22:
				return lang('worgen');
				break;
			case 24:
				return lang('panda_neutral');
				break;
			case 25:
				return lang('panda_alliance');
				break;
			case 26:
				return lang('panda_horde');
				break;
			case 27:
				return lang('nightborne');
				break;
			case 28:
				return lang('highmountain_tauren');
				break;
			case 29:
				return lang('void_elf');
				break;
			case 30:
				return lang('lightforged_draenei');
				break;
			case 34:
				return lang('dark_iron_dwarf');
				break;
			case 36:
				return lang('maghar_orc');
				break;
			default:
				return lang('unknown');
				break;
		}
	}
}

if (! function_exists('race_icon'))
{
	/**
	 * Get race icon
	 *
	 * @param int $id
	 * @return string
	 */
	function race_icon($id)
	{
		switch ($id)
		{
			case 1:
				return 'human.jpg';
				break;
			case 2:
				return 'orc.jpg';
				break;
			case 3:
				return 'dwarf.jpg';
				break;
			case 4:
				return 'night_elf.jpg';
				break;
			case 5:
				return 'undead.jpg';
				break;
			case 6:
				return 'tauren.jpg';
				break;
			case 7:
				return 'gnome.jpg';
				break;
			case 8:
				return 'troll.jpg';
				break;
			case 9:
				return 'goblin.jpg';
				break;
			case 10:
				return 'blood_elf.jpg';
				break;
			case 11:
				return 'draenei.jpg';
				break;
			case 22:
				return 'worgen.jpg';
				break;
			case 25:
				return 'pandaren_male.jpg';
				break;
			case 26:
				return 'pandaren_female.jpg';
				break;
			// Legion Support Race Allied (BFA)
			case 27:
				return 'nightborne.png';
				break;
			case 28:
				return 'highmountain.png';
				break;
			case 29:
				return 'voidelf.png';
				break;
			case 30:
				return 'lightforged.png';
				break;
			case 34:
				return 'irondwarf.png';
				break;
			case 36:
				return 'magharorc.png';
				break;
			default:
				return '';
				break;
		}
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
		switch ($id)
		{
			case 1:
				return lang('warrior');
				break;
			case 2:
				return lang('paladin');
				break;
			case 3:
				return lang('hunter');
				break;
			case 4:
				return lang('rogue');
				break;
			case 5:
				return lang('priest');
				break;
			case 6:
				return lang('death_knight');
				break;
			case 7:
				return lang('shamman');
				break;
			case 8:
				return lang('mage');
				break;
			case 9:
				return lang('warlock');
				break;
			case 10:
				return lang('monk');
				break;
			case 11:
				return lang('druid');
				break;
			case 12:
				return lang('demon_hunter');
				break;
			default:
				return lang('unknown');
				break;
		}
	}
}

if (! function_exists('class_icon'))
{
	/**
	 * Get class icon
	 *
	 * @param int $id
	 * @return string
	 */
	function class_icon($id)
	{
		switch ($id)
		{
			case 1:
				return 'warrior.png';
				break;
			case 2:
				return 'paladin.png';
				break;
			case 3:
				return 'hunter.png';
				break;
			case 4:
				return 'rogue.png';
				break;
			case 5:
				return 'priest.png';
				break;
			case 6:
				return 'dk.png';
				break;
			case 7:
				return 'shaman.png';
				break;
			case 8:
				return 'mage.png';
				break;
			case 9:
				return 'warlock.png';
				break;
			case 10:
				return 'monk.png';
				break;
			case 11:
				return 'druid.png';
				break;
			case 12:
				return 'demonhunter.png';
				break;
			default:
				return '';
				break;
		}
	}
}

if (! function_exists('faction_icon'))
{
	/**
	 * Get faction icon from race id
	 *
	 * @param int $id
	 * @return string
	 */
	function faction_icon($id)
	{
		switch ($id)
		{
			case 1:
			case 3:
			case 4:
			case 7:
			case 11:
			case 22:
			case 25:
			case 29:
			case 30:
			case 34:
				return 'alliance.png';
			break;
			case 2:
			case 5:
			case 6:
			case 8:
			case 9:
			case 10:
			case 26:
			case 27:
			case 28:
			case 36:
				return 'horde.png';
			break;
			default:
				return '';
				break;
		}
	}
}