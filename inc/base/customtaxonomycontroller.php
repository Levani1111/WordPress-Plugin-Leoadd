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

        $this->store_custom_taxonomies();

        if (!empty($this->taxonomies)) {
            add_action('init', array($this, 'register_custom_taxonomies'));
        }
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
            ),
            array(
                'id' => 'objects',
                'title' => 'Post Types',
                'callback' => array($this->tax_callbacks, 'checkbox_post_types_field'),
                'page' => 'leoadd_taxonomy',
                'section' => 'leoadd_tax_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_tax',
                    'label_for' => 'objects',
                    'class' => 'ui-toggle',
                    'array' => 'taxonomy'
                )
            )
        );

        $this->settings->set_fields($args);
    }

    public function store_custom_taxonomies()
    {
        $options = get_option('leoadd_plugin_tax') ?: array();

        foreach ($options as $option) {
            $labels = array(
                'name'              => $option['singular_name'],
                'singular_name'     => $option['singular_name'],
                'search_items'      => 'Search ' . $option['singular_name'],
                'all_items'         => 'All ' . $option['singular_name'],
                'parent_item'       => 'Parent ' . $option['singular_name'],
                'parent_item_colon' => 'Parent ' . $option['singular_name'] . ':',
                'edit_item'         => 'Edit ' . $option['singular_name'],
                'update_item'       => 'Update ' . $option['singular_name'],
                'add_new_item'      => 'Add New ' . $option['singular_name'],
                'new_item_name'     => 'New ' . $option['singular_name'] . ' Name',
                'menu_name'         => $option['singular_name'],
            );

            $this->taxonomies[] = array(
                'hierarchical'      => isset($option['hierarchical']) ? true : false,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'show_in_rest'      => true,
                'rewrite'           => array('slug' => $option['taxonomy']),
                'objects'           => isset($option['objects']) ? $option['objects'] : null,

            );
        }
    }

    public function register_custom_taxonomies()
    {
        foreach ($this->taxonomies as $taxonomy) {
            $objects = isset($taxonomy['objects']) ? array_keys($taxonomy['objects']) : null;
			register_taxonomy( $taxonomy['rewrite']['slug'], $objects, $taxonomy );
        }
    }
}
