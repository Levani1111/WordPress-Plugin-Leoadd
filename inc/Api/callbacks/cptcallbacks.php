<?php

/**
 * @package Leoadd
 */

namespace Inc\Api\callbacks;


class cptcallbacks
{

    public function cpt_section_manager()
    {
        echo 'Manage your Custom Post Types';
    }

    public function cpt_sanitize( $input )
    {
     return $input;
    }

    public function text_field( $args )
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $input = get_option($option_name);
    
        // Check if $input is a valid array
        if (is_array($input) && isset($input[$name])) {
            $value = $input[$name];
        } else {
            $value = '';
        }
    
        echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '">';
    }
    

    public function checkbox_field( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option($option_name);
        $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

        echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
    }
}
