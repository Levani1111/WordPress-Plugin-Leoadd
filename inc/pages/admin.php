<?php

/**
 * @package Leoadd
 */

namespace Inc\pages;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\admincallbacks;
use \Inc\Api\callbacks\managercallbacks;

class admin extends basecontroller
{
    public $settings;
    public $callbacks;
    public $callbacks_manager;
    public $pages = array();
    public $subpages = array();


    public function register()
    {
        $this->settings = new settingsapi();
        $this->callbacks = new admincallbacks();
        $this->callbacks_manager = new managercallbacks();
        $this->set_pages();
        $this->set_subpages();
        $this->set_settings();
        $this->set_sections();
        $this->set_fields();
        $this->settings->add_pages($this->pages)->with_sub_page('Dashboard')->add_sub_pages($this->subpages)->register();
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

    public function set_subpages()
    {

        $this->subpages = array(
            array(
                'parent_slug' => 'leoadd_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_cpt',
                'callback' => array($this->callbacks, 'admin_cpt'),
            ),
            array(
                'parent_slug' => 'leoadd_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_taxonomies',
                'callback' => array($this->callbacks, 'admin_taxonomies'),
            ),
            array(
                'parent_slug' => 'leoadd_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_widgets',
                'callback' => array($this->callbacks, 'admin_widgets'),
            ),
        );
    }

    public function set_settings()
    {
        $args = array(
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'cpt_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'taxonomy_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'media_widget',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'gallery_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'testimonial_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'templates_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'login_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'membership_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'leoadd_plugin_settings',
                'option_name' => 'chat_manager',
                'callback' => array($this->callbacks, 'checkbox_sanitize')
            ),
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
        $args = array(
            array(
                'id' => 'cpt_manager',
                'title' => 'Activate CPT Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'cpt_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'taxonomy_manager',
                'title' => 'Activate Taxonomy Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'taxonomy_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'media_widget',
                'title' => 'Activate Media Widget',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'media_widget',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'gallery_manager',
                'title' => 'Activate Gallery Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'gallery_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'testimonial_manager',
                'title' => 'Activate Testimonial Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'testimonial_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'templates_manager',
                'title' => 'Activate Templates Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'templates_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'login_manager',
                'title' => 'Activate Ajax Login/Signup',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'login_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'membership_manager',
                'title' => 'Activate Membership Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'membership_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'chat_manager',
                'title' => 'Activate Chat Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'chat_manager',
                    'class' => 'ui-toggle'
                )
            ),
        );

        $this->settings->set_fields($args);
    }
}
