<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

use \Inc\base\basecontroller;

class enqueue extends basecontroller
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        // enqueue all our scripts
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_style('style', $this->plugin_url . 'assets/style.css');
        wp_enqueue_script('script', $this->plugin_url . 'assets/script.js');

    }
}
