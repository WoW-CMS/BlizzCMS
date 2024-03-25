<?php

namespace App\Libraries;

use App\Models\Setting;
use CodeIgniter\Files\FileCollection;
use \Config\Services;
use \Config\Database;

use function PHPUnit\Framework\isJson;

class Multilanguage
{
    /**
     * Default language
     * 
     * @var string
     */
    private $defaultLanguage = 'en';

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
     * Languages locales
     * 
     * @var array
     */
    private $locales = [];

    public function __construct()
    {
        $db = Database::connect();
        if ($db->tableExists('settings')) {
            $settings_model = new Setting();

            $default = $settings_model->find('app_language')->value ?? 'english';
            $supported = $settings_model->find('app_supported_languages')->value;
            $this->defaultLanguage = $default;

            if (isJson($supported)) {
                $this->supportedLanguages = json_decode($supported);
            }
        }

        $this->_initialize();
        $this->_detectLanguage();

        log_message('info', 'Multilanguage library initialized');
    }

    private function _initialize()
    {
        $files = new FileCollection([
            APPPATH . 'Language/'
        ]);
        $files = $files->get();

        $configInstall = new \Config\Install();

        $allowedLanguages = array_merge($this->supportedLanguages, [$this->defaultLanguage]);

        foreach ($files as $file) {
            if (!str_contains($file, 'Language.php')) {
                continue;
            }

            $name = explode("/", str_replace(APPPATH . 'Language/', '', $file))[0];

            // If the config file does not exist it will not show, but it
            // will also not show if it is not entered in the supported languages
            if (!in_array($name, $allowedLanguages, true) && !$configInstall->active) {
                continue;
            }

            $data = require $file;

            if (!is_array($data)) {
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
    private function _detectLanguage()
    {
        $session = Services::session();

        $browserLanguage = $session->get('language');

        if (array_key_exists((string) $browserLanguage, $this->languages)) {
            $this->currentLanguage = $browserLanguage;
        } else {
            $headerLanguage = explode(',', preg_replace('/(;\s?q=[0-9\.]+)|\s/i', '', trim((string) $_SERVER['HTTP_ACCEPT_LANGUAGE'])));

            if (count($headerLanguage) === 0) {
                $this->currentLanguage = $this->defaultLanguage;
            } else {
                $primary = substr(strtolower($headerLanguage[0]), 0, 2);

                if (array_key_exists($primary, $this->locales)) {
                    $this->currentLanguage = $this->locales[$primary];
                } elseif (!array_key_exists($primary, $this->locales) && array_key_exists($headerLanguage[0], $this->locales)) {
                    $this->currentLanguage = $this->locales[$headerLanguage[0]];
                } else {
                    $this->currentLanguage = $this->defaultLanguage;
                }
            }
        }


        $session->set('language', $this->currentLanguage);
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
    public function getLanguage(string $language, string $key = null): string|null
    {
        if (!array_key_exists($language, $this->languages)) {
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
    public function setLanguage($locale)
    {
        if (array_key_exists($locale, $this->locales)) {
            $session = Services::session();
            $session->set('language', $this->locales[$locale]);
            return true;
        }

        return false;
    }

    /**
     * Get the current language or information from it.
     * 
     * @param string|null $key
     * @return mixed
     */
    public function currentLanguage(string $key = null)
    {
        if ($key === null) {
            if (array_key_exists($this->currentLanguage, $this->languages)) {
                return $this->currentLanguage;
            }

            return $this->defaultLanguage;
        }

        $data = $this->getLanguage($this->currentLanguage, $key);

        if ($data !== null) {
            return $data;
        }

        return $this->getLanguage($this->defaultLanguage, $key);
    }
}
