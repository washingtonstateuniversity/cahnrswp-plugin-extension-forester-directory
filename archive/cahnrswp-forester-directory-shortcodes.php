<?php
/**
 * Defines shortcode
 * @author Danial Bleile
 * @version 0.0.1
 */
class CAHNRSWP_Forester_Directory_Shortcodes {
	
	//@var object $consultant instance of CAHNRSWP_Forester_Directory_Consultant
	protected $consultant;
	
	public function __construct( $consultant , $counties , $services ){
		
		$this->consultant = $consultant;
		
		$this->counties = $counties;
		
		$this->services = $services;
		
	} // end __construct
	
	/**
	 * Init the shortcodes
	 * @param int $priority priority to assign to actions and filters
	 */
	public function init( $priority = 11 ){
		
		add_action( 'init' , array( $this , 'add_shortcodes' ) , $priority );
		
		add_action( 'wp_enqueue_scripts' , array( $this , 'enqueue_public_scripts' ) );
		
	} // end init
	
	/**
	 * Add public style and JS
	 */
	public function enqueue_public_scripts(){
		
		wp_enqueue_script( 'forestry_directory_js' , plugins_url( 'js/script.js', dirname(__FILE__) ) , false , '0.0.1' , true );
		
		wp_enqueue_style( 'forestry_directory_css' , plugins_url( 'css/style.css', dirname(__FILE__) ) , false , '0.0.1' );
		
	} // end enqueue_public_scripts
	
	/**
	 * Registers and adds shortcode
	 */
	public function add_shortcodes(){
		
		add_shortcode( 'forester_directory', array( $this , 'render_shortcode' ) );
		
	} // end add_shortcodes
	
	/**
	 * Build and return html for shortcode
	 * @param array $atts Shortcode settings
	 * @param string $content 
	 * @param string $name Shortcode name
	 * @return string Html for the shortcode
	 */
	public function render_shortcode( $atts , $content, $name ){
		
		add_thickbox();
		
		$posts = get_posts( array('post_type' => 'consultant' , 'posts_per_page' => -1 , 'orderby'=> 'title', 'order' => 'ASC' ) );
		
		$html .= '<div id="cwpdir">';
		
		$html .= $this->get_searchbar();
		
		$html .= $this->get_filter_bar();
		
		foreach( $posts as $post ){
			
			$html .= $this->get_card( $post );
			
		} // end foreach
		
		$html .= '</div>';
		
		return $html;
		
	} // end  render_shortcode
	
	private function get_searchbar(){
		
		$html = '<fieldset id="cwpdir-search"><div><input type="text" value="" placeholder="Search Directory" /></div></fieldset>';
		
		return $html;
		
	}
	
	private function get_filter_bar(){
		
		$html = '<fieldset id="cwpdir-filter">';
		
			$html .= '<div class="filter">';
			
				$html .= '<label>By County</label>';
				
				$html .= '<select name="county">';
				
					$html .= '<option value="none">None</option>';
				
					$values = $this->counties->get_values();
					
					asort( $values );
					
					foreach( $values as $key => $name ){
						
						$html .= '<option value="' . $key . '">' . $name . '</option>';
						
					} // end foreach
				
				$html .= '</select>';
			
			$html .= '</div>';
			
			$html .= '<div class="filter">';
			
				$html .= '<label>By Service</label>';
				
				$html .= '<select name="service">';
				
					$html .= '<option value="none">None</option>';
				
					$values = $this->services->get_values();
					
					asort( $values );
					
					foreach( $values as $key => $name ){
						
						$html .= '<option value="' . $key . '">' . $name . '</option>';
						
					} // end foreach
				
				$html .= '</select>';
			
			$html .= '</div>';
			
			$html .= '<div class="filter">';
			
				$html .= '<label>By Service Type</label>';
				
				$html .= '<select name="type">';
				
					$html .= '<option value="none">None</option>';
						
					$html .= '<option value="service-forestry">Forestry Consultant</option>';
					
					$html .= '<option value="service-silvicultural">Silvicultural Contractor</option>';
				
				$html .= '</select>';
			
			$html .= '</div>';
		
		$html .= '</fieldset>';
		
		return $html;
	}
	
	/**
	 * Get card view
	 * @param object $post WP Post
	 * @param array $settings Post settings
	 * @return string HTML for the card
	 */
	private function get_card( $post ){
		
		$this->consultant->the_consultant( $post );
		
		$settings = $this->consultant->get_c_settings();
		
		$html = '<div class="directory-card">';
		
			$html .= '<div class="directory-title"><a class="action-show-profile" href="#" data-id="profile-' . $post->ID . '">' . $post->post_title . '</a></div>';
			
			$html .= '<div class="directory-address">' . $settings['_city'] . ', ' . $settings['_state'] . '</div>';
			
			if ( ! empty( $settings['_phone'] ) ) {

			$html .= '<div class="directory-phone">Phone: ' . $settings['_phone'] . '</div>';

			}
			
			$html .= '<div class="directory-profile-button"><a class="action-show-profile" href="#" data-id="profile-' . $post->ID . '">View Profile</a></div>';
			
			$html .= $this->get_profile( $post , $settings );
		
		$html .= '</div>';
		
		
		
		return $html;
		
	} // end get_card
	
	private function get_profile( $post , $settings  ){
		
		$html .= '<article id="profile-' . $post->ID . '" class="directory-profile">';
		
			$html .= '<header><h3>' . $post->post_title . '</h3></header>';
		
			$html .= '<div class="directory-profile-sidebar">';
				
				$html .= $this->get_profile_type( $post , $settings );
				
				$html .= $this->get_profile_locations( $post , $settings );
			
			$html .= '</div>';
			
			$html .= '<div class="directory-profile-main">';
			
				$html .= $this->get_profile_contact( $post , $settings );
			
				$html .= $this->get_profile_remarks( $post , $settings );
					
				$html .= $this->get_profile_services( $post , $settings );
				
				$html .= $this->get_profile_optional( $post , $settings );
				
				if ( $settings['_service_forestry'] ) $html .= $this->get_profile_consulting( $post , $settings );
				
				if ( $settings['_service_silvicultural'] ) $html .= $this->get_profile_contractors( $post , $settings );
			
			$html .= '</div>';
		
		$html .= '</article>';
		
		return $html;
		
	}
	
	private function get_profile_contact( $post , $settings ){
		
		$html = '<div class="directory-profile-contact">';
		
			$html .= '<h4>Contact Information</h4>';
			
			$html .= '<div class="directory-profile-addres">' . $settings['_address'] . '<br>' . $settings['_city'] . ', ' . $settings['_state'] . ', ' . $settings['_zip'] . '</div>';
		
			if ( ! empty( $settings['_phone'] ) ) $html .= '<div class="directory-profile-phone"><strong>Phone: </strong>' . $settings['_phone'] . '</div>';
			
			if ( ! empty( $settings['_fax'] )) $html .= '<div class="directory-profile-fax"><strong>Fax: </strong>' . $settings['_fax'] . '</div>';
			
			if (! empty(  $settings['_email'] )) $html .= '<div class="directory-profile-email"><strong>Email: </strong><a href="mailto:' . $settings['_email'] . '">' . $settings['_email'] . '</a></div>';
			
			if ( ! empty( $settings['_website'] )) $html .= '<div class="directory-profile-website"><a target="_blank" href="' . $settings['_website'] . '">' . $settings['_website'] . '</a></div>';
		
		$html .= '</div>';
		
		return $html;
		
	}
	
	private function get_profile_remarks( $post , $settings ){
		
		$html = '<div class="directory-profile-remarks">';
					
			$html .= '<h4>Business Description and Remarks</h4>';
		
			$html .= apply_filters( 'the_content' , $post->post_content );
		
		$html .= '</div>';
		
		return $html;
		
	} 
	
	private function get_profile_locations( $post , $settings ){
		
		$html = '<div class="directory-profile-locations">';
					
			$html .= '<h4>Counties Served</h4>';
		
			$terms = $this->counties->get_terms( $post->ID );
		
			$county_meta = '';
			
			$html .= '<ul class="directory-option-set">';
		
			foreach( $terms as $term ){
				
				$county_meta .= $term->slug . ', ';
				
				$html .= '<li>' . $term->name . '</li>';
				
			} // end foreach
			
			$html .= '</ul>';
			
			$html .= '<span class="directory-meta">' . $county_meta . '<span>';
		
		$html .= '</div>';
		
		return $html;
		
	} 
	
	private function get_profile_services( $post , $settings ){
		
		$html = '<div class="directory-profile-services">';
		
			$html .= '<h4>Services</h4>';
			
			$terms = $this->services->get_terms( $post->ID  );
		
			$service_meta = '';
			
			$html .= '<ul class="directory-option-set">';
		
			foreach( $terms as $term ){
				
				$html .= '<li>' . $term->name . '</li>';
				
				$service .= $term->slug . ', ';
				
			} // end foreach
			
			if ( $settings['_other_services'] ) $html .= '<li>Other Services: ' . $settings['_other_services'] . '</li>';
			
			$html .= '</ul>';
			
			$html .= '<span class="directory-meta">' . $service . '<span>';
		
		$html .= '</div>';
		
		return $html;
		
	} 
	
	private function get_profile_type( $post , $settings ){
		
		$meta = array();
		
		$html = '<div class="directory-profile-type">';
		
			$html .= '<h4>Service Type</h4>';
		
			$html .= '<ul class="directory-option-set">';
			
				if ( $settings['_service_forestry'] ){
					
					$meta[] = 'service-forestry';
					
					$html .= '<li>Forestry Consultant</li>';
					
				} // end if
				
				if ( $settings['_service_silvicultural'] ){
					
					$meta[] = 'service-silvicultural';
					
					$html .= '<li>Silvicultural Contractor</li>';
					
				} // end if
			
			$html .= '</ul>';
		
			$html .= '<span class="directory-meta">' . implode( ',' , $meta ) . '<span>';
		
		$html .= '</div>';
		
		return $html;
		
	} 
	
	private function get_profile_optional( $post , $settings ){
		
		$meta = array();
		
		$html = '<div class="directory-profile-optional">';
		
			$html .= '<h4>Optional Information</h4>';
		
			$html .= '<ul class="directory-option-inline">';
					
				$education = ( ! empty( $settings['_education'] ) ) ? $settings['_education'] : 'N/A';
					
				$html .= '<li><strong>Experience/Education of Key Personnel: </strong>' . $education . '</li>';
				
				$insurance = ( ! empty( $settings['_liablility_insurance'] ) ) ? $settings['_liablility_insurance'] : 'N/A';
					
				$html .= '<li><strong>Carries Liability Insurance: </strong>' . $insurance . '</li>';
				
				$surety_bond = ( ! empty( $settings['_surety_bond'] ) ) ? $settings['_surety_bond'] : 'N/A';
					
				$html .= '<li><strong>Carries Surety Bond: </strong>' . $surety_bond . '</li>';
				
				$pesticide_applicators = ( ! empty( $settings['_pesticide_applicators'] ) ) ? $settings['_pesticide_applicators'] : 'N/A';
					
				$html .= '<li><strong>Licensed Pesticide Applicators on staff: </strong>' . $pesticide_applicators . '</li>';
				
			$html .= '</ul>';	
		
		$html .= '</div>';
		
		return $html;
		
	}
	
	private function get_profile_consulting( $post , $settings ){
		
		$meta = array();
		
		$html = '<div class="directory-profile-consulting">';
		
			$html .= '<h4>For Consulting Foresters</h4>';
		
			$html .= '<ul class="directory-option-inline">';
					
				$macf = ( ! empty( $settings['_macf'] ) ) ? 'Yes' : 'No';
					
				$html .= '<li><strong>Member of Association of Consulting Foresters: </strong>' . $macf . '</li>';
				
				$saf = ( ! empty( $settings['_saf'] ) ) ? 'Yes' : 'No';
					
				$html .= '<li><strong>SAF Certified Foresters on Staff: </strong>' . $saf . '</li>';

				if ( '' !== $settings['_tsp'] ) {

					$tsp = ( ! empty( $settings['_tsp'] ) ) ? 'Yes' : 'No';

					$tsp_number = ( ! empty( $settings['_tsp_number'] ) ) ? $settings['_tsp_number'] : '';

					$html .= '<li><strong>NRCS Technical Service Provider (TSP): </strong>' . $tsp . '</li>';

					$html .= '<li><strong>TSP ID Number: </strong>' . $tsp_number . '</li>';

				}

				if ( '' !== $settings['_cwms'] ) {

					$cwms = ( ! empty( $settings['_cwms'] ) ) ? 'Yes' : 'No';

					$html .= '<li><strong>Certified Wildfire Mitigation Specialist(s) (CWMS) on staff: </strong>' . $cwms . '</li>';

				}
				
			$html .= '</ul>';	
		
		$html .= '</div>';
		
		return $html;
		
	} 
	
	private function get_profile_contractors( $post , $settings ){
		
		$meta = array();
		
		$html = '<div class="directory-profile-contractors">';
		
			$html .= '<h4>For silvicultural Contractors</h4>';
		
			$html .= '<ul class="directory-option-inline">';
					
				$sfl = ( ! empty( $settings['_sfl'] ) ) ? 'Yes' : 'No';
					
				$html .= '<li><strong>Registered Washington State Farm Labor Contractor: </strong>' . $sfl . '</li>';
				
				$flc = ( ! empty( $settings['_flc'] ) ) ? $settings['_flc'] : 'N/A';
					
				$html .= '<li><strong>FLC license number: </strong>' . $flc . '</li>';
				
			$html .= '</ul>';	
		
		$html .= '</div>';
		
		return $html;
		
	} 
	
} // end CAHNRSWP_Forester_Directory_Shortcodes