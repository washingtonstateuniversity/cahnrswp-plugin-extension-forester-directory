<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Service_Provider {

	protected $address;
	protected $phone;
	protected $state;
	protected $fax;
	protected $city;
	protected $email;
	protected $zip;
	protected $website;


	public function get_address() {
		return $this->address;
	}


	public function get_phone() {
		return $this->phone;
	}


	public function get_state() {
		return $this->state;
	}


	public function get_fax() {
		return $this->fax;
	}


	public function get_city() {
		return $this->city;
	}


	public function get_email() {
		return $this->email;
	}


	public function get_zip() {
		return $this->zip;
	}


	public function get_website() {
		return $this->website;
	}

}
