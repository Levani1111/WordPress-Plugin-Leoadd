<?php

/**
 * @package Leoadd
 */

namespace Inc\Api\callbacks;



class cptcallbacks
{

    public function cpt_section()
    {
        echo 'Manage your Custom Post Types';
    }

    // public function checkbox_field($args)
    // {
    //     $name = $args['label_for'];
    //     $classes = $args['class'];
    //     $option_name = $args['option_name'];
    //     $checkbox = get_option($option_name);
    //     $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

    //     echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
    // }
}
