<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Originaly CodeIgniter i18n library by Jérôme Jaglale
 * http://maestric.com/en/doc/php/codeigniter_i18n
 */

/**
 * If you use without  the HMVC modular extension uncomment this and remove other lines load the MX_Loader
 */
//class MY_Lang extends CI_Lang {

require APPPATH . "third_party/MX/Lang.php";

class MY_Lang extends MX_Lang {

	/**
	 * Supported Languages
	 * @access private
	 * @var array
	 */
	private $supported_languages = array(
	    'en' => array(
		'name' => 'English',
		'folder' => 'english',
		'direction' => 'ltr',
		'codes' => array('en', 'english', 'en_US'),
	    )
	);

	/**
	 * Current Language
	 * @access private
	 * @var string
	 */
	private $current_language = 'en';

	/**
	 * Special URIs
	 * @access private
	 * @var array
	 */
	private $special_uris = array(
	    ""
	);

	/**
	 * Current URI string
	 * @var string
	 */
	private $uri;

	/**
	 * Default URI
	 * @var string
	 */
	private $default_uri = '/';

	/**
	 * Detect browser langueage
	 * @var boolean
	 */
	private $detect_language = TRUE;

	/**
	 * Current language code
	 * @var string
	 */
	private $lang_code;

	/**
	 * __construct
	 *
	 * @global mixed $CFG
	 * @global mixed $URI
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		global $CFG;
		global $URI;

		require_once APPPATH . "config/language.php";

		$this->supported_languages = array_key_exists('supported_languages', $config) && !empty($config['supported_languages']) ? $config['supported_languages'] : $this->supported_languages;
		$this->current_language = array_key_exists('default_language', $config) && !empty($config['default_language']) ? $config['default_language'] : $this->current_language;
		$this->detect_language = array_key_exists('detect_language', $config) ? $config['detect_language'] : $this->detect_language;
		$this->default_uri = array_key_exists('default_uri', $config) ? $config['default_uri'] : $this->default_uri;
		$this->special_uris = array_key_exists('special_uris', $config) ? $config['special_uris'] : $this->special_uris;

		$this->uri = $URI->uri_string();

		$uri_segment = $this->get_uri_lang($this->uri);
		$this->lang_code = $uri_segment['lang'];

		$url_ok = FALSE;
		if((!empty($this->lang_code)) && (array_key_exists($this->lang_code, $this->supported_languages)))
		{
			$language = $this->supported_languages[$this->lang_code]['folder'];

			$CFG->set_item('language', $language);
			$this->current_language = $this->lang_code;
			$url_ok = TRUE;
		}

		if((!$url_ok) && (!$this->is_special($uri_segment['parts'][0]))) // special URI -> no redirect
		{
			// set default language
			$this->current_language = $this->default_lang();
			$CFG->set_item('language', $this->supported_languages[$this->current_language]['folder']);

			$uri = (!empty($this->uri)) ? $this->uri : $this->default_uri;
			$uri = ($uri[0] != '/') ? '/' . $uri : $uri;
			$new_url = $CFG->config['base_url'] . $this->default_lang() . $uri;

			header("Location: " . $new_url, TRUE, 302);
			exit;
		}
	}

	/**
	 * Get current language
	 *
	 * Return 'en' if language in CI config is 'english'
	 *
	 * @return string
	 */
	function lang()
	{
		return $this->current_language;
	}

	/**
	 * Is this url special ?
	 *
	 * @param string $lang_code
	 * @return boolean
	 */
	function is_special($lang_code)
	{
		if((!empty($lang_code)) && (in_array($lang_code, $this->special_uris)))
			return TRUE;
		else
			return FALSE;
	}

	/**
	 * Switch to another language
	 *
	 * @param string $lang
	 * @return string
	 */
	function switch_uri($lang)
	{
		if((!empty($this->uri)) && (array_key_exists($lang, $this->supported_languages)))
		{
			$uri_segment = $this->get_uri_lang($this->uri);

			if($uri_segment !== FALSE)
			{
				$uri_segment['parts'][0] = $lang;
				$uri = implode('/', $uri_segment['parts']);
			}
			else
			{
				$uri = $lang . '/' . $this->uri;
			}
		}

		return $uri;
	}

	/**
	 * Check if the language exists.
	 * When true returns an array with lang abbreviation + rest
	 *
	 * @param string $uri
	 * @return mixed boolean / array
	 */
	function get_uri_lang($uri = '')
	{
		if(!empty($uri))
		{
			$uri_segment = array();
			$uri = ($uri[0] == '/') ? substr($uri, 1) : $uri;

			$uri_expl = explode('/', $uri, 2);
			$uri_segment['lang'] = NULL;
			$uri_segment['parts'] = $uri_expl;

			if(array_key_exists($uri_expl[0], $this->supported_languages))
			{
				$uri_segment['lang'] = $uri_expl[0];
			}
			return $uri_segment;
		}
		else
			return FALSE;
	}

	/**
	 * Detecting browser language, or use the default language if not detected
	 *
	 * @return string
	 */
	function default_lang()
	{
		if($this->detect_language === TRUE)
		{
			$browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
			$browser_lang = substr($browser_lang, 0, 2);
			return (array_key_exists($browser_lang, $this->supported_languages)) ? $browser_lang : $this->current_language;
		}
		else
		{
			return $this->current_language;
		}
	}

	/**
	 * Add language segment to $uri (if appropriate)
	 *
	 * @param string $uri
	 * @return string
	 */
	function localized($uri)
	{
		if(!empty($uri))
		{
			$uri_segment = $this->get_uri_lang($uri);
			if(!$uri_segment['lang'])
			{

				if((!$this->is_special($uri_segment['parts'][0])) && (!preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri)))
				{
					$uri = $this->lang() . '/' . $uri;
				}
			}
		}
		return $uri;
	}

}

// END MY_Lang Class

/* End of file MY_Lang.php */
/* Location: ./application/core/MY_Lang.php */
