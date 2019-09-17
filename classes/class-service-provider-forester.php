<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Service_Provider_Forester extends Service_Provider {

	protected $taxonomy_service;
	protected $taxonomy_county;

	protected $other_services;
	protected $education;
	protected $liablility_insurance;
	protected $surety_bond;
	protected $pesticide_applicators;
	protected $macf;
	protected $saf;
	protected $cwms;
	protected $tsp;
	protected $tsp_number;
	protected $sfl;
	protected $flc;


	public function __construct( $taxonomy_service, $taxonomy_county ) {

		$this->taxonomy_service = $taxonomy_service;
		$this->taxonomy_county  = $taxonomy_county;

	}

	
	public function get_other_services() {
		return $this->other_services;
	}


	public function get_education() {
		return $this->education;
	}


	public function get_liablility_insurance() {
		return $this->liablility_insurance;
	}


	public function get_surety_bond() {
		return $this->surety_bond;
	}


	public function get_pesticide_applicators() {
		return $this->pesticide_applicators;
	} 


	public function get_macf() {
		return $this->macf;
	}


	public function get_saf() {
		return $this->saf;
	}


	public function get_cwms() {
		return $this->cwms;
	}


	public function get_tsp() {
		return $this->tsp;
	}


	public function get_tsp_number() {
		return $this->tsp_number;
	}


	public function get_sfl() {
		return $this->sfl;
	}


	public function get_flc() {
		return $this->flc;
	}

}
