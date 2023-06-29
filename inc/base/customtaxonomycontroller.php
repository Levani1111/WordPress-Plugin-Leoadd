<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\admincallbacks;
use \Inc\Api\callbacks\taxonomycallbacks;

/**
 * 
 */
class customtaxonomycontroller extends basecontroller
{

    public $settings;
    public $callbacks;
    public $tax_callbacks;

    public $subpages = array();
    public $taxonomies = array();

    public function register()
    {
        if (!$this->activated('taxonomy_manager')) return;

        $this->settings = new settingsapi();

        $this->callbacks = new admincallbacks();

        $this->tax_callbacks = new taxonomycallbacks();

        $this->set_subpages();

        $this->set_settings();

        $this->set_sections();

        $this->set_fields();

        $this->settings->add_sub_pages($this->subpages)->register();
    }

    public function set_subpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'leoadd_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomy Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_taxonomy',
                'callback' => array($this->callbacks, 'admin_taxonomies'),
            )
        );
    }

    public function set_settings()
    {
        $args = array(
            array(
                'option_group' => 'leoadd_plugin_tax_settings',
                'option_name' => 'leoadd_plugin_tax',
                'callback' => array($this->tax_callbacks, 'tax_Sanitize')
            )
        );

        $this->settings->set_settings($args);
    }

    public function set_sections()
    {
        $args = array(
            array(
                'id' => 'leoadd_tax_index',
                'title' => 'Custom Taxonomy Manager',
                'callback' => array($this->tax_callbacks, 'tax_section_manager'),
                'page' => 'leoadd_taxonomy'
            )
        );

        $this->settings->set_sections($args);
    }

    public function set_fields()
    {
        $args = array(
            array(
                'id' => 'taxonomy',
                'title' => 'Custom Taxonomy ID',
                'callback' => array($this->tax_callbacks, 'tax_field'),
                'page' => 'leoadd_taxonomy',
                'section' => 'leoadd_tax_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_tax',
                    'label_for' => 'taxonomy',
                    'placeholder' => 'eg. genre',
                    'array' => 'taxonomy'
                )
            ),
            array(
                'id' => 'singular_name',
                'title' => 'Singular Name',
                'callback' => array($this->tax_callbacks, 'tax_field'),
                'page' => 'leoadd_taxonomy',
                'section' => 'leoadd_tax_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_tax',
                    'label_for' => 'singular_name',
                    'placeholder' => 'eg. Genre',
                    'array' => 'taxonomy'
                )
            ),
            array(
                'id' => 'hierarchical',
                'title' => 'Hierarchical',
                'callback' => array($this->tax_callbacks, 'checkbox_field'),
                'page' => 'leoadd_taxonomy',
                'section' => 'leoadd_tax_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_tax',
                    'label_for' => 'hierarchical',
                    'class' => 'ui-toggle',
                    'array' => 'taxonomy'
                )
            )
        );

        $this->settings->set_fields($args);
    }
}
