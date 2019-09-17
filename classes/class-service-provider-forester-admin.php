<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Service_Provider_Forester_Admin extends Service_Provider_Forester {

	public function add_metaboxes( $post_type ) {

		add_meta_box(
			'forester_contact_info',
			'Contact Information',
			array( $this, 'render_contact_metabox' ),
			$post_type
		);

		add_meta_box(
			'forester_service_type',
			'Service Type',
			array( $this, 'render_service_type_metabox' ),
			$post_type
		);

		add_meta_box(
			'forester_services',
			'Services',
			array( $this, 'render_services_metabox' ),
			$post_type
		);

		add_meta_box(
			'counties',
			'Counties Served',
			array( $this, 'render_counties_metabox' ),
			$post_type
		);

		add_meta_box(
			'forester_optional',
			'Optional Information',
			array( $this, 'render_optional_metabox' ),
			$post_type
		);

		add_meta_box(
			'forester_consulting',
			'For Consulting Foresters',
			array( $this, 'render_consulting_metabox' ),
			$post_type
		);

	}


	public function render_contact_metabox( $post ) {

		$contact_address = $this->get_address();
		$contact_phone   = $this->get_phone();
		$contact_state   = $this->get_state();
		$contact_fax     = $this->get_fax();
		$contact_city    = $this->get_city();
		$contact_email   = $this->get_email();
		$contact_zip     = $this->get_zip();
		$contact_website = $this->get_website();

		include Template::get_template_path( 'metabox/contact.php' );

	}


	public function render_service_type_metabox( $post ) {

		include Template::get_template_path( 'metabox/forester/service-type.php' );

	}


	public function render_services_metabox( $post ) {

		$services       = $this->taxonomy_service->get_services();
		$other_services = $this->get_other_services();

		asort( $services );

		include Template::get_template_path( 'metabox/forester/services.php' );

	}


	public function render_counties_metabox( $post ) {

		$counties = $this->taxonomy_county->get_counties();

		asort( $counties );

		include Template::get_template_path( 'metabox/counties-served.php' );

	}

	public function render_optional_metabox( $post ) {

		$education             = $this->get_education();
		$liablility_insurance  = $this->get_liablility_insurance();
		$surety_bond           = $this->get_surety_bond();
		$pesticide_applicators = $this->get_pesticide_applicators();

		include Template::get_template_path( 'metabox/forester/optional-information.php' );

	}

	public function render_consulting_metabox( $post ) {

		$macf       = $this->get_macf();
		$saf        = $this->get_saf();
		$cwms       = $this->get_cwms();
		$tsp        = $this->get_tsp();
		$tsp_number = $this->get_tsp_number();
		$sfl        = $this->get_sfl();
		$flc        = $this->get_flc();

		include Template::get_template_path( 'metabox/forester/consulting.php' );

	}

}
