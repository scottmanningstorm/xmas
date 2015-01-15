<?php 

class FacilityController extends SecureBaseController
{
	protected $facility_repository;
	
	public function __construct() 
	{ 
		parent::__construct(); 
		
		$this->facility_repository	= new FacilitiesRepository();
	}	

	public function index() 
	{
		
	}
}

?> 