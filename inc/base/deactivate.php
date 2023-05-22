<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

class deactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
