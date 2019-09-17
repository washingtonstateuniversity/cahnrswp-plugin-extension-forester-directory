<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Taxonomy {

	// @var string $slug taxonomy slug
	protected $slug = '';

	// @var array $post_types
	protected $post_types = array();


	public function init() {

		add_action( 'init' , array( $this, 'register' ) );

	}


	public function get_slug() {
		return $this->slug;
	}

	public function get_post_types() {
		return $this->post_types;
	}

}