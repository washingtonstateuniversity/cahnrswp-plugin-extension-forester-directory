<?php
/**
 * Post Type abstract class
 * @author Danial Bleile
 * @version 0.0.1
 */
 
abstract class CAHNRSWP_Forester_Directory_Post_Type {
	
	// @var string $slug Post type slug
	protected $slug;
	
	// @var string|array $label String for single label or array for all labels
	protected $label;
	
	// @var array $post_type_args Args for registering a post type
	protected $post_type_args = array();
	
	// @var array $post_type_args Args for registering a post type
	protected $default_post_type_args = array(
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
	
	// @var array $meta_fields Meta data for the post type
	protected $fields = array();
	
	// @var bool $do_save Add save action
	protected $do_save = false;
	
	// @var bool $taxonomies Taxomomies hard coded in to form
	protected $hard_taxonomies = false;
	
	/**
	 * Init the post type
	 * @param int $priority priority to assign to actions and filters
	 */
	public function init( $priority = 11 ){
		
		add_action( 'init' , array( $this , 'register' ) , $priority );
		
		if ( method_exists( $this , 'edit_form' ) ){
			
			add_action( 'edit_form_after_title' , array( $this , 'editor' ), $priority ); 
			
		} // end if
		
		if ( method_exists( $this , 'edit_form_after_editor' ) ){
			
			add_action( 'edit_form_after_editor' , array( $this , 'editor_after' ), $priority ); 
			
		} // end if
		
		if ( $this->do_save ){
			
			add_action( 'save_post_' . $this->get_slug() , array( $this , 'save' ), $priority ); 
			
		} // end if
		
	} // end init
	
	/**
	 * Get method for slug
	 * @return string slug value
	 */
	public function get_slug(){ return $this->slug; }
	
	/**
	 * Get method for labels
	 * @return string|array labels for post type
	 */
	public function get_label(){ return $this->label; }
	
	/**
	 * Get method for default_post_type_args
	 * @return array default args for registering post type
	 */
	public function get_default_post_type_args(){ return $this->default_post_type_args; }
	
	
	/**
	 * Get method for post_type_args
	 * @return array args for registering post type
	 */
	public function get_post_type_args(){ 
	
		$args = $this->get_default_post_type_args();
	
		foreach( $this->post_type_args as $key => $value ){
			
			$args[ $key ] = $value;
			
		} // end forach
		
		return $args;
	
	} // end get_post_type_args
	
	/**
	 * Get method for labels
	 * @return string|array labels for post type
	 */
	public function get_fields(){ return $this->fields; }
	
	/**
	 * Get method for hardtaxonomies
	 * @return bool|array taxonomy slugs for hard coded taxonomies
	 */
	public function get_hard_taxonomies(){ return $this->hard_taxonomies; }
	
	/**
	 * Get values for fields
	 * @param int $post_id ID of current post
	 * @reutrn array 
	 */
	public function get_settings( $post_id ){
		
		$settings = array();
		
		$fields = $this->get_fields();
		
		foreach( $fields as $key => $field ){
			
			$value = get_post_meta( $post_id , $key , true );
			
			if ( '' === $value ){
				
				$value = $field[1];
				
			} // end if
			
			$settings[ $key ] = $value;
			
		} // end foreach
		
		return $settings;
		
	}
	
	/**
	 * Register post type
	 */
	public function register(){
		
		$args = $this->get_post_type_args();
		
		$label = $this->get_label();
		
		if ( is_array( $label ) ){
			
			$args['labels'] = $label;
			
		} else {
			
			$args['label'] = $label;
			
		} // end if	
		
		register_post_type( $this->get_slug(), $args );
		
	} // end register
	
	/**
	 * Adds edit form after title only if "edit_form" is a declared method
	 * @param object $post WP Post Object
	 */
	public function editor( $post ){
		
		$settings = $this->get_settings( $post->ID );
		
		if ( $post->post_type == $this->get_slug() ){
			
			$html = $this->edit_form( $post , $settings );
			
			echo $html;
			
		} // end if
		
	} // end editor
	
	/**
	 * Adds edit form after editor only if "edit_form_after_editor" is a declared method
	 * @param object $post WP Post Object
	 */
	public function editor_after( $post ){
		
		$settings = $this->get_settings( $post->ID );
		
		if ( $post->post_type == $this->get_slug() ){
			
			$html = $this->edit_form_after_editor( $post , $settings );
			
			echo $html;
			
		} // end if
		
	} // end editor
	
	/**
	 * Save fields associated with post_type
	 * @param int $post_id ID of current post
	 */
	public function save( $post_id ){
		
		if ( ! $this->check_permissions( $post_id ) ) return false;
		
		$fields = $this->get_fields();
		
		foreach( $fields as $key => $field ){
			
			$value = isset( $_POST[ $key ] ) ? sanitize_text_field( $_POST[ $key ] ) : $field[1];
			
			update_post_meta( $post_id , $key , $value );
			
		} // end foreach
		
	} // end save
	
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
	
	
}
