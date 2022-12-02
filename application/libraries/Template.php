<?php
/**
 * @author Philip Sturgeon
 * @author WoW-CMS
 * @copyright Copyright (c) 2011 - 2019, Philip Sturgeon (https://phil.tech)
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license http://dbad-license.org DBAD License
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
    private $_module = '';
    private $_controller = '';
    private $_method = '';

    private $_theme = null;
    private $_theme_path = null;
    private $_layout = false; // By default, dont wrap the view with anything
    private $_layout_subdir = ''; // Layouts and partials will exist in views/layouts
    // but can be set to views/foo/layouts with a subdirectory

    private $_title = '';
    private $_head_tags = [];
    private $_body_tags = [];

    private $_partials = [];

    private $_breadcrumbs = [];

    private $_title_separator = ' — ';

    private $_parser_enabled = true;
    private $_parser_body_enabled = true;

    private $_theme_locations = [];

    private $_is_mobile = false;

    // Minutes that cache will be alive for
    private $cache_lifetime = 0;

    private $_ci;

    private $_data = [];

    function __construct($config = [])
    {
        $this->_ci =& get_instance();

        if (! empty($config))
        {
            $this->initialize($config);
        }

        log_message('info', 'Template Class Initialized');
    }

    /**
     * Initialize preferences
     *
     * @param array $config
     * @return void
     */
    function initialize($config = [])
    {
        foreach ($config as $key => $val)
        {
            $this->{'_' . $key} = $val;
        }

        // No locations set in config?
        if ($this->_theme_locations === [])
        {
            // Let's use this obvious default
            $this->_theme_locations = [APPPATH . 'themes/'];
        }

        if ($this->_ci->load->database() === false)
        {
            $this->_ci->load->model('setting_model');

            $this->_theme = $this->_ci->setting_model->get_value('app_theme') ?? '';
        }

        // Theme was set
        if ($this->_theme)
        {
            $this->set_theme($this->_theme);
        }

        // If the parse is going to be used, best make sure it's loaded
        if ($this->_parser_enabled === true)
        {
            $this->_ci->load->library('parser');
        }

        // Modular Separation / Modular Extensions has been detected
        if (method_exists($this->_ci->router, 'fetch_module'))
        {
            $this->_module = $this->_ci->router->fetch_module();
        }

        // What controllers or methods are in use
        $this->_controller = $this->_ci->router->fetch_class();
        $this->_method     = $this->_ci->router->fetch_method();

        // Load user agent library if not loaded
        $this->_ci->load->library('user_agent');

        // We'll want to know this later
        $this->_is_mobile = $this->_ci->agent->is_mobile();
    }

    /**
     * Magic Get function to get data
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : null;
    }

    /**
     * Magic Set function to set data
     *
     * @param string $name
     * @param string $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    /**
     * Set data using a chainable metod. Provide two strings or an array of data.
     *
     * @param string $name
     * @param string $value
     * @return mixed
     */
    public function set($name, $value = null)
    {
        // Lots of things! Set them all
        if (is_array($name) || is_object($name))
        {
            foreach ($name as $item => $value)
            {
                $this->_data[$item] = $value;
            }
        }
        // Just one thing, set that
        else
        {
            $this->_data[$name] = $value;
        }

        return $this;
    }

    /**
     * Build the entire HTML output combining partials, layouts and views.
     *
     * @param string $view
     * @param array $data
     * @param bool $return
     * @return void
     */
    public function build($view, $data = [], $return = false)
    {
        // Set whatever values are given. These will be available to all view files
        is_array($data) OR $data = (array) $data;

        // Merge in what we already have with the specific data
        $this->_data = array_merge($this->_data, $data);

        // We don't need you any more buddy
        unset($data);

        if (empty($this->_title))
        {
            $this->_title = $this->_guess_title();
        }

        // Output template variables to the template
        $template['title']       = $this->_title;
        $template['breadcrumbs'] = $this->_breadcrumbs;

        $template['head_tags'] = empty($this->_head_tags) ? '' : implode(PHP_EOL . '    ', $this->_head_tags) . PHP_EOL;
        $template['body_tags'] = empty($this->_body_tags) ? '' : implode(PHP_EOL . '    ', $this->_body_tags) . PHP_EOL;

        $template['location'] = base_url('application/themes/' . $this->get_theme() . '/');
        $template['assets']   = base_url('assets/');
        $template['uploads']  = base_url('uploads/');

        $template['partials'] = [];

        // Assign by reference, as all loaded views will need access to partials
        $this->_data['template'] =& $template;

        foreach ($this->_partials as $name => $partial)
        {
            // We can only work with data arrays
            is_array($partial['data']) OR $partial['data'] = (array) $partial['data'];

            // If it uses a view, load it
            if (isset($partial['view']))
            {
                $template['partials'][$name] = $this->_find_view($partial['view'], $partial['data']);
            }
            // Otherwise the partial must be a string
            else
            {
                if ($this->_parser_enabled === true)
                {
                    $partial['string'] = $this->_ci->parser->parse_string($partial['string'], $this->_data + $partial['data'], true, true);
                }

                $template['partials'][$name] = $partial['string'];
            }
        }

        // Disable sodding IE7's constant cacheing!!
        $this->_ci->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        $this->_ci->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->_ci->output->set_header('Pragma: no-cache');

        // Let CI do the caching instead of the browser
        $this->_ci->output->cache($this->cache_lifetime);

        // Test to see if this file
        $this->_body = $this->_find_view($view, [], $this->_parser_body_enabled);

        // Want this file wrapped with a layout file?
        if ($this->_layout)
        {
            // Added to $this->_data['template'] by refference
            $template['body'] = $this->_body;

            // Find the main body and 3rd param means parse if its a theme view (only if parser is enabled)
            $this->_body = self::_load_view('layouts/' . $this->_layout, $this->_data, true, self::_find_view_folder());
        }

        // Want it returned or output to browser?
        if (! $return)
        {
            $this->_ci->output->set_output($this->_body);
        }

        return $this->_body;
    }

    /**
     * Set the title of the page
     *
     * @param string
     * @return void
     */
    public function title()
    {
        // If we have some segments passed
        if (func_num_args() >= 1)
        {
            $title_segments = func_get_args();
            $this->_title = implode($this->_title_separator, $title_segments);
        }

        return $this;
    }

    /**
     * Add head tags before all head data
     *
     * @param string $line
     * @return void
     */
    public function prepend_metadata($line)
    {
        array_unshift($this->_head_tags, $line);
        return $this;
    }

    /**
     * Add head tags after all head data
     *
     * @param string $line
     * @return void
     */
    public function append_metadata($line)
    {
        $this->_head_tags[] = $line;
        return $this;
    }

    /**
     * Add tags to head
     *
     * @param array $data
     * @return void
     */
    public function head_tags($data)
    {
        $items = [];

        foreach ($data as $key => $item)
        {
            if (! is_int($key) || empty($item))
            {
                continue;
            }

            $name       = $item[0];
            $attributes = $item[1];

            if (empty($name) || empty($attributes) || ! is_array($attributes))
            {
                continue;
            }

            $items[] = $this->_build_tag($attributes, $name);
        }

        $tags = array_filter($items);

        if (! empty($tags))
        {
            foreach ($tags as $tag)
            {
                $this->_head_tags[] = $tag;
            }
        }

        return $this;
    }

    /**
     * Add tags to body
     *
     * @param array $data
     * @return void
     */
    public function body_tags($data)
    {
        $items = [];

        foreach ($data as $key => $item)
        {
            if (! is_int($key) || empty($item))
            {
                continue;
            }

            $name       = $item[0];
            $attributes = $item[1];
            $allowed    = ['script'];

            if (empty($name) || ! in_array($name, $allowed, true) || empty($attributes) || ! is_array($attributes))
            {
                continue;
            }

            $items[] = $this->_build_tag($attributes, $name);
        }

        $tags = array_filter($items);

        if (! empty($tags))
        {
            foreach ($tags as $tag)
            {
                $this->_body_tags[] = $tag;
            }
        }

        return $this;
    }

    /**
     * Set meta tags for SEO
     *
     * @param array $data
     * @param bool $default
     * @return bool
     */
    public function set_meta_tags($data, $default = false)
    {
        $site_name   = config_item('app_name');
        $description = config_item('seo_description_tag');
        $seo         = config_item('seo_tags') ?? false;
        $open_graph  = config_item('seo_og_tags') ?? false;
        $items       = [];

        if ($seo)
        {
            if (array_key_exists('description', $data) && ! $default)
            {
                $items[] = ['meta', ['name' => 'description', 'content' => $data['description']]];
            }
            elseif (! array_key_exists('description', $data) && $default)
            {
                $items[] = ['meta', ['name' => 'description', 'content' => $description]];
            }

            if (array_key_exists('robots', $data))
            {
                $items[] = ['meta', ['name' => 'robots', 'content' => $data['robots']]];
            }
        }

        if ($open_graph)
        {
            if (array_key_exists('title', $data) && ! $default)
            {
                $items[] = ['meta', ['property' => 'og:title', 'content' => $data['title'] . $this->_title_separator . $site_name]];
            }
            elseif (! array_key_exists('title', $data) && $default)
            {
                $items[] = ['meta', ['property' => 'og:title', 'content' => $site_name]];
            }

            if (array_key_exists('type', $data))
            {
                $items[] = ['meta', ['property' => 'og:type', 'content' => $data['type']]];
            }

            if (array_key_exists('description', $data) && ! $default)
            {
                $items[] = ['meta', ['property' => 'og:description', 'content' => $data['description']]];
            }
            elseif (! array_key_exists('description', $data) && $default)
            {
                $items[] = ['meta', ['property' => 'og:description', 'content' => $description]];
            }

            if (array_key_exists('url', $data))
            {
                $items[] = ['meta', ['property' => 'og:url', 'content' => $data['url']]];
            }

            $items[] = ['meta', ['property' => 'og:site_name', 'content' => $site_name]];

            if (array_key_exists('image', $data))
            {
                $items[] = ['meta', ['property' => 'og:image', 'content' => $data['image']]];
            }
        }

        if (empty($items))
        {
            return false;
        }

        $this->head_tags($items);
        return true;
    }

    /**
     * Set a theme for the template library to use
     *
     * @param string $theme
     * @return void
     */
    public function set_theme($theme = null)
    {
        $this->_theme = $theme;

        foreach ($this->_theme_locations as $location)
        {
            if ($this->_theme && file_exists($location . $this->_theme))
            {
                $this->_theme_path = rtrim($location . $this->_theme . '/');
                break;
            }
        }

        return $this;
    }

    /**
     * Get the current theme
     *
     * @return string
     */
     public function get_theme()
     {
         return $this->_theme;
     }

    /**
     * Get the current theme path
     *
     * @return string
     */
    public function get_theme_path()
    {
        return $this->_theme_path;
    }


    /**
     * Set a theme layout for the template library to use
     *
     * @param string $view
     * @param string $_layout_subdir
     * @return void
     */
    public function set_layout($view, $_layout_subdir = '')
    {
        $this->_layout = $view;

        $_layout_subdir AND $this->_layout_subdir = $_layout_subdir;

        return $this;
    }

    /**
     * Set a view partial
     *
     * @param string $name
     * @param string $view
     * @param array $data
     * @return void
     */
    public function set_partial($name, $view, $data = [])
    {
        $this->_partials[$name] = ['view' => $view, 'data' => $data];
        return $this;
    }

    /**
     * Set a view partial
     *
     * @param string $name
     * @param string $string
     * @param array $data
     * @return void
     */
    public function inject_partial($name, $string, $data = [])
    {
        $this->_partials[$name] = ['string' => $string, 'data' => $data];
        return $this;
    }


    /**
     * Helps build custom breadcrumb trails
     *
     * @param string $name
     * @param string $uri
     * @return void
     */
    public function set_breadcrumb($name, $uri = '')
    {
        $this->_breadcrumbs[] = ['name' => $name, 'uri' => $uri];
        return $this;
    }

    /**
     * Set a the cache lifetime
     *
     * @param int $minutes
     * @return void
     */
    public function set_cache($minutes = 0)
    {
        $this->cache_lifetime = $minutes;
        return $this;
    }


    /**
     * Enabled parser
     *
     * @param bool $bool
     * @return void
     */
    public function enable_parser($bool)
    {
        $this->_parser_enabled = $bool;
        return $this;
    }

    /**
     * Enabled parser for body
     *
     * @param bool $view
     * @return void
     */
    public function enable_parser_body($bool)
    {
        $this->_parser_body_enabled = $bool;
        return $this;
    }

    /**
     * List the locations where themes may be stored
     *
     * @return array
     */
    public function theme_locations()
    {
        return $this->_theme_locations;
    }

    /**
     * Set another location for themes to be looked in
     *
     * @param string $location
     * @return void
     */
    public function add_theme_location($location)
    {
        $this->_theme_locations[] = $location;
        return $this;
    }

    /**
     * Check if a theme exists
     *
     * @param string $theme
     * @return bool
     */
    public function theme_exists($theme = null)
    {
        $theme OR $theme = $this->_theme;

        foreach ($this->_theme_locations as $location)
        {
            if (is_dir($location . $theme))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all current layouts
     *
     * @return array
     */
    public function get_layouts()
    {
        $layouts = [];

        foreach (glob(self::_find_view_folder() . 'layouts/*.*') as $layout)
        {
            $layouts[] = pathinfo($layout, PATHINFO_BASENAME);
        }

        return $layouts;
    }

    /**
     * Get all layouts of theme
     *
     * @param string $theme
     * @return array
     */
    public function get_theme_layouts($theme = null)
    {
        $theme OR $theme = $this->_theme;

        $layouts = [];

        foreach ($this->_theme_locations as $location)
        {
            // Get special web layouts
            if (is_dir($location . $theme . '/views/web/layouts/'))
            {
                foreach (glob($location . $theme . '/views/web/layouts/*.*') as $layout)
                {
                    $layouts[] = pathinfo($layout, PATHINFO_BASENAME);
                }
                break;
            }

            // So there are no web layouts, assume all layouts are web layouts
            if (is_dir($location . $theme . '/views/layouts/'))
            {
                foreach (glob($location . $theme . '/views/layouts/*.*') as $layout)
                {
                    $layouts[] = pathinfo($layout, PATHINFO_BASENAME);
                }
                break;
            }
        }

        return $layouts;
    }

    /**
     * Check if a theme layout exists
     *
     * @param string $layout
     * @return bool
     */
    public function layout_exists($layout)
    {
        // If there is a theme, check it exists in there
        if (! empty($this->_theme) && in_array($layout, self::get_theme_layouts()))
        {
            return true;
        }

        // Otherwise look in the normal places
        return file_exists(self::_find_view_folder() . 'layouts/' . $layout . self::_ext($layout));
    }

    /**
     * Load views from theme paths if they exist.
     *
     * @param string $view
     * @param array $data
     * @return array
     */
    public function load_view($view, $data = [])
    {
        return $this->_find_view($view, (array) $data);
    }

    // find layout files, they could be mobile or web
    private function _find_view_folder()
    {
        if ($this->_ci->load->get_var('template_views'))
        {
            return $this->_ci->load->get_var('template_views');
        }

        // Base view folder
        $view_folder = APPPATH . 'views/';

        // Using a theme? Put the theme path in before the view folder
        if (! empty($this->_theme))
        {
            $view_folder = $this->_theme_path . 'views/';
        }

        // Would they like the mobile version?
        if ($this->_is_mobile === true && is_dir($view_folder . 'mobile/'))
        {
            // Use mobile as the base location for views
            $view_folder .= 'mobile/';
        }

        // Use the web version
        elseif (is_dir($view_folder . 'web/'))
        {
            $view_folder .= 'web/';
        }

        // Things like views/admin/web/view admin = subdir
        if ($this->_layout_subdir)
        {
            $view_folder .= $this->_layout_subdir . '/';
        }

        // If using themes store this for later, available to all views
        $this->_ci->load->vars('template_views', $view_folder);
        
        return $view_folder;
    }

    // A module view file can be overriden in a theme
    private function _find_view($view, array $data, $parse_view = true)
    {
        // Only bother looking in themes if there is a theme
        if (! empty($this->_theme))
        {
            foreach ($this->_theme_locations as $location)
            {
                $theme_views = [
                    $this->_theme . '/modules/' . $this->_module . '/' . $view,
                    $this->_theme . '/views/' . $view
                ];

                foreach ($theme_views as $theme_view)
                {
                    if (file_exists($location . $theme_view . self::_ext($theme_view)))
                    {
                        return self::_load_view($theme_view, $this->_data + $data, $parse_view, $location);
                    }
                }
            }
        }

        // Not found it yet? Just load, its either in the module or root view
        return self::_load_view($view, $this->_data + $data, $parse_view);
    }

    private function _load_view($view, array $data, $parse_view = true, $override_view_path = null)
    {
        // Sevear hackery to load views from custom places AND maintain compatibility with Modular Extensions
        if ($override_view_path !== null)
        {
            if ($this->_parser_enabled === true && $parse_view === true)
            {
                // Load content and pass through the parser
                $content = $this->_ci->parser->parse_string($this->_ci->load->file(
                    $override_view_path . $view.self::_ext($view), 
                    true
                ), $data, true);
            }
            else
            {
                $this->_ci->load->vars($data);
                
                // Load it directly, bypassing $this->load->view() as ME resets _ci_view
                $content = $this->_ci->load->file(
                    $override_view_path . $view.self::_ext($view),
                    true
                );
            }
        }
        // Can just run as usual
        else
        {
            // Grab the content of the view (parsed or loaded)
            $content = ($this->_parser_enabled === true && $parse_view === true)

                // Parse that bad boy
                ? $this->_ci->parser->parse($view, $data, true)

                // None of that fancy stuff for me!
                : $this->_ci->load->view($view, $data, true);
        }

        return $content;
    }

    private function _guess_title()
    {
        $this->_ci->load->helper('inflector');

        // Obviously no title, lets get making one
        $title_parts = [];

        // If the method is something other than index, use that
        if ($this->_method !== 'index')
        {
            $title_parts[] = $this->_method;
        }

        // Make sure controller name is not the same as the method name
        if (! in_array($this->_controller, $title_parts))
        {
            $title_parts[] = $this->_controller;
        }

        // Is there a module? Make sure it is not named the same as the method or controller
        if (! empty($this->_module) && ! in_array($this->_module, $title_parts))
        {
            $title_parts[] = $this->_module;
        }

        // Glue the title pieces together using the title separator setting
        $title = humanize(implode($this->_title_separator, $title_parts));

        return $title;
    }

    private function _ext($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION) ? '' : '.php';
    }

    /**
     * Build html tags with attributes
     *
     * @param array $data
     * @param string $tag
     * @return void
     */
    private function _build_tag($data, $tag)
    {
        $attributes = [];

        foreach ($data as $key => $value)
        {
            $attribute = preg_replace('/[^a-z0-9-]+/i', '', $key);
            $content   = $value === null ? '' : '="' . strip_tags($value) . '"';

            $attributes[] = $attribute . $content;
        }

        $line = ' ' . implode(' ', $attributes);

        switch ($tag)
        {
            case 'link':
                return '<link' . $line . '>';

            case 'meta':
                return '<meta' . $line . '>';

            case 'script':
                return '<script' . $line . '></script>';

            default:
                return '';
        }
    }
}
