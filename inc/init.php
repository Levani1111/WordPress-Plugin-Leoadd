<?php

/**
 * @package Leoadd
 */

namespace Inc;


final class init
{

    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    public static function get_services()
    {
        return [
            pages\dashboard::class,
            base\enqueue::class,
            base\settingslinks::class,
            base\customposttypecontroller::class,
            base\customtaxonomycontroller::class,
            base\widgetcontroller::class,
            base\gallerycontroller::class,
            base\membershipcontroller::class,
            base\testimonialcontroller::class,
            base\templatecontroller::class,
            base\chatcontroller::class,
            base\authcontroller::class,
         
        ];
    }

    /**
     * Loop through the classes, initialize them, and call the register() method if it exists
     * @return
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * @param class $class class from the services array
     * @return class instance new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}
