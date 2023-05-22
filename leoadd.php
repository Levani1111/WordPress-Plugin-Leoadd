<?php

/**
 * Plugin Name: Leoadd
 * Plugin URI:
 * Description: Leoadd
 * Version: 1.0.0
 * Author: Levani Papashvili
 * Author URI:
 * License: GPLv2 or later
 * Text Domain: leoadd
 *
 * @package Leoadd
 */



/**
 * If this file is called directly, abort!!!
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Require the Composer autoloader if it's available.
 */

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


/**
 * The code that runs during plugin activation
 */

function activate_leoadd()
{
    Inc\base\activate::activate();
}
register_activation_hook(__FILE__, 'activate_leoadd');

/**
 * The code that runs during plugin deactivation
 */

function deactivate_leoadd()
{
    Inc\base\deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_leoadd');

/**
 * Initialize all the core classes of the plugin
 */

if (class_exists('Inc\\init')) {
    Inc\init::register_services();
}
