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

if (! function_exists('html_purify'))
{
    /**
     * Purify input using the HTMLPurifier
     *
     * @param string $content
     * @param string|null $type
     * @return string
     */
    function html_purify($content, $type = null)
    {
        $config = \HTMLPurifier_HTML5Config::createDefault();

        $config->set('Core.Encoding', 'UTF-8');

        switch ($type) {
            case 'comment':
                $html_allowed = ['p[style]', 'a[href|title]', 'br', 'b', 'strong', 'i', 'em', 's', 'strike', 'u', 'ul[style]', 'ol[style]', 'li', 'span[style]', 'img[style|width|height|alt|src]'];
                $css_properties = ['height', 'width', 'min-height', 'min-width', 'max-height', 'max-width', 'list-style-type', 'text-decoration', 'text-align'];
                break;
            case 'content':
                $html_allowed = ['p[style]', 'a[href|title]', 'br', 'b', 'strong', 'i', 'em', 's', 'strike', 'u', 'ul[style]', 'ol[style]', 'li', 'span[style]', 'img[width|height|alt|src]', 'h1[style]', 'h2[style]', 'h3[style]', 'h4[style]', 'h5[style]', 'h6[style]', 'sup', 'sub', 'table', 'thead', 'tr', 'th[style]', 'tbody', 'td[style]'];
                $css_properties = ['height', 'width', 'min-height', 'min-width', 'max-height', 'max-width', 'list-style-type', 'font', 'font-size', 'font-style', 'font-family', 'color', 'text-decoration', 'text-align'];
                break;
            default:
                $html_allowed = ['p', 'a[href|title]', 'br', 'b', 'strong', 'i', 'em', 's', 'strike', 'u', 'ul', 'ol', 'li', 'span', 'img[width|height|alt|src]', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'sup', 'sub', 'pre', 'blockquote', 'div', 'table', 'thead', 'tr', 'th', 'tbody', 'td'];
                $css_properties = [];
                break;
        }

        $config->set('HTML.Allowed', implode(',', $html_allowed));

        if (! empty($css_properties)) {
            $config->set('CSS.AllowedProperties', implode(',', $css_properties));
        }

        $config->set('AutoFormat.AutoParagraph', true);
        $config->set('AutoFormat.Linkify', true);
        $config->set('AutoFormat.RemoveEmpty', true);

        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($content);
    }
}