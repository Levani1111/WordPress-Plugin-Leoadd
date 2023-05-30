<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\admincallbacks;

class customposttypecontroller extends basecontroller
{
    // public $settings;
    public $callbacks;

    public $subpages = array();

    public function register()
    {
        // $option = get_option('leoadd_plugin');
        // $activated = isset($option['cpt_manager']) ? $option['cpt_manager'] : false;

        // if (!$activated) {
        //     return;
        // }

        if ( ! $this->activated( 'cpt_manager' ) ) return;

        $this->settings = new settingsapi();

        $this->callbacks = new admincallbacks();

        $this->set_subpages();

        $this->settings->add_sub_pages($this->subpages)->register();

        add_action('init', array($this, 'activate'));
    }

    public function set_subpages()
    {

        $this->subpages = array(
            array(
                'parent_slug' => 'leoadd_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_cpt',
                'callback' => array($this->callbacks, 'admin_cpt'),
            )
        );
    }

    public function activate()
    {
        register_post_type('leoadd_products', array(
            'labels' => array(
                'name' => 'Products',
                'singular_name' => 'Product',
            ),
            'public' => true,
            'has_archive' => true,
        ));
    }
}
