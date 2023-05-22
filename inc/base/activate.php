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
    }
}
