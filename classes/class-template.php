<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Template {


	public static function get_template_path( $path = '' ) {

		$base_path = dirname( dirname( __FILE__ ) ) . '/templates/';

		return $base_path . $path;

	}


}