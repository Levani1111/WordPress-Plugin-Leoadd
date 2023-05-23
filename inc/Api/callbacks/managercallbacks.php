<?php

/**
 * @package Leoadd
 */

namespace Inc\Api\callbacks;

use \Inc\base\basecontroller;

class managercallbacks extends basecontroller
{

    public function checkbox_sanitize($input)
    {
        // return filter_var($input, FILTER_SANITIZE_NUMBER_INT);

        // sanitize checkbox
        return (isset($input) ? true : false);
    }

    public function admin_section_manager()
    {
        echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
    }

    public function checkbox_field($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $checkbox = get_option($name);
       echo '<input type="checkbox" name=" ' . $name .  '" value="1" class="' . $classes . '" ' . ($checkbox ? 'checked' : "" ) . '>';
    }
}
