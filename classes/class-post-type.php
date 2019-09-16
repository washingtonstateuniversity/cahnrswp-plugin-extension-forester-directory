<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Post_Type {


	protected function add_hooks() {

		add_action( 'init', array( $this, 'register_post_type' ) );

	}


}