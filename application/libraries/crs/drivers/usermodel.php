<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel
{
	public $name;
	public $leaf;
	public $status;
	public $level;
	
	function setName($name)
	{
		$this->name = $name;	
	}
	
	function setLeaf($leaf)
	{
		$this->leaf = $leaf;	
	}
	
	function setStatus($status)
	{
		$this->status = $status;	
	}
	
	function setLevel($level)
	{
		$this->level = $level;	
	}
}

?>