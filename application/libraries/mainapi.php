<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  	
		API Function For Any Purpose Version 1.10
		
		Author 			: Yusza Redityamurti
		Date Created 	: 01 Januari 2011
		Last Edited		: 25 April 2012
**/


class CI_Mainapi
{
	function initcalendar() 
	{
		$teks = '<script type="text/javascript" src="'.base_url().'api/jquery/ui/jquery.ui.core.js"></script>
				 <script type="text/javascript" src="'.base_url().'api/jquery/ui/jquery.ui.datepicker.js"></script>
				 <script type="text/javascript" src="'.base_url().'api/jquery/ui/i18n/jquery.ui.datepicker-id.js"></script>';
		
		return $teks;
	}

	function calendarbox($id, $value='', $cls='')
	{
		$teks  = '';	
		$teks .= '<script type="text/javascript">
					$(function() {
						$( "#'.$id.'" ).datepicker();
						$( "#'.$id.'" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
						$( "#'.$id.'" ).datepicker( "option", "showAnim", "slideDown" );
						$( "#'.$id.'" ).datepicker( "option", "altField", "#'.$id.'_alt" );
						$( "#'.$id.'" ).datepicker( "option", "altFormat", "DD, d MM yy" );
						$( "#'.$id.'" ).datepicker( "option", "changeYear", true );
						$( "#'.$id.'" ).datepicker( "option", "changeMonth", true );';
		
		if(!empty($value))
			$teks .= '$( "#'.$id.'" ).datepicker( "setDate", "'.$value.'" )';
		
		$teks .= '});
				 </script>';
				 
		$teks .= '<input type="text" id="'.$id.'" name="'.$id.'" class="'.(empty($cls) ? 'normal' : $cls).'" style="width:60px" />&nbsp;&nbsp;';
		$teks .= '<input type="text" id="'.$id.'_alt" class="'.(empty($cls) ? 'normal_alt' : $cls.'_alt').'" disabled="disabled" style="width:150px" />&nbsp;';
		
		return $teks;
	}
	
	function calendartimebox($id, $value='')
	{
		$teks  = '';
		$teks .= '<script type="text/javascript" src="api/jquery/ui/jquery.ui.timepicker.js"></script>';
		$teks .= '<script language="javascript">
				  $(function() {
				  $("#'.$id.'").timepicker({
					  showNowButton: false,
					  showDeselectButton: false,
					  defaultTime: "'.$value.'",
					  showCloseButton: false,
					  hourText: "Jam",
					  minuteText: "Menit",
					  showPeriodLabels: false,
				  }); });
				  </script>';
				  
		$teks .= '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" style="width:60px" readonly="readonly" />';
		
		return $teks;
	}
	
	function calendarboxrange($id1, $id2)
	{
		$teks  = '';	
		$teks .= '<script type="text/javascript">
					$(function() {
						var dates = $( "#'.$id1.', #'.$id2.'" ).datepicker({
							dateFormat : "d MM yy",
							showAnim : "slideDown",
							altFormat : "yy-mm-dd",
							changeMonth: true,
							changeYear: true,
							onSelect: function( selectedDate ) {
								if(this.id == "'.$id1.'") 
									$(this).datepicker( "option", "altField", "#"+this.id+"_id" );
								else 
									$(this).datepicker( "option", "altField", "#"+this.id+"_id" );
								
								var option = this.id == "'.$id1.'" ? "minDate" : "maxDate",
									instance = $( this ).data( "datepicker" );
									date = $.datepicker.parseDate(
										instance.settings.dateFormat ||
										$.datepicker._defaults.dateFormat,
										selectedDate, instance.settings );
								dates.not( this ).datepicker( "option", option, date );
							}
						});';
		
		$teks .= '});
				 </script>';
				 
		$teks .= '<input type="text" id="'.$id1.'" class="input-text" name="'.$id1.'" style="width:110px" /> &nbsp; s/d &nbsp 
				  <input type="text" id="'.$id2.'" class="input-text" name="'.$id2.'" style="width:110px" />';
		$teks .= '<input type="hidden" id="'.$id1.'_id" name="'.$id1.'_id" /><input type="hidden" id="'.$id2.'_id" name="'.$id2.'_id" />';
		
		return $teks;
	}
	
	function calendarboxrangemonth($id1, $id2)
	{
		$teks  = '';	
		$teks .= '<script type="text/javascript">
					$(function() {
						var dates = $( "#'.$id1.', #'.$id2.'" ).datepicker({
							dateFormat 	: "MM yy",
							showAnim 	: "slideDown",
							altFormat 	: "yy-mm",
							changeMonth	: true,
							changeYear	: true,
							showButtonPanel : true,
							beforeShow : function(input, inst) {
								if(this.id == "'.$id1.'") $(this).datepicker( "option", "altField", "#"+this.id+"_id" );
								else $(this).datepicker( "option", "altField", "#"+this.id+"_id" );
							},
							onClose : function(dateText, inst) {				
								var month = inst.dpDiv.find(".ui-datepicker-month").val();
								var year = inst.dpDiv.find(".ui-datepicker-year").val();
								$(this).datepicker("setDate", new Date(year, month, 1));
								
								if(this.id == "'.$id1.'") dates.not(this).datepicker( "option", "minDate", new Date(year, month, 1));
							}
						});';
		
		$teks .= '});
				 </script>';
		
		$teks .= '<span class="css-container"></span>';
		$teks .= '<input type="text" id="'.$id1.'" class="'.$id1.'" name="'.$id1.'" style="width:110px" /> &nbsp; s/d &nbsp 
				  <input type="text" id="'.$id2.'" class="'.$id2.'" name="'.$id2.'" style="width:110px" />';
		$teks .= '<input type="hidden" id="'.$id1.'_id" name="'.$id1.'_id" /><input type="hidden" id="'.$id2.'_id" name="'.$id2.'_id" />';
		
		return $teks;
	}
	
	/**  	Spinner -> untuk input berupa angka seperti tahun, jumlah barang, dll
			parameter -> nama input, init (jika sudah ada satu spinner, yang kedua set ke false), 
			value pertama inputan, width input in px (biasanya 100), nilai minimal, nilai maksimal
	**/
	function spinner($id, $init = false, $value = '0', $size = '50', $min = -100, $max = 100) {
		$html = '';
		if($init) $html .= '<link type="text/css" rel="stylesheet" href="api/jquery/plugins/spinner/ui.spinner.css" />
							<script type="text/javascript" language="javascript" src="api/jquery/plugins/spinner/ui.spinner.js"></script>';
		$html .= '<script type="text/javascript">';
		$html .= 'jQuery().ready(function($) { ';
		$html .= "$('#$id').spinner({ min: $min, max: $max });";
		$html .= '}); </script>';	
		$html .= '<input type="text" id="'.$id.'" name="'.$id.'" value="'.$value.'" style="width:'.$size.'px" />';
		
		return $html;
	}
	
	/**  	Untuk mengubah format tanggal misalnya format dari database 2011-01-31 menjadi format indonesia 31-01-2011 atau sebaliknya
			input berupa tanggal dan output berupa tanggal yang sudah dibalik
	**/
	function convertdate($date) 
	{
		$date = trim($date);
		if (empty($date))    
			return '0000-00-00';
	
		$pieces = explode('-', $date);
		if (count($pieces) != 3)
			return '0000-00-00';
		
		return $pieces[2].'-'.$pieces[1].'-'.$pieces[0];    
	}
	
	function convertdatetime($date) 
	{
		$date = trim($date);
		if (empty($date))    
			return NULL;
		
		$type = explode(' ', $date);
		
		$pieces = explode('-', $type[0]);
		if (count($pieces) != 3)
			return NULL;
		
		return $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' '.$type[1];    
	}
	
	/**  	Untuk mengconvert tanggal
			input  : 2011-01-31
			output : 31 januari 2011
	**/
	function date2text($date) 
	{
		$date = trim($date);
		if (empty($date))    
			return NULL;
	
		$pieces = explode('-', $date);
		if (count($pieces) != 3)
			return NULL;
		
		return $pieces[2].' '.$this->getMonthName2($pieces[1]).' '.$pieces[0];    
	}
	function date2textfull($date) 
	{
		$date = trim($date);
		if (empty($date))    
			return NULL;
		
		
		$timestamp = strtotime($date);
		$date_new  = date("Y-m-d-N", $timestamp);
		
		$pieces = explode('-', $date_new);
		if (count($pieces) != 4)
			return NULL;
		
		return $this->getDayName($pieces[3]).', '.$pieces[2].' '.$this->getMonthName2($pieces[1]).' '.$pieces[0];    
	}
	
	function datetime2text($date)
	{
		$date = trim($date);
		if (empty($date))    
			return NULL;
		
		$type = explode(' ', $date);
		
		$pieces = explode('-', $type[0]);
		
		if (count($pieces) != 3)
			return NULL;
		
		return $pieces[2].' '.$this->getMonthName2($pieces[1]).' '.$pieces[0].' '.$type[1];    
	}
	
	function datetime2date($date)
	{
		$date = trim($date);
		if (empty($date))    
			return NULL;
		
		$type = explode(' ', $date);
		
		$pieces = explode('-', $type[0]);
		
		if (count($pieces) != 3)
			return NULL;
		
		return $pieces[2].'/'.$pieces[1].'/'.$pieces[0];    
	}
	
	/**  	Untuk convert dari angka ke bentuk rupiah
			input  : 1000000
			output : Rp. 1,000,000
	**/
	function numeric2idr($number){
		return 'Rp. '.number_format($number, 0, ',', '.').',-';
	}
	
	
	/**  	Untuk convert dari bantuk angka ke bentuk tulisan hari atau bulan
	
	**/
	function getDayName($id)
	{
		$weekdays = array( 7 => 'Minggu',
						   1 => 'Senin',
						   2 => 'Selasa',
						   3 => 'Rabu',
						   4 => 'Kamis',
						   5 => 'Jumat',
						   6 => 'Sabtu');
						 
		if (isset($weekdays[$id]))
			return $weekdays[$id];
		else
			return '';                         
	}

	function getMonthName($id)
	{
		$months = array( 1 => 'Januari',
						 2 => 'Februari',
						 3 => 'Maret',
						 4 => 'April',
						 5 => 'Mei',
						 6 => 'Juni',
						 7 => 'Juli',
						 8 => 'Agustus',
						 9 => 'September',
						 10 => 'Oktober',
						 11 => 'November',
						 12 => 'Desember');
						 
		if (isset ($months[$id]))
			return $months[$id];
		else
			return '';                         
	}

	function getMonthList()
	{
		$months = array( '01' => 'Januari',
						 '02' => 'Februari',
						 '03' => 'Maret',
						 '04' => 'April',
						 '05' => 'Mei',
						 '06' => 'Juni',
						 '07' => 'Juli',
						 '08' => 'Agustus',
						 '09' => 'September',
						 '10' => 'Oktober',
						 '11' => 'November',
						 '12' => 'Desember');
						 
		return $months;                         
	}
	
	function getMonthList2()
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
	
	function getMonthList3()
	{
		$months = array( '01' => 'Jan',
						 '02' => 'Feb',
						 '03' => 'Mar',
						 '04' => 'Apr',
						 '05' => 'Mei',
						 '06' => 'Juni',
						 '07' => 'Juli',
						 '08' => 'Ags',
						 '09' => 'Sep',
						 '10' => 'Okt',
						 '11' => 'Nov',
						 '12' => 'Des');
						 
		return $months;                         
	}
	
	function getMonthName2($id)
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
						 '12' => 'Desember',
						 '01' => 'Januari',
						 '02' => 'Februari',
						 '03' => 'Maret',
						 '04' => 'April',
						 '05' => 'Mei',
						 '06' => 'Juni',
						 '07' => 'Juli',
						 '08' => 'Agustus',
						 '09' => 'September',);
						 
		if (isset ($months[$id]))
			return $months[$id];
		else
			return '';                         
	}
		
	/**  	Mendapatkan tanggal sekarang
	
	**/
	function getCurrentDateFull()
	{
		$today 		= getdate(); 
		$month 		= $this->getMonthName($today['mon']);
		$weekday  	= $this->getDayName($today['wday']); 
		$monthday  	= $today['mday']; 
		$year  		= $today['year']; 
		
		return "$weekday $monthday $month $year";
	}
	
	function getCurrentDate(){
		$today 		= getdate(); 
		$month 		= $this->getMonthName($today['mon']);
		$weekday  	= $this->getDayName($today['wday']); 
		$monthday  	= $today['mday']; 
		$year  		= $today['year']; 
		
		return "$monthday $month $year";
	}
	
	/**  	error box
	
	**/
	function error($msg, $url)
	{
		echo '<body style="background-color:#fff"><div style="background-color:#FFE1E1; border:solid 1px #F00;padding:13px;
			  font-family: Tahoma, Arial, Helvetic, sans-serif;font-size: 12px;color:#ff0000; text-align:center">
			  <b>'.$msg.'</b><br /><br /><br />
			  <input type="button" value="kembali" onclick="window.location.href=\''.base_url().$url.'\'" /></div></body>';
		
		return false;	
	}
	
	function count_days( $a, $b )
	{
		// First we need to break these dates into their constituent parts:
		$gd_a = getdate( strtotime($a) );
		$gd_b = getdate( strtotime($b) );
		 
		// Now recreate these timestamps, based upon noon on each day
		// The specific time doesn't matter but it must be the same each day
		$a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
		$b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
		 
		// Subtract these two numbers and divide by the number of seconds in a
		// day. Round the result since crossing over a daylight savings time
		// barrier will cause this time to be off by an hour or two.
		return round( abs( $a_new - $b_new ) / 86400 );
	}
 
	/* 
	  filename without extension 
	  ex: file_core_name('toto.jpg') -> 'toto'
	*/
	function file_name($file_name)
	{
		$exploded = explode('.', $file_name);
 
		// if no extension
		if (count($exploded) == 1)
		{
			return $file_name;
		}
 
		// remove extension
		array_pop($exploded);
 
		return implode('.', $exploded);
	}
 
	/* 
	  file extension 
	  ex: file_extension('toto.jpg') -> 'jpg'
	*/
	function file_ext($path)
	{
		$extension = substr(strrchr($path, '.'), 1);
		return $extension;
	}
 
	/* 
	  file size 
	  ex: file_size('toto.jpg') -> '3.3 MB'
	*/
	function file_size($path)
	{
		if(file_exists($path))
		{
			$num = filesize($path);
		}
		else
		{
			$num = 0;	
		}
 
		// code from byte_format()
		$CI =& get_instance();
		$CI->lang->load('number');
 
		$decimals = 1;
 
		if ($num >= 1000000000000) 
		{
			$num = round($num / 1099511627776, 1);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000) 
		{
			$num = round($num / 1073741824, 1);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000) 
		{
			$num = round($num / 1048576, 1);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000) 
		{
			$decimals = 0; // decimals are not meaningful enough at this point
 
			$num = round($num / 1024, 1);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}
 
		$str = number_format($num, $decimals).' '.$unit;
 
		$str = str_replace(' ', '&nbsp;', $str);
		return $str;
	}
	
	function safe_unserialize($serialized) 
	{
		// unserialize will return false for object declared with small cap o
		// as well as if there is any ws between O and :
		if (is_string($serialized) && strpos($serialized, "\0") === false) {
			if (strpos($serialized, 'O:') === false) {
				// the easy case, nothing to worry about
				// let unserialize do the job
				return @unserialize($serialized);
			} else if (!preg_match('/(^|;|{|})O:[0-9]+:"/', $serialized)) {
				// in case we did have a string with O: in it,
				// but it was not a true serialized object
				return @unserialize($serialized);
			}
		}
		return array();
	}
	
	function randchr($length)
	{
		$validCharacters = 'ABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890';
		$validCharNumber = strlen($validCharacters);
	 
		$result = '';
	 
		for ($i = 0; $i < $length; $i++) {
			$index = mt_rand(0, $validCharNumber - 1);
			$result .= $validCharacters[$index];
		}
	 
		return $result;	
	}
	
	function randchr_time($length)
	{
		$str = microtime().'->'.rand();
		$str = md5($str);
		$str = substr($str, 0, $length);
	 
		return $str;	
	}
	
	function tokenizer($text)
	{
		$text = str_replace(array(".\n", ".\r"), "", strtolower($text));
		$array = explode(' ', $text);
		
		return $array;
	}
	
	function urlf($string) {
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
	
	function activemenu($menu)
	{
		$CI =& get_instance();
		
		$activemenu = $CI->router->fetch_class();
		$menu		= explode(';', $menu);
		
		if(in_array($activemenu, $menu))
			return 'active';
		else
			return '';
	}
	
	function fix_no_telp($telp)
	{
		$telp = trim(str_replace(array(' ', '-', '/', ')', '(', ']', '['), '', $telp));
		
		if(empty($telp) || $telp == 'null' || strlen($telp) <= 6) $no = '';
		else if(substr($telp, 0, 1) == '0') 	$no = '+62'.substr($telp, 1);
		else if(substr($telp, 0, 2) == '62') 	$no = '+62'.substr($telp, 2);
		else if(substr($telp, 0, 3) == '+62') 	$no = $telp;
		else if((int) substr($telp, 0, 1) != '0') 	$no = '+62'.$telp;
		else 									$no = '';
		
		return $no;
	}
	
	function sending($sys, $id, $no, $msg)
	{
		$CI 	=& get_instance();
		$host	= $CI->config->item('api_sms_url');
		$urldlr = 'http://'.$host.'/kannel/dlr.php?state=%d&app='.$sys.'&msgid='.$id;
		$url 	= 'http://'.$host.':13013/cgi-bin/sendsms?smsc=socsmsc&username=kanneluser&password=kanneluser&validity=360&to='.urlencode(trim($no)).'&text='.urlencode(trim($msg)).'&dlr-mask=24&dlr-url='.urlencode(trim($urldlr));
		
		return $this->curl_get($url);
	}
	
	function curl_post($url, $data)
	{	
		if(empty($url) OR empty($data))
		{
			return 'Error: invalid Url or Data';
		}
		
		//url-ify the data for the POST
		$fields_string = '';
		foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		$fields_string = rtrim($fields_string,'&');
		
		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($data));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10); # timeout after 10 seconds, you can increase it
		//curl_setopt($ch,CURLOPT_HEADER,false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  # Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); # Some server may refuse your request if you dont pass user agent
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		return $result;
	}
	
	function curl_get($url)
	{	
		if(empty($url))
		{
			return 'Error: invalid Url or Data';
		}
		
		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10); # timeout after 10 seconds, you can increase it
		//curl_setopt($ch,CURLOPT_HEADER,false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  # Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); # Some server may refuse your request if you dont pass user agent
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		return $result;
	}
	
	function sub($txt)
	{
		return str_replace('_', ' ', $txt);
	}
	
	function chkbox($name, $opt, $chk, $plus)
	{
		$html = '<div class="checkbox-list">';
        
		foreach($opt as $val => $txt)
		{
			$html .= '<label class="checkbox-inline col-md-3" style="margin-left:0px; padding-left:0px">
						<input type="checkbox" name="'.$name.'[]" value="'.$val.'"> '.$txt.'</label>';	
		}
        
		$html .= '</div>';
		
		return $html;
	}
	
	function chkbox2($name, $opt, $chk, $plus, $inp, $key)
	{
		$html = '<div class="checkbox-list">';
        if(empty($inp)) $inp = array();
		$i = 0;
		foreach($opt as $val => $txt)
		{
			$checked = array_key_exists($key, $inp) && in_array($val, $inp[$key]) ? 'checked="checked"':'';
			$html .= '<label class="checkbox-inline col-md-3" style="margin-left:0px; padding-left:0px">
						<input type="checkbox" name="'.$name.'[]" value="'.$val.'" '.$checked.'> '.$txt.'</label>';	
						
			$i++;
		}
        
		$html .= '</div>';
		
		return $html;
	}
}

?>