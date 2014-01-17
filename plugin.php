<?php
/*
Plugin Name: Hello Reader
Plugin URI: http://github.com/deerawan/Hello-Reader
Description: A simple plugin to demonstrate unit testing
Version: 1.0
Author: Budi Irawan
Author URI: http://budiirawan.com
Author Email: deerawan@gmail.com
*/

if( !array_key_exists('hello-reader', $GLOBALS)) {
    class Hello_Reader {
        function __construct() {
            add_filter('the_content', array(&$this, 'add_welcome_message'));
        }
        
        function add_welcome_message( $content ) {
            if( $this->is_coming_from_twitter() )
                return 'Welcome from Twitter! ' . $content;
            elseif( $this->is_coming_from_google() )
                return 'Welcome from Google! ' . $content;
        }
        
        function is_coming_from_twitter() {
            return strpos($_SERVER['HTTP_REFERER'], 'twitter.com') > 0;
        }
        
        function is_coming_from_google() {
            return strpos($_SERVER['HTTP_REFERER'], 'google.com') > 0;
        }
    }
    
    $GLOBALS['hello-reader'] = new Hello_Reader();
}
