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

class Language
{
    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    private $CI;

    /**
     * List of language codes
     *
     * @var array
     */
    private $codes = [];

    /**
     * List of languages
     *
     * @var array
     */
    private $languages = [];

    /**
     * Full name of the browser's language
     *
     * @var string
     */
    private $browser;

    /**
     * Full name of the user's language
     *
     * @var string
     */
    private $user;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->library('session');

        $this->load_languages();

        $this->browser_language();

        $this->user_language();
    }

    /**
     * Detect and check if the browser language is supported, 
     * if not it will set the default language of the config
     *
     * @return void
     */
    private function browser_language()
    {
        $locale = strtolower(\Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']));
        $code   = substr($locale, 0, 2);

        if (array_key_exists($code, $this->codes))
        {
            $this->browser = $this->codes[$code];
        }
        elseif (array_key_exists($locale, $this->codes) && ! array_key_exists($code, $this->codes))
        {
            $this->browser = $this->codes[$locale];
        }
        else
        {
            $this->browser = $this->CI->config->item('language');
        }
    }

    /**
     * Load the user's language preference, if it does not have
     * the default language of the browser will load
     *
     * @return void
     */
    private function user_language()
    {
        $this->user = $this->CI->session->userdata('lang');

        if (! $this->user)
        {
            $this->CI->session->set_userdata(['lang' => $this->browser]);
            $this->user = $this->browser;
        }
    }

    /**
     * Load all installed languages
     *
     * @return void
     */
    private function load_languages()
    {
        $folders   = directory_map(APPPATH.'language', 1, false);
        $codes     = [];
        $languages = [];

        foreach ($folders as $folder)
        {
            $file = APPPATH . "language/{$folder}/lang_info.php";
            $lang = stripslashes(trim($folder, " /\t\n\r\0\x0B"));

            // If the file does not exist will not show in the list
            if (! file_exists($file))
            {
                continue;
            }

            $load = require $file;

            $codes[$load['code']] = $lang;
            $languages[$lang] = $load;
        }

        $this->codes     = $codes;
        $this->languages = $languages;
    }

    /**
     * Get list of languages
     *
     * @return string
     */
    public function list()
    {
        return $this->languages;
    }

    /**
     * Get the currently language
     *
     * @return string
     */
    public function current()
    {
        if (in_array($this->user, array_values($this->codes), true))
        {
            return $this->user;
        }

        return $this->CI->config->item('language');
    }

    /**
     * Get the currently language code
     *
     * @return string
     */
    public function current_code()
    {
        if (! array_key_exists($this->user, $this->languages))
        {
            return null;
        }

        return $this->languages[$this->user]['code'];
    }

    /**
     * Get the currently language name
     *
     * @return string
     */
    public function current_name()
    {
        if (! array_key_exists($this->user, $this->languages))
        {
            return null;
        }

        return $this->languages[$this->user]['name'];
    }

    /**
     * Change the language in the session
     *
     * @param string $code
     * @return bool
     */
    public function set($code)
    {
        if (array_key_exists($code, $this->codes))
        {
            $this->CI->session->set_userdata(['lang' => $this->codes[$code]]);
            return true;
        }

        return false;
    }
}