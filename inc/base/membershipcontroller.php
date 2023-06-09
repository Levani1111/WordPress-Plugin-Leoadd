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
class membershipcontroller extends basecontroller
{

    public $settings;
    public $callbacks;

    public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'membership_manager' ) ) return;

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
                'page_title' => 'Membership Manager',
                'menu_title' => 'Membership Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'leoadd_membership',
                'callback' => array($this->callbacks, 'admin_membership'),
            )
        );
    }
}