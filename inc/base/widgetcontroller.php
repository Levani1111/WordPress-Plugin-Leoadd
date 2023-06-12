<?php

/**
 * @package Leoadd
 */

namespace Inc\base;

use \Inc\Api\settingsapi;
use \Inc\base\basecontroller;
use \Inc\Api\callbacks\admincallbacks;

/**
* 
*/
class widgetcontroller extends basecontroller
{

    public $settings;
    public $callbacks;

    public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'media_widget' ) ) return;

		$this->settings = new settingsapi();

        $this->callbacks = new admincallbacks();

        $this->set_subpages();

        $this->settings->add_sub_pages($this->subpages)->register();

	}

	public function set_subpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'leoadd_plugin',
                'page_title' => 'Widgets Manager', 
				'menu_title' => 'Widgets Manager', 
				'capability' => 'manage_options', 
                'menu_slug' => 'leoadd_widget',
                'callback' => array($this->callbacks, 'admin_widgets'),
            )
        );
    }
}