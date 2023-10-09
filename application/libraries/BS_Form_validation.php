<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class BS_Form_validation extends CI_Form_validation
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
     * Alpha-numeric with periods, underscores and dashes
     *
     * @param string
     * @return bool
     */
    public function alpha_period($str)
    {
        return (bool) preg_match('/^[a-z0-9._-]+$/i', $str);
    }

    /**
     * Is Unique
     *
     * Check if the input value doesn't already exist
     * in the specified database field.
     *
     * @param string $str
     * @param string $field
     * @return bool
     */
    public function is_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        return is_object($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, [$field => $str])->num_rows() === 0)
            : false;
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
        if (! is_numeric($val)) {
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
        if (! is_numeric($val)) {
            return false;
        }

        $text = preg_replace('/\s+/', ' ', strip_tags($str));

        return $val >= mb_strlen(trim($text));
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
     * Valid Boolean
     *
     * @param string $str
     * @return bool
     */
    public function valid_boolean($str)
    {
        return filter_var($str, FILTER_VALIDATE_BOOLEAN) !== false;
    }

    /**
     * Valid Captcha
     *
     * @param string $str
     * @return bool
     */
    public function valid_captcha($str)
    {
        $type = $this->CI->config->item('captcha_type');

        switch ($type) {
            case 'recaptcha':
                $siteverify = 'https://www.google.com/recaptcha/api/siteverify';
                break;

            case 'turnstile':
                $siteverify = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
                break;

            default:
                $siteverify = 'https://hcaptcha.com/siteverify';
                break;
        }

        // Send POST request to verify captcha response
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $siteverify);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret'   => decrypt($this->CI->config->item('captcha_secretkey')),
            'response' => $str
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        // Decode response
        $data = json_decode($response);

        if ($data->success) {
            return true;
        }

        return false;
    }

    /**
     * Valid Date
     *
     * @param string $str
     * @param string $format
     * @return bool
     */
    public function valid_date($str, $format)
    {
        $date = \DateTime::createFromFormat($format, $str);

        return $date && $date->format($format) === $str;
    }

    /**
     * Valid Domain
     *
     * @param string $str
     * @return bool
     */
    public function valid_domain($str)
    {
        return filter_var($str, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) !== false;
    }

    /**
     * Valid IP Address
     * 
     * Check if the input contains a valid
     * format for an IPv4/v6 or Range block
     *
     * @param string
     * @return bool
     */
    public function valid_ip_address($str)
    {
        return (bool) preg_match('/^[0-9a-f*.\/:]+$/i', $str);
    }

    /**
     * Is user field unique
     *
     * Check if the input value doesn't already exist
     * in the specified database field.
     *
     * @param string $str
     * @param string $field
     * @return bool
     */
    public function is_user_field_unique($str, $field)
    {
        if ($this->CI->user_model->user_exists($str, $field) || $this->CI->user_token_model->userdata_exists($str, $field)) {
            return false;
        }

        if (in_array($field, ['username', 'email'], true)) {
            if ($this->CI->server_auth_model->account_exists($str, $field)) {
                return false;
            }
        }

        return true;
    }
}
