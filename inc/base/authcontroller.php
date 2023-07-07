<?php

/**
 * @package Leoadd
 */

namespace Inc\base;


use \Inc\base\basecontroller;


class authcontroller extends basecontroller
{


	public function register()
	{
		if ( ! $this->activated( 'login_manager' ) ) return;

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_head', array( $this, 'add_auth_template' ) );

	}

    public function enqueue()
	{

        if ( is_user_logged_in() ) return;
        
		wp_enqueue_style( 'authstyle', $this->plugin_url . 'assets/auth.css' );
		wp_enqueue_script( 'authscript', $this->plugin_url . 'assets/auth.js' );
	}

    public function add_auth_template()
	{
		if ( is_user_logged_in() ) return;

		$file = $this->plugin_path . 'templates/auth.php';

		if ( file_exists( $file ) ) {
			load_template( $file, true );
		}
	}
}