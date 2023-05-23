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

        if (get_option('leoadd_plugin')) {
            return;
        }

        $fefault = array();

        update_option('leoadd_plugin', $fefault);
    }
}
