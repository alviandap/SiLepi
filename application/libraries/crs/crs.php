<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('drivers/crs_ontology.php');

class CRS extends CI_Driver_Library
{
	public $valid_drivers;
	public $CI;
	public $ontology;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->ontology = new CRS_Ontology();
		$this->valid_drivers = array('crs_ontology', 'crs_pre', 'crs_usermodeling', 'crs_usermodel');
	}
}

?>