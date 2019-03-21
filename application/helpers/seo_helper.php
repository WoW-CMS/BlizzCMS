<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SEO Helper
 *
 * Generates Meta tags for search engines optimizations, open graph, twitter, robots
 *
 * @author		ProjectCMS.net (Author @sayghteight)
 * @version     1.0
 */
 
if(! function_exists('meta_tags')){

  function meta_tags(){

    $CI =& get_instance();
    $CI->config->load('seo');

    $output = '';
    /**
     * Title of your website
     *
     * @var	string
     *
     */
     $title = $CI->config->item('seo_title');

     /**
      * Meta desc of your website
      *
      * @var	string
      *
      */
      $meta_description = $CI->config->item('seo_meta_desc');

      /**
       * Meta Keywords
       *
       * @var	string
       *
       */
       $meta_keywords = $CI->config->item('seo_meta_keywords');

       /**
        * SEO Imgurl
        *
        * @var	string
        *
        */
        $imgurl = $CI->config->item('seo_imgurl');

        /**
         * Url website
         *
         * @var	string
         *
         */
         $url = $CI->config->item('base_url');

         if($CI->config->item('seo_meta_enable'))
         {
           $output .= '<meta name="description" content="'.$meta_description.'" />' .PHP_EOL
            .'<meta name="keywords" content="'.$meta_keywords.'" />' .PHP_EOL;
         }

         if($CI->config->item('seo_og_enable'))
         {
           $output .=
                '<meta property="og:title" content="'.$title.'"/>' .PHP_EOL
                .'<meta property="og:type" content="'.$meta_description.'"/>' .PHP_EOL
                .'<meta property="og:image" content="'.$imgurl.'"/>' .PHP_EOL
                .'<meta property="og:url" content="'.$url.'"/>' .PHP_EOL;
        }

        if($CI->config->item('seo_twitter_enable'))
        {
          $output .=
            '<meta name="twitter:card" content="summary"/>' .PHP_EOL
           .'<meta name="twitter:title" content="'.$title.'"/>' .PHP_EOL
           .'<meta name="twitter:url" content="'.$url.'"/>' .PHP_EOL
           .'<meta name="twitter:description" content="'.$meta_description.'"/>' .PHP_EOL
           .'<meta name="twitter:image" content="'.$imgurl.'"/>' .PHP_EOL;
       }
    echo $output;
  }


}
