<?php

/**
 * @package Leoadd
 */

namespace Inc\pages;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\admincallbacks;

class admin extends basecontroller
{
    public $settings;
    public $callbacks;
    public $pages = array();
    public $subpages = array();


    public function register()
    {
        $this->settings = new settingsapi();
        $this->callbacks = new admincallbacks();
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
                'option_group' => 'leoadd_option_group_id',
                'option_name' => 'text_example',
                'callback' => array($this->callbacks, 'leoadd_option_group')
            ),
            array(
                'option_group' => 'leoadd_option_group_id',
                'option_name' => 'first_name'
            )
        );

        $this->settings->set_settings($args);
    }

    public function set_sections()
    {
        $args = array(
            array(
                'id' => 'leoadd_admin_index',
                'title' => 'Settings',
                'callback' => array($this->callbacks, 'leoadd_admin_section'),
                'page' => 'leoadd_plugin'
            )
        );

        $this->settings->set_sections($args);
    }

    public function set_fields()
    {
        $args = array(
            array(
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => array($this->callbacks, 'leoadd_text_example'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                )
            ),
            array(
                'id' => 'first_name',
                'title' => 'First Name',
                'callback' => array($this->callbacks, 'leoadd_first_name'),
                'page' => 'leoadd_plugin',
                'section' => 'leoadd_admin_index',
                'args' => array(
                    'label_for' => 'first_name',
                    'class' => 'example-class'
                )
            )
        );

        $this->settings->set_fields($args);
    }
}
