<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Post_Type_Consultant extends Post_Type {

	protected $taxonomy_service;
	protected $taxonomy_county;
	protected $factory_service_provider;

	// @var string $slug Post type slug
	protected $slug = 'consultant';


	public function __construct( $factory_service_provider, $taxonomy_service, $taxonomy_county ) {

		$this->taxonomy_service         = $taxonomy_service;
		$this->taxonomy_county          = $taxonomy_county;
		$this->factory_service_provider = $factory_service_provider;

	}


	public function init() {

		// Call add_hooks method in parent class
		$this->add_hooks();

		add_action( 'add_meta_boxes', array( $this->add_metaboxes ) );

	}


	public function get_slug() {
		return $this->slug;
	}


	public function register_post_type() {

		$label = array(
			'name'               => 'Consultant',
			'singular_name'      => 'Consultant',
			'menu_name'          => 'Consultants',
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
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
		);

		\register_post_type( $this->get_slug(), $post_type_args );

	} // End register_post_type


	public function add_metaboxes() {

		add_meta_box( 
			'consultant_contact_info',
			'Contact Information',
			array( $this, 'the_contact_metabox' ),
			'post'
		);

	}


	public function the_contact_metabox( $post ) {

		$service_provider = $this->factory_service_provider->get_provider( 'consultant', $post->ID );

		$contact_address = $service_provider->get_address();
		$contact_phone   = $service_provider->get_phone();
		$contact_state   = $service_provider->get_state();
		$contact_fax     = $service_provider->get_fax();
		$contact_city    = $service_provider->get_city();
		$contact_email   = $service_provider->get_email();
		$contact_zip     = $service_provider->get_zip();
		$contact_website = $service_provider->get_website();
	}


}