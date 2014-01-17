<?php

require_once '../../plugin.php';

class Hello_Reader_Tests extends WP_UnitTestCase {
    private $plugin;
    
    function setUp()
    {
        parent::setUp();
        $this->plugin = $GLOBALS['hello-reader'];
    }
    
    function testPluginInitialization() {
        $this->assertFalse(null == $this->plugin);
    }
            
    function testAddWelcomeMessageTwitter() {
        $_SERVER['HTTP_REFERER'] = 'http://twitter.com';
        $this->assertContains('Welcome from Twitter!', 
                $this->plugin->add_welcome_message('This is a example post content'));
    }
    
    function testAddWelcomeMessageGoogle() {
        $_SERVER['HTTP_REFERER'] = 'http://google.com';
        $this->assertContains('Welcome from Google!', 
                $this->plugin->add_welcome_message('This is a example post content'));
    }
    
    function testIsComingFromTwitter() {
        $_SERVER['HTTP_REFERER'] = 'http://twitter.com';
        $this->assertTrue($this->plugin->is_coming_from_twitter(), 
                'is_from_twitter() will return true when the refering site is twitter');
    }
    
    function testIsNotComingFromTwitter() {
        $_SERVER['HTTP_REFERER'] = 'http://facebook.com';
        $this->assertFalse($this->plugin->is_coming_from_twitter(), 
                'is_from_twitter() will return true when the refering site is twitter');
    }
    
    function testIsComingFromGoogle() {
        $_SERVER['HTTP_REFERER'] = 'http://google.com';
        $this->assertTrue($this->plugin->is_coming_from_google(), 
                'is_from_twitter() will return true when the refering site is google');
    }
    
    function testIsNotComingFromGoogle() {
        $_SERVER['HTTP_REFERER'] = 'http://facebook.com';
        $this->assertFalse($this->plugin->is_coming_from_google(), 
                'is_from_twitter() will return true when the refering site is google');
    }
}
