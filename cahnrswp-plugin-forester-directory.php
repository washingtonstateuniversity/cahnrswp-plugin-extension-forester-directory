<?php
/*
Plugin Name: CAHNRSWP Forester Directory
Plugin URI: http://cahnrs.wsu.edu/communications
Description: Searchable directory of WA forestery consultants
Author: cahnrscommunications, Danial Bleile
Author URI: http://cahnrs.wsu.edu/communications
Version: 0.0.1
*/
class CAHNRSWP_Forester_Directory {
	
	//@var object $instance instance of CAHNRSWP_Forester_Directory
	public static $instance;
	
	//@var object $consultant instance of CAHNRSWP_Forester_Directory_Consultant
	public $consultant;
	
	/**
	 * Get the current instance or set it an return
	 * @return object current instance of CAHNRSWP_Forester_Directory
	 */
	 public static function get_instance(){
		 
		 if ( null == self::$instance ) {
			 
            self::$instance = new self;
			
			self::$instance->init_plugin();
			
        } // end if
 
        return self::$instance;
		 
	 } // end get_instance
	 
	 /**
	  * Call methods on new instance of CAHNRSWP_Forester_Directory
	  */
	  public function init_plugin(){
		  
		  require_once 'classes/cahnrswp-forester-directory-consultant.php';
		  
		  $this->consultant = new CAHNRSWP_Forester_Directory_Consultant();
		  
		  $this->consultant->init();
		  
	  } // end init_plugin
	
	
}
$cahnrswp_forester = CAHNRSWP_Forester_Directory::get_instance();
