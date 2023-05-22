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
        wp_enqueue_style('mypluginstyle', $this->plugin_path . 'assets/style/style.css',);
        wp_enqueue_script('mypluginscript', $this->plugin_path . 'assets/js/script.js',);
    }
}
