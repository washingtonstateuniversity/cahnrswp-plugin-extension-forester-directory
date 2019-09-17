<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Post_Type_Consultant extends Post_Type {

	protected $factory_service_provider;

	// @var string $slug Post type slug
	protected $slug = 'new_consultant';


	public function __construct( $factory_service_provider ) {

		$this->factory_service_provider = $factory_service_provider;

	}


	public function init() {

		// Call add_hooks method in parent class
		$this->add_hooks();

		add_action( 'add_meta_boxes', array( $this, 'add_metaboxes' ) );

	}


	public function get_slug() {
		return $this->slug;
	}


	public function register_post_type() {

		$labels = array(
			'name'               => 'Consultant',
			'singular_name'      => 'Consultant',
			'menu_name'          => 'Consultants (new)',
			'name_admin_bar'     => 'Consultant',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Consultant',
			'new_item'           => 'New Consultant',
			'edit_item'          => 'Edit Consultant',
			'view_item'          => 'View Consultant',
			'all_items'          => 'All Consultants',
			'search_items'       => 'Search Consultants',
			'parent_item_colon'  => 'Parent Consultants:',
			'not_found'          => 'No consultants found.',
			'not_found_in_trash' => 'No consultants found in Trash.',
		);

		$post_type_args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'thumbnail' ),
		);

		\register_post_type( $this->get_slug(), $post_type_args );

	} // End register_post_type


	public function add_metaboxes() {

		$service_provider = $this->factory_service_provider->get_provider( 'forestry', true );

		$service_provider->add_metaboxes( $this->get_slug() );

	}

}
