<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class CAHNRSWP_Forester_Directory {

	private $taxonomy_service;
	private $taxonomy_county;
	private $factory_service_provider;
	private $post_type_consultant;


	public function init_plugin() {

		// Include abstracts
		include __DIR__ . '/class-directory.php';
		include __DIR__ . '/class-taxonomy.php';
		include __DIR__ . '/class-post-type.php';
		include __DIR__ . '/class-service-provider.php';

		// Include utility classes
		include __DIR__ . '/class-template.php';

		// Include taxonomies
		include __DIR__ . '/class-taxonomy-service.php';
		include __DIR__ . '/class-taxonomy-county.php';

		// Include post types
		include __DIR__ . '/class-post-type-consultant.php';

		// Include factories
		include __DIR__ . '/class-factory-service-provider.php';

		// Setup objects
		$this->taxonomy_service         = new Taxonomy_Service();
		$this->taxonomy_county          = new Taxonomy_County();
		$this->factory_service_provider = new Factory_Service_Provider( $this->taxonomy_service, $this->taxonomy_county );
		$this->post_type_consultant     = new Post_Type_Consultant( $this->factory_service_provider );

		// Init plugin components
		$this->post_type_consultant->init();
		$this->taxonomy_service->init();

	}

}