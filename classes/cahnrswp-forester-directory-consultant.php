<?php
/**
 * Consultant object
 * @author Danial Bleile
 * @version 0.0.1
 */

require_once 'cahnrswp-forester-directory-post-type.php';
 
class CAHNRSWP_Forester_Directory_Consultant extends CAHNRSWP_Forester_Directory_Post_Type  {
	
	// @var string $slug Post type slug
	protected $slug = 'consultant';
	
	// @var string|array $label String for single label or array for all labels
	protected $label = array(
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
	
	// @var array $post_type_args Args for registering a post type
	protected $post_type_args = array();
	
	// @var array $fields Meta data for the post type
	protected $fields = array(
		'_address'               => array('text',''),
		'_phone'                 => array('text',''),
		'_state'                 => array('text',''),
		'_fax'                   => array('text',''),
		'_city'                  => array('text',''),
		'_email'                 => array('text',''),
		'_zip'                   => array('text',''),
		'_website'               => array('text',''),
		'_service_forestry'      => array('text',''),
		'_service_silvicultural' => array('text',''),
		'_other_services'        => array('text',''),
		'_education'             => array('text',''),
		'_liablility_insurance'  => array('text',''),
		'_surety_bond'           => array('text',''),
		'_pesticide_applicators' => array('text',''),
		'_macf'                  => array('text',''),
		'_saf'                   => array('text',''),
		'_sfl'                   => array('text',''),
		'_flc'                   => array('text',''),
		);
	
	// @var bool $do_save Add save action
	protected $do_save = true;
	
	// @var bool $taxonomies Taxomomies hard coded in to form
	protected $hard_taxonomies = array( 'service' , 'county' );
	
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
			'site-preparation–chemical'       => 'Site preparation – chemical', 
			'site-preparation–mechanical'     => 'Site preparation – mechanical', 
			'timber-sale'                     => 'Timber sale management/marketing', 
			'trail-construction'              => 'Trail/Boardwalk construction', 
			'vegetation-control–chemical'     => 'Vegetation control/release – chemical', 
			'vegetation-control-mechanical'   => 'Vegetation control/release – mechanical', 
			'wildlife-enhancement'            => 'Wildlife enhancement', 
			'wildlife-damage'                 => 'Wildlife damage control', 
		);
	
	protected $counties_served = array(
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
		
	/**
	 * Get method for services
	 * @return array
	 */
	public function get_services(){ return $this->services; }
	
	/**
	 * Get method for counties serviced
	 * @return array
	 */
	public function get_counties_served(){ return $this->counties_served; }
	
	/**
	 * Add edit form after title
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html for the edit page
	 */
	protected function edit_form( $post , $settings ){
		
		$html = $this->get_contact_form( $post , $settings );
		
		$html .= $this->get_service_type_form( $post , $settings );
		
		$html .= '<h3 class="consultant-section-title">Business Description and Remarks:</h3>';
		
		return $html;
		
	} // end edit_form
	
	/**
	 * Get HTML for contact section
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html
	 */
	private function get_contact_form( $post , $settings ){
		
		$html = '<fieldset id="consultant-contact">';
			
			$html .= '<h3 class="consultant-section-title">Contact Information</h3>';
		
			$html .= '<div class="consultant-field"><input type="text" name="_address" value="' . $settings['_address'] . '" placeholder="Address Line 1"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_phone" value="' . $settings['_phone'] . '" placeholder="Phone #"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_state" value="' . $settings['_state'] . '" placeholder="State"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_fax" value="' . $settings['_fax'] . '" placeholder="Fax #"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_city" value="' . $settings['_city'] . '" placeholder="City"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_email" value="' . $settings['_email'] . '" placeholder="Email"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_zip" value="' . $settings['_zip'] . '" placeholder="Zip Code"/></div>';
			
			$html .= '<div class="consultant-field"><input type="text" name="_website" value="' . $settings['_website'] . '" placeholder="Website"/></div>';
		
		$html .= '</fieldset>';
		
		return $html;
		
	} // end get_contact_form
	
	/**
	 * Get HTML for service type section
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html
	 */
	private function get_service_type_form( $post , $settings ){
		
		$html = '<fieldset id="consultant-service-type">';
			
			$html .= '<h3 class="consultant-section-title">Service Type</h3>';
		
			$html .= '<div class="consultant-field"><input id="service_forestry" type="checkbox" name="_service_forestry" value="1" ' . checked( 1 , $settings['_service_forestry'] , false  ) . '/>';
			
			$html .= '<label for="service_forestry">Forestry Consultant</label></div>';
			
			$html .= '<div class="consultant-field"><input id="service_silvicultural" type="checkbox" name="_service_silvicultural" value="1" ' . checked( 1 , $settings['_service_silvicultural'] , false  ) . '/>';
			
			$html .= '<label for="service_silvicultural">Silvicultural Contractor</label></div>';
		
		$html .= '</fieldset>';
		
		return $html;
		
	} // end get_service_type_form
	
	
	/**
	 * Add edit form after editor
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html for the edit page
	 */
	protected function edit_form_after_editor( $post , $settings ){
		
		$html = $this->get_service_provided_form( $post , $settings );
		
		$html .= $this->get_service_location_form( $post , $settings );
		
		$html .= $this->get_optional_form( $post , $settings );
		
		return $html;
		
	} // end edit_form
	
	/**
	 * Get HTML for service provided section
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html
	 */
	private function get_service_provided_form( $post , $settings ){
		
		$services = $this->get_services();
		
		$html = '<fieldset id="consultant-service-type">';
			
			$html .= '<h3 class="consultant-section-title">Services Provided</h3>';
			
			foreach( $services as $service_key => $service ){
				
				$html .= '<div class="consultant-field checkbox">';
				
					$html .= '<input id="service-type-' . $service_key . '" type="checkbox" name="_taxonomy[service][' . $service_key . ']" value="1"/>';
					
					$html .= '<label for="service-type-' . $service_key . '">' . $service . '</label>';
				
				$html .= '</div>';
				
			} // end foreach
			
			$html .= '<div class="consultant-field textarea">';
			
				$html .= '<label>Other Services Provided</label>';
				
				$html .= '<textarea name="_other_services"> ' . $settings['_other_services'] . '</textarea>';
			
			$html .= '</div>';
		
		$html .= '</fieldset>';
		
		return $html;
		
	} // end get_service_provided_form
	
	/**
	 * Get HTML for service location section
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html
	 */
	private function get_service_location_form( $post , $settings ){
		
		$counties = $this->get_counties_served();
		
		$html = '<fieldset id="consultant-service-location">';
			
			$html .= '<h3 class="consultant-section-title">Counties Served</h3>';
			
			foreach( $counties as $county_key => $county ){
				
				$html .= '<div class="consultant-field checkbox">';
				
					$html .= '<input id="service-type-' . $county_key . '" type="checkbox" name="_taxonomy[county][' . $county_key . ']" value="1"/>';
					
					$html .= '<label for="service-type-' . $county_key . '">' . $county . '</label>';
				
				$html .= '</div>';
				
			} // end foreach
		
		$html .= '</fieldset>';
		
		return $html;
		
	} // end get_service_location_form
	
	/**
	 * Get HTML for optional section
	 * @param object $post WP Post object
	 * @param array $settings Key => values for defined fields
	 * @return html
	 */
	private function get_optional_form( $post , $settings ){
		
		$html = '<fieldset id="consultant-service-optional">';
			
			$html .= '<h3 class="consultant-section-title">Optional Information</h3>';
			
			$html .= '<div class="consultant-field full-field"><label>Experience/Education of Key Personnel</label>';
			
			$html .= '<input type="text" name="_education" value="' . $settings['_education'] . '" placeholder="Experience/Education of Key Personnel"/></div>';
			
			$html .= '<div class="consultant-field"><label>Liability Insurance</label>';
			
			$html .= '<input type="text" name="_liablility_insurance" value="' . $settings['_liablility_insurance'] . '" placeholder="Liability Insurance"/></div>';
			
			$html .= '<div class="consultant-field"><label>Surety Bond</label>';
			
			$html .= '<input type="text" name="_surety_bond" value="' . $settings['_surety_bond'] . '" placeholder="Surety Bond"/></div>';
			
			$html .= '<div class="consultant-field"><label>Licensed Pesticide Applicators</label>';
			
			$html .= '<input type="text" name="_pesticide_applicators" value="' . $settings['_pesticide_applicators'] . '" placeholder="Licensed Pesticide Applicators"/></div>';
			
		$html .= '</fieldset>';
		
		$html .= '<fieldset id="consultant-service-optional-consulting">';
			
			$html .= '<h3 class="consultant-section-title">For Consulting Foresters</h3>';
			
			$html .= '<div class="consultant-field radio" >';
			
				$html .= '<label>Member of Association of Consulting Foresters</label>';
			
				$html .= '<div><input id="macf-yes" type="radio" name="_macf" value="1" ' . checked( 1 , $settings['_macf'] , false  ) . '/><label for="macf-yes">Yes</label></div>';
				
				$html .= '<div><input id="macf-no" type="radio" name="_macf" value="0" ' . checked( 0 , $settings['_macf'] , false  ) . '/><label for="macf-no">No</label></div>';
			
			$html .= '</div>';
			
			$html .= '<div class="consultant-field radio" >';
			
				$html .= '<label>SAF Certified Foresters on Staff</label>';
			
				$html .= '<div><input id="saf-yes" type="radio" name="_saf" value="1" ' . checked( 1 , $settings['_saf'] , false  ) . '/><label for="saf-yes">Yes</label></div>';
				
				$html .= '<div><input id="saf-no" type="radio" name="_saf" value="0" ' . checked( 0 , $settings['_saf'] , false ) . '/><label for="saf-no">No</label></div>';
			
			$html .= '</div>';
			
		$html .= '</fieldset>';
		
		$html .= '<fieldset id="consultant-service-optional-contractors">';
			
			$html .= '<h3 class="consultant-section-title">For Consulting Foresters</h3>';
			
			$html .= '<div class="consultant-field radio" >';
			
				$html .= '<label>Registered Washington State Farm Labor Contractor</label>';
			
				$html .= '<div><input id="sfl-yes" type="radio" name="_sfl" value="1" ' . checked( 1 , $settings['_sfl'] , false  ) . '/><label for="sfl-yes">Yes</label></div>';
				
				$html .= '<div><input id="sfl-no" type="radio" name="_sfl" value="0" ' . checked( 0 , $settings['_sfl'] , false  ) . '/><label for="sfl-no">No</label></div>';
			
			$html .= '</div>';
			
			$html .= '<div class="consultant-field"><label>FLC license number</label>';
			
			$html .= '<input type="text" name="_flc" value="' . $settings['_flc'] . '" placeholder="FLC license number"/></div>';
			
		$html .= '</fieldset>';
		
		return $html;
		
	} // end get_service_location_form
	
	
	
	
	
}
