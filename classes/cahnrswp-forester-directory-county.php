<?php
/**
 * Defines service taxonomy object
 * @author Danial Bleile
 * @version 0.0.1
 */
 
require_once 'cahnrswp-forester-directory-taxonomy.php';

class CAHNRSWP_Forester_Directory_County extends CAHNRSWP_Forester_Directory_taxonomy {
	
	// @var string $slug taxonomy slug
	protected $slug = 'county';
	
	// @var array $post_types
	protected $post_types = array('consultant');
	
	// @var string|array $label String for single label or array for all labels
	protected $label = array(
		'name'              => 'Counties',
		'singular_name'     => 'County',
		'search_items'      => 'Search County',
		'all_items'         => 'All Counties',
		'parent_item'       => 'Parent County',
		'parent_item_colon' => 'Parent County:',
		'edit_item'         => 'Edit County',
		'update_item'       => 'Update County',
		'add_new_item'      => 'Add New County',
		'new_item_name'     => 'New County Name',
		'menu_name'         => 'County',
		);
	
	// @var array $args Taxonomy Args
	//protected $args = array( 'show_ui' => false,);
	
	// @var array $services Services consultants provide
	protected $values = array(
		'clallam'      => 'Clallam',
		'clark'        => 'Clark',
		'cowlitz'      => 'Cowlitz',
		'grays Harbor' => 'Grays Harbor',
		'island'       => 'Island',
		'jefferson '   => 'Jefferson ',
		'king'         => 'King',
		'kitsap'       => 'Kitsap',
		'lewis'    	   => 'Lewis',
		'mason'        => 'Mason',
		'pacific'      => 'Pacific',
		'pierce'       => 'Pierce',
		'san Juan'     => 'San Juan',
		'skagit'       => 'Skagit',
		'skamania'     => 'Skamania',
		'snohomish'    => 'Snohomish',
		'thurston'     => 'Thurston',
		'wahkiakum'    => 'Wahkiakum',
		'whatcom'      => 'Whatcom',
		'adams'        => 'Adams',
		'asotin'       => 'Asotin',
		'benton'       => 'Benton',
		'chelan'       => 'Chelan',
		'columbia'     => 'Columbia',
		'douglas'      => 'Douglas',
		'ferry '       => 'Ferry ',
		'franklin'     => 'Franklin',
		'garfield'     => 'Garfield',
		'grant'        => 'Grant',
		'kittitas'     => 'Kittitas',
		'klickitat'    => 'Klickitat',
		'lincoln'      => 'Lincoln',
		'okanogan'     => 'Okanogan',
		'pend oreille' => 'Pend Oreille',
		'spokane'      => 'Spokane',
		'stevens'      => 'Stevens',
		'walla walla'  => 'Walla Walla',
		'whitman'      => 'Whitman',
		'yakima'       => 'Yakima',
	);
	
	
} // end CAHNRSWP_Forester_Directory_Service