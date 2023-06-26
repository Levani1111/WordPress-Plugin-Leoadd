<?php

/**
 * @package Leoadd
 */

namespace Inc\base;


class activate
{
    public static function activate()
    {
        flush_rewrite_rules();

        $fefault = array();

        if (!get_option('leoadd_plugin')) {
            update_option('leoadd_plugin', $fefault);
        }

        if (!get_option('leoadd_plugin_cpt')) {
            update_option('leoadd_plugin_cpt', $fefault);
        }
    }
}
