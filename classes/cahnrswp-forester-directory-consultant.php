<?php
/**
 * Consultant object
 * @author Danial Bleile
 * @version 0.0.1
 */

require_once 'cahnrswp-forester-directory-post-type.php';
 
class CAHNRSWP_Forester_Directory_Consultant extends CAHNRSWP_Forester_Directory_Post_Type  {
	
	// @var object $services instance of services taxonomy object
	protected $services;
	
	// @var object $counties Instance of county taxonomy
	protected $counties;
	
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
		'_tsp'                   => array('text',''),
		'_tsp_number'            => array('text',''),
		'_cwms'                  => array('text',''),
		);
	
	// @var bool $do_save Add save action
	protected $do_save = true;
	
	// @var bool $taxonomies Taxomomies hard coded in to form
	protected $hard_taxonomies = array( 'service' , 'county' );
	
	// @var array $c_settings
	protected $c_settings;
	
	// @var array $c_settings
	protected $c_services;
	
	// @var array $c_locations
	protected $c_locations;
	
	/**
	 * Set up object
	 * @param object $services instance of services taxonomy object
	 */
	public function __construct( $services , $counties ){
		
		$this->services = $services;
		
		$this->counties = $counties;
		
	} // end __construct
		
	/**
	 * Get method for services
	 * @return object
	 */
	public function get_services(){ return $this->services; }
	
	/**
	 * Get method for counties
	 * @return object
	 */
	public function get_counties(){ return $this->counties; }
	
	/**
	 * Get method for counties serviced
	 * @return array
	 */
	public function get_counties_served(){ return $this->counties_served; }
	
	/**
	 * Get method for c_settings
	 * @return array
	 */
	public function get_c_settings(){ return $this->c_settings; }
	
	/**
	 * Get method for c_services
	 * @return array
	 */
	public function get_c_services(){ return $this->c_services; }
	
	/**
	 * Get method for c_locations
	 * @return array
	 */
	public function get_c_locations(){ return $this->c_locations; }
	
	/**
	 * Set up the consultant
	 * @param object $post WP Post Object
	 */
	public function the_consultant( $post ){
		
		$this->c_settings = $this->get_settings( $post->ID );
		
		$this->c_services = $this->services->get_terms( $post->ID );
		
		$this->c_locations = $this->counties->get_terms( $post->ID );
		
	} // end the_consultant
	
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
		
		$terms = $services->get_terms( $post->ID , true );
		
		$html = '<fieldset id="consultant-service-type">';
			
			$html .= '<h3 class="consultant-section-title">Services Provided</h3>';
			
			$serv = $services->get_values();
			
			asort( $serv );
			
			foreach( $serv as $service_key => $service ){
				
				$html .= '<div class="consultant-field checkbox">';
				
					$checked = ( in_array( $service_key , $terms ) ) ? ' checked="checked"':'';
				
					$html .= '<input id="service-type-' . $service_key . '" type="checkbox" name="_taxonomy[service][]" value="' . $service_key . '"' . $checked . '/>';
					
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
		
		$counties = $this->get_counties();
		
		$terms = $counties->get_terms( $post->ID , true );
		
		$html = '<fieldset id="consultant-service-location">';
			
			$html .= '<h3 class="consultant-section-title">Counties Served</h3>';
			
			$values = $counties->get_values();
			
			asort( $values );
			
			foreach( $values as $county_key => $county ){
				
				$checked = ( in_array( $county_key , $terms ) ) ? ' checked="checked"':'';
				
				$html .= '<div class="consultant-field checkbox">';
				
					$html .= '<input id="service-type-' . $county_key . '" type="checkbox" name="_taxonomy[county][]" value="' . $county_key . '"' . $checked . '/>';
					
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

			$html .= '<div class="consultant-field radio" >';
			
				$html .= '<label>Certified Wildfire Mitigation Specialist(s) (CWMS) on staff</label>';
			
				$html .= '<div><input id="cwms-yes" type="radio" name="_cwms" value="1" ' . checked( 1 , $settings['_cwms'] , false  ) . '/><label for="cwms-yes">Yes</label></div>';
				
				$html .= '<div><input id="cwms-no" type="radio" name="_cwms" value="0" ' . checked( 0 , $settings['_cwms'] , false ) . '/><label for="cwms-no">No</label></div>';
			
			$html .= '</div>';

			$html .= '<div class="consultant-field radio" >';
			
				$html .= '<label>Are you an NRCS Technical Service Provider (TSP)</label>';
			
				$html .= '<div><input id="tsp-yes" type="radio" name="_tsp" value="1" ' . checked( 1 , $settings['_tsp'] , false  ) . '/><label for="tsp-yes">Yes</label></div>';
				
				$html .= '<div><input id="tsp-no" type="radio" name="_tsp" value="0" ' . checked( 0 , $settings['_tsp'] , false ) . '/><label for="tsp-no">No</label></div>';
			
			$html .= '</div>';

			$html .= '<div class="consultant-field"><label>TSP ID Number</label>';
			
				$html .= '<input type="text" name="_tsp_number" value="' . $settings['_tsp_number'] . '" placeholder="TSP number"/>';

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
	
	/**
	 * Save
	 * @param object $services instance of services taxonomy object
	 */
	public function save( $post_id ){
		
		if ( ! $this->check_permissions( $post_id ) ) return false;
		
		parent::save( $post_id );
		
		$taxonomies = array( $this->services->get_slug() );
		
		// Delete all terms from post
		//wp_delete_object_term_relationships( $post_id, $taxonomies );
		
		if ( ! empty( $_POST['_taxonomy']['service'] ) ){
		
			$this->services->save_post_terms( $post_id , $_POST['_taxonomy']['service'] );
		
		} // end if
		
		if ( ! empty( $_POST['_taxonomy']['county'] ) ){
		
			$this->counties->save_post_terms( $post_id , $_POST['_taxonomy']['county'] );
		
		} // end if
		
		
	} // end __construct
	
	
	
	
	
}
