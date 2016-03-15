<?php
/**
 * Defines service taxonomy object
 * @author Danial Bleile
 * @version 0.0.1
 */
 
require_once 'cahnrswp-forester-directory-taxonomy.php';

class CAHNRSWP_Forester_Directory_Service extends CAHNRSWP_Forester_Directory_taxonomy {
	
	// @var string $slug taxonomy slug
	protected $slug = 'service';
	
	// @var array $post_types
	protected $post_types = array('consultant');
	
	// @var string|array $label String for single label or array for all labels
	protected $label = array(
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
	
	// @var array $args Taxonomy Args
	//protected $args = array( 'show_ui' => false,);
	
	// @var array $services Services consultants provide
	protected $values = array(
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
			'site-preparation–chemical'       => 'Site preparation – chemical', 
			'site-preparation–mechanical'     => 'Site preparation – mechanical', 
			'timber-sale'                     => 'Timber sale management/marketing', 
			'trail-construction'              => 'Trail/Boardwalk construction', 
			'vegetation-control–chemical'     => 'Vegetation control/release – chemical', 
			'vegetation-control-mechanical'   => 'Vegetation control/release – mechanical', 
			'wildlife-enhancement'            => 'Wildlife enhancement', 
			'wildlife-damage'                 => 'Wildlife damage control', 
		);
	
	
} // end CAHNRSWP_Forester_Directory_Service