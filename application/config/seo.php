<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * SEO Title
 *
 * Used by Metatags, Open Graph and Twitter Card
 *
*/
$config['seo_title'] = '';

/**
 *
 * SEO Imgurl
 *
 * Used by Metatags, Open Graph and Twitter Card
 *
*/
$config['seo_imgurl'] = '';

/**
 *
 * Metadata Status (Default: false)
 *
 * TRUE = Enable
 * FALSE = Disabled
 *
*/
$config['seo_meta_enable'] = FALSE;

/**
 *
 * Metadata  Description (320 characters allowed)
 *
 * Used by Metatags, Open Graph and Twitter Card
 *
*/
$config['seo_meta_desc'] = '';

/**
 *
 * Metadata  Keywords
 *
 * Used only Metatags
 *
*/
$config['seo_meta_keywords'] = '';

/**
 *
 * Twitter Card Status (Default: false)
 *
 * TRUE = Enable
 * FALSE = Disabled
 *
*/
$config['seo_twitter_enable'] = FALSE;

/**
 *
 * Open Graph Status (Default: false)
 *
 * TRUE = Enable
 * FALSE = Disabled
 *
*/
$config['seo_og_enable'] = FALSE;

/**
 *
 * Robots Status (Default: true)
 *
 * TRUE = Enable
 * FALSE = Disabled
 *
*/
$config['seo_robots_enable'] = TRUE;

/**
 *
 * Behavior robots (Default: 1)
 *
 * 1 => It allows indexing and tracking of the page and is the default value.
 *      Disregarding the meta robots tag is the same as using it with this configuration.
 * 2 => Avoid indexing but allow tracking. It is the ideal configuration
 *      when you do not want a page to appear in the search engine results.
 * 3 => It allows indexing but avoids tracking.
 * 4 => Avoid indexing and tracking.
 *
 *
*/
$config['seo_robots_config'] = 1;

/**
 *
 * Meta ViewPort (Default: False) [NOTE: Only Responsive designs]
 *
 * TRUE = Enable
 * FALSE = Disabled
 *
*/
$config['seo_meta_viewport'] = FALSE;
