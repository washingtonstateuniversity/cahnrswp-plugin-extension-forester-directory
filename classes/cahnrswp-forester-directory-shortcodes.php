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
		
		$posts = get_posts( array('post_type' => 'consultant' , 'posts_per_page' => -1 ) );
		
		$html .= '<div id="cwpdir">';
		
		$html .= $this->get_searchbar();
		
		$html .= $this->get_filter_bar();
		
		foreach( $posts as $post ){
			
			$settings = $this->consultant->get_settings( $post->ID );
			
			$html .= $this->get_card( $post , $settings );
			
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
	private function get_card( $post , $settings ){
		
		$html = '<div class="directory-card">';
		
			$html .= '<div class="directory-title">' . $post->post_title . '</div>';
			
			$html .= '<div class="directory-phone">' . $settings['_phone'] . '</div>';
			
			$html .= '<div class="directory-email">' . $settings['_email'] . '</div>';
			
			$html .= '<div class="directory-profile-button"><a href="#" data-id="profile-' . $post->ID . '">View Profile</a></div>';
			
			$html .= '<div id="profile-' . $post->ID . '"  style="display:none;">';
		
			$html .= '<div class="directory-profile-wrap">';
			
				$html .= '<div class="directory-profile-contact">';
				
					$html .= '<div class="directory-profile-title">' . $post->post_title . '</div>';
				
					$html .= '<div class="directory-profile-phone">' . $settings['_phone'] . '</div>';
					
					$html .= '<div class="directory-profile-email">' . $settings['_email'] . '</div>';
					
					$html .= '<div class="directory-profile-addres">' . $settings['_address'] . '<br>' . $settings['_city'] . ', ' . $settings['_state'] . ', ' . $settings['_zip'] . '</div>';
				
				$html .= '</div>';
				
				$html .= '<div class="directory-profile-content">';
				
					$html .= '<div class="directory-profile-remarks">';
					
						$html .= '<h4>Business Description and Remarks</h4>';
					
						$html .= apply_filters( 'the_content' , $post->post_content );
					
					$html .= '</div>';
					
					$html .= '<div class="directory-profile-locations">';
					
						$html .= '<h4>Locations</h4>';
					
						$terms = $this->counties->get_terms( $post->ID );
					
						$county_meta = '';
						
						$county_names = array();
					
						foreach( $terms as $term ){
							
							$county_meta .= $term->slug . ', ';
							
							$county_names[] = $term->name;
							
						} // end foreach
						
						$html .= implode( ', ' , $county_names );
						
						$html .= '<span class="directory-meta">' . $county_meta . '<span>';
					
					$html .= '</div>';
					
					$html .= '<div class="directory-profile-services">';
					
						$terms = $this->services->get_terms( $post->ID );
					
						$service_meta = '';
					
						foreach( $terms as $term ){
							
							$service .= $term->slug . ', ';
						} // end foreach
						
						$html .= '<span class="directory-meta">' . $service . '<span>';
					
					$html .= '</div>';
					
					$html .= '<div class="directory-profile-type">';
					
						$type_meta = '';
					
						if ( $settings['_service_forestry'] ) $type_meta .= 'service-forestry';
						
						if ( $settings['_service_silvicultural'] ) $type_meta = 'service-silvicultural';
					
						$html .= '<span class="directory-meta">' . $type_meta . '<span>';
					
					$html .= '</div>';
				
				$html .= '</div>';
			
			$html .= '</div>';
			
		
		$html .= '</div>';
		
		$html .= '</div>';
		
		
		
		return $html;
		
	} // end get_card
	
	
} // end CAHNRSWP_Forester_Directory_Shortcodes