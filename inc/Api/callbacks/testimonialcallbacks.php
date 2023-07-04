<?php

/**
 * @package Leoadd
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;


class testimonialcallbacks extends BaseController 
{
    public function shortcodePage()
    {
        return require_once( "$this->plugin_path/templates/testimonial.php" );
    }
}