<?php

/**
 * @package Leoadd
 */

namespace Inc\Api\callbacks;

use \Inc\base\basecontroller;

class admincallbacks extends basecontroller
{
    public function admin_dashboard()
    {
        return require_once("$this->plugin_path/templates/admin.php");
    }

    public function admin_cpt()
    {
        return require_once("$this->plugin_path/templates/cpt.php");
    }

    public function admin_taxonomies()
    {
        return require_once("$this->plugin_path/templates/taxonomy.php");
    }

    public function admin_widgets()
    {
        return require_once("$this->plugin_path/templates/widget.php");
    }

    public function admin_gallery()
	{
		echo "<h1>Gallery Manager</h1>";
	}
    
    public function admin_chat()
	{
		echo "<h1>Chat Manager</h1>";
	}

    public function admin_membership()
	{
		echo "<h1>Membership Manager</h1>";
	}

    public function admin_testimonial()
	{
		echo "<h1>Testimonial Manager</h1>";
	}

    // public function leoadd_options_group($input)
    // {
    //     return $input;
    // }

    // public function leoadd_admin_section()
    // {
    //     echo 'Check this beautiful section!';
    // }

    public function leoadd_text_example()
    {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
    }

    public function leoadd_first_name()
    {
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name!">';
    }
}
