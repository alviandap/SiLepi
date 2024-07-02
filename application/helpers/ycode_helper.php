<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  	
		API Function For Any Purpose Version 1.10
		YCode = Yusza Code Helper
		
		Author 			: Yusza Redityamurti
		Date Created 	: 11 Februari 2015
		Last Edited		: 11 Februari 2015
**/	

//convert string to url friendly
function y_urlf($string) 
{
	//Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
	$string = strtolower($string);
	//Strip any unwanted characters
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	//Clean multiple dashes or whitespaces
	$string = preg_replace("/[\s-]+/", " ", $string);
	//Convert whitespaces and underscore to dash
	$string = preg_replace("/[\s_]/", "-", $string);
	
	return $string;
}

//convert date to another format
function y_convert_date($date, $format='d-m-Y') 
{
	return date($format, strtotime($date));
}

//convert date to text
function y_date_text($date) 
{
	$date1 	= date('d-m-Y', strtotime($date));
	$exp	= explode('-', $date1);
	
	return $exp[0].' '.y_get_month($exp[1]).' '.$exp[2];
}

//get url admin
function y_url_admin()
{
	$CI =& get_instance();
	return $CI->config->item('admin_url');
}

//ellipsis
function y_ellipsis($str, $length='180')
{
	$str = strip_tags(trim($str));
	
	// If the text is already shorter than the max length, then just return unedited text.
	if (strlen($str) <= $length) {
		return $str;
	}
	
	// Find the last space (between words we're assuming) after the max length.
	$last_space = strrpos(substr($str, 0, $length), ' ');
	// Trim
	$trimmed_text = substr($str, 0, $last_space);
	// Add ellipsis.
	$trimmed_text .= ' ...';
	
	return ucfirst($trimmed_text);
}

function y_get_month($id, $type='full')
{
	if($type == 'full')
		$months = y_month_list();
	else if ($type == 'tri')
		$months = y_month_list_3();
					 
	if (isset ($months[(int) $id]))
		return $months[(int) $id];
	else
		return '';                         
}

function y_month_list()
{
	$months = array( '1' => 'Januari',
					 '2' => 'Februari',
					 '3' => 'Maret',
					 '4' => 'April',
					 '5' => 'Mei',
					 '6' => 'Juni',
					 '7' => 'Juli',
					 '8' => 'Agustus',
					 '9' => 'September',
					 '10' => 'Oktober',
					 '11' => 'November',
					 '12' => 'Desember');
					 
	return $months;                         
}

function y_month_list_3()
{
	$months = array( '1' => 'Jan',
					 '2' => 'Feb',
					 '3' => 'Mar',
					 '4' => 'Apr',
					 '5' => 'Mei',
					 '6' => 'Juni',
					 '7' => 'Juli',
					 '8' => 'Ags',
					 '9' => 'Sep',
					 '10' => 'Okt',
					 '11' => 'Nov',
					 '12' => 'Des');
					 
	return $months;                         
}

//run command and get result output
function y_command($bin, $command = '', $force = true)
{
	$stream = null;
	$bin .= $force ? ' 2>&1' : '';

	$descriptorSpec = array
	(
		0 => array('pipe', 'r'),
		1 => array('pipe', 'w')
	);

	$process = proc_open($bin, $descriptorSpec, $pipes);

	if (is_resource($process))
	{
		fwrite($pipes[0], $command);
		fclose($pipes[0]);

		$stream = stream_get_contents($pipes[1]);
		fclose($pipes[1]);

		proc_close($process);
	}

	return $stream;
}
?>