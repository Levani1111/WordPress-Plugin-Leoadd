<?php

/**
 * @package Leoadd
 */

namespace Inc\base;


use \Inc\base\basecontroller;
use \Inc\Api\Widgets\mediawidget;

/**
* 
*/
class widgetcontroller extends basecontroller
{


	public function register()
	{
		if ( ! $this->activated( 'media_widget' ) ) return;

		
        $media_widget = new mediawidget();
		$media_widget->register();
        
	}
}