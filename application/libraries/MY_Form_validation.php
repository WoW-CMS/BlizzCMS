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

class MY_Form_validation extends CI_Form_validation
{
    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    public $CI;

    public function __construct($rules = [])
    {
        parent::__construct($rules);
    }

    /**
     * Alphanumeric characters, spaces, and  ~ ! # $ % & [ ] * - _ + = | : . characters
     *
     * @param string
     * @return bool
     */
    public function alpha_numeric_special($str)
    {
        return (bool) preg_match('/^[A-Z0-9 ~!#$%\&\[\]\*\-_+=|:.]+$/i', $str);
    }

    /**
     * Minimum Richtext Length
     *
     * @param string $str
     * @param string $val
     * @return bool
     */
    public function richtext_min($str, $val)
    {
        if (! is_numeric($val))
        {
            return false;
        }

        $text = preg_replace('/\s+/', ' ', strip_tags($str));

        return $val <= mb_strlen(trim($text));
    }

    /**
     * Max Richtext Length
     *
     * @param string $str
     * @param string $val
     * @return bool
     */
    public function richtext_max($str, $val)
    {
        if (! is_numeric($val))
        {
            return false;
        }

        $text = preg_replace('/\s+/', ' ', strip_tags($str));

        return $val >= mb_strlen(trim($text));
    }

    /**
     * Check if the string has a valid date/datetime format
     *
     * @param string $str
     * @param string $format
     * @return bool
     */
    public function validate_date($str, $format)
    {
        $d = \DateTime::createFromFormat($format, $str);

        return $d && $d->format($format) === $str;
    }

    /**
     * Update Unique
     *
     * @param string $str
     * @param string $field
     * @return bool
     */
    public function update_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return is_object($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, [$field => $str, 'id !=' => $id])->num_rows() === 0)
            : false;
    }

    /**
     * Validate Captcha
     *
     * @param string $str
     * @return bool
     */
    public function validate_captcha($str)
    {
        $private = $this->CI->config->item('captcha_private');
        $type    = $this->CI->config->item('captcha_type');

        $url = ($type == 'hcaptcha') ? 'https://hcaptcha.com/siteverify' : 'https://www.google.com/recaptcha/api/siteverify';
        $data = http_build_query(['secret' => $private, 'response' => $str]);

        // Send POST Request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode Response
        $decode = json_decode($response, true);

        if ($decode['success'])
        {
            return true;
        }

        return false;
    }
}