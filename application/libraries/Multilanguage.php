<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Multilanguage
{
    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    private $CI;

    /**
     * Default language
     *
     * @var string
     */
    private $defaultLanguage = 'english';

    /**
     * Current language
     *
     * @var string
     */
    private $currentLanguage;

    /**
     * Supported languages
     *
     * @var array
     */
    private $supportedLanguages = [];

    /**
     * Languages
     *
     * @var array
     */
    private $languages = [];

    /**
     * Language locales
     *
     * @var array
     */
    private $locales = [];

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->library('session');

        if ($this->CI->load->database() === false) {
            $this->CI->load->model('setting_model');

            $default   = $this->CI->setting_model->get_value('app_language') ?? 'english';
            $supported = $this->CI->setting_model->get_value('app_supported_languages');

            $this->defaultLanguage = $default;

            if (is_json($supported)) {
                $this->supportedLanguages = json_decode($supported);
            }
        }

        $this->_initialize();
        $this->_detect_language();

        log_message('info', 'Multilanguage Class Initialized');
    }

    private function _initialize()
    {
        $location = APPPATH . 'language/';
        $files    = directory_map($location, 1);

        $allowedLanguages = array_merge($this->supportedLanguages, [$this->defaultLanguage]);

        foreach ($files as $file) {
            if (! is_dir($location . $file)) {
                continue;
            }

            $configFile = realpath($location . $file . 'language.php');
            $name       = trim(str_replace('/', '', stripslashes($file)));

            // If the config file does not exist it will not show, but it
            // will also not show if it is not entered in the supported languages
            if (! is_file($configFile) || ! $this->CI->config->item('installation_active') && ! in_array($name, $allowedLanguages, true)) {
                continue;
            }

            $data = require $configFile;

            if (! is_array($data)) {
                continue;
            }

            $this->languages[$name] = $data;
            $this->locales[$data['locale']] = $name;
        }
    }

    /**
     * Detect the browser language
     *
     * @return void
     */
    private function _detect_language()
    {
        $language = $this->CI->session->userdata('language');

        // Set the user's language if it is one of the supported languages
        if (array_key_exists((string) $language, $this->languages)) {
            $this->currentLanguage = $language;
        } else {
            $headerLanguage = explode(',', preg_replace('/(;\s?q=[0-9\.]+)|\s/i', '', trim((string) $this->CI->input->server('HTTP_ACCEPT_LANGUAGE'))));

            if (count($headerLanguage) === 0) {
                $this->currentLanguage = $this->defaultLanguage;
            } else {
                $primary = substr(strtolower($headerLanguage[0]), 0, 2);

                if (array_key_exists($primary, $this->locales)) {
                    $this->currentLanguage = $this->locales[$primary];
                } elseif (! array_key_exists($primary, $this->locales) && array_key_exists($headerLanguage[0], $this->locales)) {
                    $this->currentLanguage = $this->locales[$headerLanguage[0]];
                } else {
                    $this->currentLanguage = $this->defaultLanguage;
                }
            }
        }

        $this->CI->session->set_userdata('language', $this->currentLanguage);
    }

    /**
     * Get all loaded languages
     *
     * @return array
     */
    public function languages()
    {
        return $this->languages;
    }

    /**
     * Get details from loaded languages
     *
     * @param string $language
     * @param string|null $key
     * @return string|null
     */
    public function get_language($language, $key = null)
    {
        if (! array_key_exists($language, $this->languages)) {
            return null;
        }

        if ($key === null) {
            return $this->languages[$language];
        }

        if (array_key_exists($key, $this->languages[$language])) {
            return $this->languages[$language][$key];
        }

        return null;
    }

    /**
     * Sets language in the session data
     *
     * @param string $locale
     * @return bool
     */
    public function set_language($locale)
    {
        if (array_key_exists($locale, $this->locales)) {
            $this->CI->session->set_userdata('language', $this->locales[$locale]);
            return true;
        }

        return false;
    }

    /**
     * Get the current language or information from it
     *
     * @param string|null $key
     * @return mixed
     */
    public function current_language($key = null)
    {
        if ($key === null) {
            if (array_key_exists($this->currentLanguage, $this->languages)) {
                return $this->currentLanguage;
            }

            return $this->defaultLanguage;
        }

        $data = $this->get_language($this->currentLanguage, $key);

        if ($data !== null) {
            return $data;
        }

        return $this->get_language($this->defaultLanguage, $key);
    }
}
