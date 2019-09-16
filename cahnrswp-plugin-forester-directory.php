<?php
/*
Plugin Name: CAHNRSWP Forester Directory
Plugin URI: http://cahnrs.wsu.edu/communications
Description: Searchable directory of WA forestery consultants
Author: cahnrscommunications, Danial Bleile
Author URI: http://cahnrs.wsu.edu/communications
Version: 2.0.0
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Loads the core plugin class.
 *
 * @since 0.1.0
 */
require_once __DIR__ . '/classes/class-cahnrswp-forester-directory.php';

$cahnrswp_forester_directory = new CAHNRSWP\Plugin\Forester_Directory\CAHNRSWP_Forester_Directory();

$cahnrswp_forester_directory->init_plugin();
