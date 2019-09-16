<?php
/**
 * Defines taxonomy object
 * @author Danial Bleile
 * @version 0.0.1
 */
 

abstract class CAHNRSWP_Forester_Directory_taxonomy {
	
	// @var string $slug taxonomy slug
	protected $slug;
	
	// @var string|array $label String for single label or array for all labels
	protected $label;
	
	// @var array $taxonomy_args Args for registering a taxonomy
	protected $taxonomy_args = array();
	
	// @var array $post_types
	protected $post_types = array();
	
	// @var array $args Taxonomy Args
	protected $args = array();
	
	// @var array $default_args Default Taxonomy Args
	protected $default_args = array(
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		);
	
	// @var array $values Predefined values
	protected $values = array();
	
	/**
	 * Get method for slug
	 * @return string slug value
	 */
	public function get_slug(){ return $this->slug; }
	
	/**
	 * Get method for labels
	 * @return string|array labels
	 */
	public function get_label(){ return $this->label; }
	
	/**
	 * Get method for post types
	 * @return string|array post types
	 */
	public function get_post_types(){ return $this->post_types; }
	
	/**
	 * Get method for values
	 * @return array values
	 */
	public function get_values(){ return $this->values; }
	
	/**
	 * Get method for args
	 * @return array
	 */
	public function get_args(){ 
	
		$args = $this->get_default_args();
		
		foreach( $this->args as $key => $value ){
			
			$args[ $key ] = $value;
			
		} // end foreach
	
		return $args;
		 
	}
	
	/**
	 * Get method for args
	 * @return array
	 */
	public function get_default_args(){ return $this->default_args; }
	
	/**
	 * Init the taxonomy
	 * @param int $priority priority to assign to actions and filters
	 */
	public function init( $priority = 11 ){
		
		add_action( 'init' , array( $this , 'register' ) , $priority );
		
	} // end init
	
	/**
	 * Install The plugin
	 */
	protected function pre_populate(){
		
		$values = $this->get_values();
		
		if ( ! empty( $values ) ){
			
			foreach( $this->get_values() as $slug => $name ){
				
				if ( ! term_exists( $slug , $this->get_slug() ) ){
					
					wp_insert_term( $name, $this->get_slug(), $args = array('slug' => $slug ) );
					
				} // end if
				
			} // end foreach
			
		} // end if
		
	}
	
	/**
	 * Get terms applied to a post
	 * @param int $post_id ID of current post
	 * @param bool $slugs Return array of slugs
	 */
	public function get_terms( $post_id , $slugs = false ){
		
		$terms = get_the_terms( $post_id , $this->get_slug() );
		
		if ( ! is_array( $terms ) ) $terms = array();
		
		if ( $slugs ){
			
			$term_slugs = array();
			
			foreach( $terms as $term ){
				
				$term_slugs[] = $term->slug;
				
			} // end foreach
			
			return $term_slugs;
			
		} else {
			
			return $terms;
			
		} // end if
		
	} // end get_terms
	
	/**
	 * Register post type
	 */
	public function register(){
		
		$args = $this->get_args();
		
		$label = $this->get_label();
		
		if ( is_array( $label ) ){
			
			$args['labels'] = $label;
			
		} else {
			
			$args['label'] = $label;
			
		} // end if	
		
		register_taxonomy( $this->get_slug(), $this->get_post_types() , $args );
		
		$this->pre_populate();
		
	} // end register
	
	/**
	 * Save terms associated with a post
	 * @param int $post_id ID of the current post
	 * @param array $terms Array of term ids,slugs,names
	 */
	public function save_post_terms( $post_id , $terms , $append = false ){
		
		if ( ! $this->check_permissions( $post_id ) ) return false;
		
		foreach( $terms as $index => $term ){
			
			$terms[ $index ] = sanitize_text_field( $term );
			
		} // end foreach
			
		wp_set_object_terms( $post_id, $terms, $this->get_slug(), $append );
			
	} // end save_post_terms
	
	/**
	 * Check user permissions
	 * @param int $post_id Post ID
	 * @return bool TRUE if has permissions otherwise FALSE
	 */
	protected function check_permissions( $post_id ){
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( current_user_can( 'edit_page', $post_id ) ) {

				return true;

			} // end if

		} else {

			if ( current_user_can( 'edit_post', $post_id ) ) {

				return true;

			} // end if

		} // end if
		
		return false;
		
	}// end check_permissions
	
	
} // end CAHNRSWP_Forester_Directory_Service