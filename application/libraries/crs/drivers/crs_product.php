<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRS_product
{
	public $name;
	public $suppf;
	public $suppfh;
	public $suppfs;
	public $suppfhfs;
	
	function setName($name)
	{
		$this->name = $name;	
	}
	
	function setSuppF($suppf)
	{
		$this->suppf = $suppf;	
	}
	
	function setSuppFH($suppfh)
	{
		$this->suppfh = $suppfh;	
	}
	
	function setSuppFS($suppfs)
	{
		$this->suppfs = $suppfs;	
	}
	
	function setSuppFHFS($suppfhfs)
	{
		$this->suppfhfs = $suppfhfs;	
	}
}

?>