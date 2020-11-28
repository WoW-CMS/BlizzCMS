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
		$init    = new DateTime('@0');
		$elapsed = new DateTime('@' . $time);
		return $init->diff($elapsed)->format('%aD %hH %iM %sS');
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
				return lang('race_human');
				break;
			case 2:
				return lang('race_orc');
				break;
			case 3:
				return lang('race_dwarf');
				break;
			case 4:
				return lang('race_night_elf');
				break;
			case 5:
				return lang('race_undead');
				break;
			case 6:
				return lang('race_tauren');
				break;
			case 7:
				return lang('race_gnome');
				break;
			case 8:
				return lang('race_troll');
				break;
			case 9:
				return lang('race_goblin');
				break;
			case 10:
				return lang('race_blood_elf');
				break;
			case 11:
				return lang('race_draenei');
				break;
			case 22:
				return lang('race_worgen');
				break;
			case 24:
				return lang('race_panda_neutral');
				break;
			case 25:
				return lang('race_panda_alli');
				break;
			case 26:
				return lang('race_panda_horde');
				break;
			case 27:
				return lang('race_nightborne');
				break;
			case 28:
				return lang('race_highmountain_tauren');
				break;
			case 29:
				return lang('race_void_elf');
				break;
			case 30:
				return lang('race_lightforged_draenei');
				break;
			case 34:
				return lang('race_dark_iron_dwarf');
				break;
			case 36:
				return lang('race_maghar_orc');
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
				return lang('class_warrior');
				break;
			case 2:
				return lang('class_paladin');
				break;
			case 3:
				return lang('class_hunter');
				break;
			case 4:
				return lang('class_rogue');
				break;
			case 5:
				return lang('class_priest');
				break;
			case 6:
				return lang('class_dk');
				break;
			case 7:
				return lang('class_shamman');
				break;
			case 8:
				return lang('class_mage');
				break;
			case 9:
				return lang('class_warlock');
				break;
			case 10:
				return lang('class_monk');
				break;
			case 11:
				return lang('class_druid');
				break;
			case 12:
				return lang('class_demonhunter');
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