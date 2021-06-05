<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @copyright  Copyright (c) 2013-2015, Michel Roca (https://github.com/mRoca)
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
