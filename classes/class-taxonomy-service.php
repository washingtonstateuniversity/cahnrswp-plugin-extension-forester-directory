<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Taxonomy_Service extends Taxonomy {

	// @var string $slug taxonomy slug
	protected $slug = 'new_service';
	
	// @var array $post_types
	protected $post_types = array( 'new_consultant' );

	// @var array $services Services consultants provide
	protected $services = array(
		'slash-disposal'                  => 'Brush/slash disposal',
		'gis'                             => 'GIS mapping services',
		'forest-management-advice'        => 'Forest management advice',
		'forest-management-plan-writing'  => 'Forest management plan writing',
		'inventory'                       => 'Forest inventory/appraisal/timber cruising',
		'practices-permitting'            => 'Forest practices permitting',
		'security-consulting'             => 'Forestland security consulting',
		'invasive-species-control'        => 'Invasive species identification and control',
		'non-timber-products'             => 'Non-timber forest products',
		'pre-commercial-thinning'         => 'Pre-commercial thinning',
		'prescribed-burning'              => 'Prescribed burning',
		'property-surveying'              => 'Property surveying',
		'reforestation'                   => 'Reforestation/tree planting',
		'riparian-management-alternative' => 'Riparian management/alternative plan applications',
		'road-maintenance'                => 'Road maintenance/engineering',
		'site-preparation-chemical'       => 'Site preparation – chemical',
		'site-preparation-mechanical'     => 'Site preparation – mechanical',
		'timber-sale'                     => 'Timber sale management/marketing',
		'trail-construction'              => 'Trail/Boardwalk construction',
		'vegetation-control-chemical'     => 'Vegetation control/release – chemical',
		'vegetation-control-mechanical'   => 'Vegetation control/release – mechanical',
		'wildlife-enhancement'            => 'Wildlife enhancement',
		'wildlife-damage'                 => 'Wildlife damage control',
	);


	public function get_services() {
		return $this->services;
	}


	public function register() {

		$labels = array(
			'name'              => 'Services',
			'singular_name'     => 'Service',
			'search_items'      => 'Search Services',
			'all_items'         => 'All Services',
			'parent_item'       => 'Parent Service',
			'parent_item_colon' => 'Parent Service:',
			'edit_item'         => 'Edit Service',
			'update_item'       => 'Update Service',
			'add_new_item'      => 'Add New Service',
			'new_item_name'     => 'New Service Name',
			'menu_name'         => 'Service',
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( $this->get_slug(), $this->get_post_types(), $args );
	}

}