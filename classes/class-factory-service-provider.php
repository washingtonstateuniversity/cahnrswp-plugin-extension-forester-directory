<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Factory_Service_Provider {

	protected $taxonomy_service;
	protected $taxonomy_county;


	public function __construct( $taxonomy_service, $taxonomy_county ) {

		$this->taxonomy_service = $taxonomy_service;
		$this->taxonomy_county  = $taxonomy_county;

		include_once __DIR__ . '/class-service-provider-forester.php';
		include_once __DIR__ . '/class-service-provider-forester-admin.php';

	}


	public function get_provider( $provider_type, $as_admin = false ) {

		switch ( $provider_type ) {

			case 'forestry':
				$provider = $this->get_forester( $as_admin );
				break;

			default: 
				$provider = false;
				break;
		}

		return $provider;

	}


	protected function get_forester( $as_admin = false ) {

		if ( $as_admin ) {

			$provider = new Service_Provider_Forester_Admin( $this->taxonomy_service, $this->taxonomy_county );

		} else {

			$provider = new Service_Provider_Forester( $this->taxonomy_service, $this->taxonomy_county );

		}

		return $provider;

	}


}