<?php

/**
 * @package Leoadd
 */

namespace Inc\pages;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\admincallbacks;
use \Inc\Api\callbacks\managercallbacks;

class dashboard extends basecontroller
{
    public $settings;
    public $callbacks;
    public $callbacks_manager;
    public $pages = array();
    // public $subpages = array();


    public function register()
    {
        $this->settings = new settingsapi();
        $this->callbacks = new admincallbacks();
        $this->callbacks_manager = new managercallbacks();
        $this->set_pages();
        // $this->set_subpages();
        $this->set_settings();
        $this->set_sections();
        $this->set_fields();
        $this->settings->add_pages($this->pages)->with_sub_page('Dashboard')->register();
    }

    public function set_pages()
    {
        $this->pages = array(
            array(
                'page_title' => 'Leoadd Plugin',
                'menu_title' => 'Leoadd',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_plugin',
                'callback' => array($this->callbacks, 'admin_dashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            ),
        );
    }

    // public function set_subpages()
    // {

    //     $this->subpages = array(
    //         array(
    //             'parent_slug' => 'leoadd_plugin',
    //             'page_title' => 'Custom Post Types',
    //             'menu_title' => 'CPT',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'leoadd_cpt',
    //             'callback' => array($this->callbacks, 'admin_cpt'),
    //         ),
    //         array(
    //             'parent_slug' => 'leoadd_plugin',
    //             'page_title' => 'Custom Taxonomies',
    //             'menu_title' => 'Taxonomies',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'leoadd_taxonomies',
    //             'callback' => array($this->callbacks, 'admin_taxonomies'),
    //         ),
    //         array(
    //             'parent_slug' => 'leoadd_plugin',
    //             'page_title' => 'Custom Widgets',
    //             'menu_title' => 'Widgets',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'leoadd_widgets',
    //             'callback' => array($this->callbacks, 'admin_widgets'),
    //         ),
    //     );
    // }

    public function set_settings()
    {

        $args = array(
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'leoadd_plugin',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            )
        );

        $this->settings->set_settings($args);
    }

    public function set_sections()
    {
        $args = array(
            array(
                'id' => 'leoadd_admin_index',
                'title' => 'Settings Manager',
                'callback' => array($this->callbacks_manager, 'admin_section_manager'),
                'page' => 'leoadd_plugin'
            )
        );

        $this->settings->set_sections($args);
    }

    public function set_fields()
    {
        $args = array();
        foreach ($this->managers as $key => $value) {
            $args[] = array(
                'id' => $key,
                'title' => $value,
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin',
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                )
            );
        }

        $this->settings->set_fields($args);
    }
}
