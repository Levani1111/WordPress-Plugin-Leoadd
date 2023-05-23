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
        // sanitize checkbox
        // return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
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
		$checkbox = get_option( $name );
		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $name . '" value="1" class="" ' . ($checkbox ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
    }
}
