<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

use \Inc\base\basecontroller;

class settingslinks extends basecontroller
{

    public function register()
    {
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    }


    public function settings_link($links)
    {
        // add custom settings link
        $settings_link = '<a href="admin.php?page=leoadd_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}
