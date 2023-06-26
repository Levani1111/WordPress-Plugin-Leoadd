<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\cptcallbacks;
use \Inc\Api\callbacks\admincallbacks;


class customposttypecontroller extends basecontroller
{
    public $settings;

    public $callbacks;

    public $cpt_callbacks;

    public $subpages = array();

    public $custom_post_types = array();

    public function register()
    {

        if ( ! $this->activated( 'cpt_manager' ) ) return;

        $this->settings = new settingsapi();

        $this->callbacks = new admincallbacks();

        $this->cpt_callbacks = new cptcallbacks();

        $this->set_subpages();

        // $this->settings->add_sub_pages($this->subpages)->register();

        $this->set_settings();
        $this->set_sections();
        $this->set_fields();
        $this->settings->add_sub_pages($this->subpages)->register();
        $this->store_custom_post_types();

        if ( ! empty($this->custom_post_types) ) {
            add_action('init', array($this, 'register_custom_post_types'));
        }
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

    public function set_settings()
    {

        $args = array(
            array(
                'option_group' => 'leoadd_plugin_cpt_settings',
                'option_name' => 'leoadd_plugin_cpt',
                'callback' => array($this->cpt_callbacks, 'cpt_sanitize')
            ),
        );

        $this->settings->set_settings($args);
    }

    public function set_sections()
    {
        $args = array(
            array(
                'id' => 'leoadd_cpt_index',
                'title' => 'Custom Post Type Manager',
                'callback' => array($this->cpt_callbacks, 'cpt_section_manager'),
                'page' => 'leoadd_cpt'
            )
        );

        $this->settings->set_sections($args);
    }

    public function set_fields()
    {
        $args = array(
            array(
                'id' => 'post_type',
                'title' => 'Custom Post Type ID',
                'callback' => array($this->cpt_callbacks, 'text_field'),
                'page' => 'leoadd_cpt',
                'section' => 'leoadd_cpt_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_cpt',
                    'label_for' => 'post_type',
                    'placeholder' => 'eg. product',
                    // 'array' => 'post_type'
                )
            ),
            array(
                'id' => 'singular_name',
                'title' => 'Singular Name',
                'callback' => array($this->cpt_callbacks, 'text_field'),
                'page' => 'leoadd_cpt',
                'section' => 'leoadd_cpt_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_cpt',
                    'label_for' => 'singular_name',
                    'placeholder' => 'eg. Product',
                    // 'array' => 'post_type'
                )
            ),
            array(
                'id' => 'plural_name',
                'title' => 'Plural Name',
                'callback' => array($this->cpt_callbacks, 'text_field'),
                'page' => 'leoadd_cpt',
                'section' => 'leoadd_cpt_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_cpt',
                    'label_for' => 'plural_name',
                    'placeholder' => 'eg. Products',
                    // 'array' => 'post_type'
                )
            ),
            array(
                'id' => 'public',
                'title' => 'Public',
                'callback' => array($this->cpt_callbacks, 'checkbox_field'),
                'page' => 'leoadd_cpt',
                'section' => 'leoadd_cpt_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_cpt',
                    'label_for' => 'public',
                    'class' => 'ui-toggle',
                    // 'array' => 'post_type'
                )
            ),
            array(
                'id' => 'has_archive',
                'title' => 'Archive',
                'callback' => array($this->cpt_callbacks, 'checkbox_field'),
                'page' => 'leoadd_cpt',
                'section' => 'leoadd_cpt_index',
                'args' => array(
                    'option_name' => 'leoadd_plugin_cpt',
                    'label_for' => 'has_archive',
                    'class' => 'ui-toggle',
                    // 'array' => 'post_type'
                )
            ),
        );
      

        $this->settings->set_fields($args);
    }

    public function store_custom_post_types()
    {
        $options = get_option('leoadd_plugin_cpt') ?: array();

        foreach ($options as $option) {
            $this->custom_post_types[] = array(
                'post_type'             => $option['post_type'],
                'name'                  => $option['plural_name'],
                'singular_name'         => $option['singular_name'],
                'menu_name'             => $option['plural_name'],
                'name_admin_bar'        => $option['singular_name'],
                'archives'              => $option['singular_name'] . ' Archives',
                'attributes'            => $option['singular_name'] . ' Attributes',
                'parent_item_colon'     => 'Parent ' . $option['singular_name'],
                'all_items'             => 'All ' . $option['plural_name'],
                'add_new_item'          => 'Add New ' . $option['singular_name'],
                'add_new'               => 'Add New',
                'new_item'              => 'New ' . $option['singular_name'],
                'edit_item'             => 'Edit ' . $option['singular_name'],
                'update_item'           => 'Update ' . $option['singular_name'],
                'view_item'             => 'View ' . $option['singular_name'],
                'view_items'            => 'View ' . $option['plural_name'],
                'search_items'          => 'Search ' . $option['plural_name'],
                'not_found'             => 'No ' . $option['singular_name'] . ' Found',
                'not_found_in_trash'    => 'No ' . $option['singular_name'] . ' Found in Trash',
                'featured_image'        => 'Featured Image',
                'set_featured_image'    => 'Set Featured Image',
                'remove_featured_image' => 'Remove Featured Image',
                'use_featured_image'    => 'Use Featured Image',
                'insert_into_item'      => 'Insert into ' . $option['singular_name'],
                'uploaded_to_this_item' => 'Uploaded to this ' . $option['singular_name'],
                'items_list'            => $option['plural_name'] . ' List',
                'items_list_navigation' => $option['plural_name'] . ' Items List Navigation',
                'filter_items_list'     => 'Filter' . $option['plural_name'] . ' List',
                'label'                 => $option['singular_name'],
                'description'           => $option['plural_name'] . 'Custom Post Type',
                'supports'              => array('title', 'editor', 'thumbnail'),
                'taxonomies'            => array('category', 'post_tag'),
                'hierarchical'          => false,
                'public'                => isset($option['public']) ?: false,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => isset($option['has_archive']) ?: false,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post'
            );
        }
    }

    public function register_custom_post_types()
    {

        foreach ($this->custom_post_types as $post_type) {

            register_post_type( $post_type['post_type'],
				array(
					'labels' => array(
						'name'                  => $post_type['name'],
						'singular_name'         => $post_type['singular_name'],
						'menu_name'             => $post_type['menu_name'],
						'name_admin_bar'        => $post_type['name_admin_bar'],
						'archives'              => $post_type['archives'],
						'attributes'            => $post_type['attributes'],
						'parent_item_colon'     => $post_type['parent_item_colon'],
						'all_items'             => $post_type['all_items'],
						'add_new_item'          => $post_type['add_new_item'],
						'add_new'               => $post_type['add_new'],
						'new_item'              => $post_type['new_item'],
						'edit_item'             => $post_type['edit_item'],
						'update_item'           => $post_type['update_item'],
						'view_item'             => $post_type['view_item'],
						'view_items'            => $post_type['view_items'],
						'search_items'          => $post_type['search_items'],
						'not_found'             => $post_type['not_found'],
						'not_found_in_trash'    => $post_type['not_found_in_trash'],
						'featured_image'        => $post_type['featured_image'],
						'set_featured_image'    => $post_type['set_featured_image'],
						'remove_featured_image' => $post_type['remove_featured_image'],
						'use_featured_image'    => $post_type['use_featured_image'],
						'insert_into_item'      => $post_type['insert_into_item'],
						'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
						'items_list'            => $post_type['items_list'],
						'items_list_navigation' => $post_type['items_list_navigation'],
						'filter_items_list'     => $post_type['filter_items_list']
					),
					'label'                     => $post_type['label'],
					'description'               => $post_type['description'],
					'supports'                  => $post_type['supports'],
					'taxonomies'                => $post_type['taxonomies'],
					'hierarchical'              => $post_type['hierarchical'],
					'public'                    => $post_type['public'],
					'show_ui'                   => $post_type['show_ui'],
					'show_in_menu'              => $post_type['show_in_menu'],
					'menu_position'             => $post_type['menu_position'],
					'show_in_admin_bar'         => $post_type['show_in_admin_bar'],
					'show_in_nav_menus'         => $post_type['show_in_nav_menus'],
					'can_export'                => $post_type['can_export'],
					'has_archive'               => $post_type['has_archive'],
					'exclude_from_search'       => $post_type['exclude_from_search'],
					'publicly_queryable'        => $post_type['publicly_queryable'],
					'capability_type'           => $post_type['capability_type']
				)
			);
        }
    }
}
