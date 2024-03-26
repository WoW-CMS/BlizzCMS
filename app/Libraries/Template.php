<?php

/**
 * @name      Template library system for BlizzCMS
 * @author Philip Sturgeon
 * @author WoW-CMS
 * @copyright Copyright (c) 2011 - 2019, Philip Sturgeon (https://phil.tech)
 * @copyright Copyright (c) 2019 - 2024, WoW-CMS (https://wow-cms.com)
 * @link      https://wow-cms.com/
 * @license http://dbad-license.org DBAD License
 * @license https://opensource.org/licenses/MIT MIT License
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace App\Libraries;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class Template
{
    /** Config Variables */

    private $_module = '';
    private $_controller = '';
    private $_method = '';
    private $_theme = null;
    private $_theme_path = null;
    private $_layout = false; // By default, dont wrap the view with anything
    private $_layout_subdir = ''; // Layouts and partials will exist in views/layouts
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

    private $_data = [];

    public function __construct(array $config = [])
    {
        $this->_ci = service('request');

        if (!empty($config))
        {
            $this->initialize($config);
        }

        log_message('info', 'Template Class Initialized');
    }

    public function initialize(array $config = [])
    {
        foreach ($config as $key => $val)
        {
            $this->{$key} = $val;
        }

        // No locations set in config?
        if (empty($this->_theme_locations))
        {
            // Let's use this obvious default
            $this->_theme_locations = [APPPATH . 'themes/'];
        }

        if (! $this->db)
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
        if ($this->_parser_enabled)
        {
            $this->_ci->parser = service('parser');
        }

        // Modular Separation / Modular Extensions has been detected
        if (method_exists($this->_ci->router, 'getModule'))
        {
            $this->_module = $this->_ci->router->getModule();
        }

        // What controllers or methods are in use
        $this->_controller = $this->_ci->router->controllerName();
        $this->_method     = $this->_ci->router->methodName();

        // Load user agent library if not loaded
        $this->_ci->userAgent = service('userAgent');

        // We'll want to know this later
        $this->_is_mobile = $this->_ci->userAgent->isMobile();
    }

    public function __get(string $name)
    {
        return $this->_data[$name] ?? null;
    }

    public function __set(string $name, string $value)
    {
        $this->_data[$name] = $value;
    }

    public function set($name, string $value)
    {
        if (is_array($name) || is_object($name))
        {
            foreach ($name as $key => $val) {
                $this->_data[$key] = $val;
            }
        } elseif (is_string($name)) {
            $this->_data[$name] = $value;
        } else {
            throw new InvalidArgumentException('Invalid input type. Expected string or array.');
        }

        return $this;
    }

    public function build(string $view, array $data = [], bool $return = false)
    {
        if (! is_array($data))
        {
            $data = (array) $data;
        }

        $this->_data = array_merge($this->_data, $data);

        unset($data);

        if (empty($this->_title))
        {
            $this->_title = $this->_guess_title();
        }

        $template = [
            'title' => $this->_title,
            'breadcrumbs' => $this->_breadcrumbs,
            'head_tags' => empty($this->_head_tags) ? '' : implode('    ', $this->_head_tags),
            'body_tags' => empty($this->_body_tags) ? '' : implode('    ', $this->_body_tags),
            'location' => base_url('app/themes/' . $this->get_theme() . '/'),
            'assets' => base_url('assets/'),
            'uploads' => base_url('uploads/'),
            'partials' => []
        ];

        $this->_data['template'] =& $template;

        foreach ($this->_partials as $name => $partial)
        {
            // We can only work with data arrays
            if (! is_array($partial['data'])) {
                $partial['data'] = (array) $partial['data'];
            }

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
                    $parser = \Config\Services::parser();
                    $partial['string'] = $parser->setData($this->_data + $partial['data'])->renderString($partial['string']);
                }

                $template['partials'][$name] = $partial['string'];
            }
        }

        // Disable sodding IE7's constant cacheing!!
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        header('Pragma: no-cache');

        // Let CI do the caching instead of the browser
        $this->response->cache($this->cache_lifetime);

        // Test to see if this file
        $this->_body = $this->_find_view($view, [], $this->_parser_body_enabled);

        // Want this file wrapped with a layout file?
        if ($this->_layout)
        {
            // Added to $this->_data['template'] by reference
            $template['body'] = $this->_body;

            // Find the main body and 3rd param means parse if its a theme view (only if parser is enabled)
            $this->_body = $this->render('layouts/' . $this->_layout, $this->_data, true, $this->_find_view_folder());
        }

        // Want it returned or output to browser?
        if (! $return)
        {
            echo $this->_body;
        }

        return $this->_body;
    }

}