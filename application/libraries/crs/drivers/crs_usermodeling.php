<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRS_Usermodeling extends CI_Driver
{
	/*
	|--------------------------------------------------------------------------
	| Case U1 Function
	|--------------------------------------------------------------------------
	|
	*/
	function GenerateGeneralQ()
	{
		$fr 	= $this->ontology->get_fr();
		$alpha 	= $this->CI->config->item('alpha');
		$return	= array();
		
		for($i=1; $i<=$alpha; $i++)
		{
			$candidat = $fr[array_rand($fr)];
			if(!in_array($candidat, $return))
				$return[] = $candidat;
			else
				$i--;
		}
		
		$this->CI->session->set_userdata(array('usermodel' => array(), 'level' => 1));
		return $return;
	}
	
	/*
	|--------------------------------------------------------------------------
	| Case U2 Function
	|--------------------------------------------------------------------------
	|
	*/
	function GenerateDistinguishQ($product)
	{
		$allproduct = $this->ontology->get_product();
		$elmproduct = array();
		foreach($product as $prod)
		{
			//cari func
			foreach($allproduct as $aprod)
			{
				if($prod == $aprod->produk)
					$elmproduct[$prod]['suppf'] = $aprod->suppf;
			}
			//cari spec
			$elmproduct[$prod]['spec'] =  $this->ontology->SpecP($prod);
			
			//cari type
			$elmproduct[$prod]['tipe'] =  $this->ontology->lower_individu($prod);

			//cari price
			$elmproduct[$prod]['price'] = $this->ontology->has_price($prod);
		}
		
		//cari perbedaan func dan spec
		foreach($elmproduct as $nprod1 => $prod1)
		{
			$temp = array();
			foreach($elmproduct as $nprod2 => $prod2)
			{
				if($nprod1 != $nprod2)
					$temp = array_merge($temp, $prod2['suppf']);
				//$def = array_merge($def, array_merge(array_diff($prod1['suppf'], $prod2['suppf']), array_diff($prod2['suppf'], $prod1['suppf'])) );
				//$dec = array_merge($dec, array_merge(array_diff($prod1['spec'], $prod2['spec']), array_diff($prod2['spec'], $prod1['spec'])) );
			}
			
			/*echo '<pre>';
			print_r($prod1['suppf']);
			echo '</pre><br><br>';*/
			
			$def = array_diff($prod1['suppf'], $temp);
			if(!empty($def))
				$def = array_unique($def);
			
			$elmproduct[$nprod1]['def'] = $def;
			$elmproduct[$nprod1]['dec'] = $prod1['spec'];
			$elmproduct[$nprod1]['det'] = $prod1['tipe'];
			$elmproduct[$nprod1]['prc'] = $prod1['price'];
		}
		
		return $elmproduct;
	}
	
	/*
	|--------------------------------------------------------------------------
	| Case U3 Function
	|--------------------------------------------------------------------------
	|
	*/
	function GenerateUnExploredQ($usermodel)
	{
		$alpha 		= $this->CI->config->item('alpha');		
		$depth 		= $this->_get_depth($usermodel);			
		$candidat 	= $this->SearchCandidat($usermodel, $depth);
		
		if(!empty($candidat))
		{
			$question = $this->SelectQ($alpha, $candidat); //print_r($candidat); echo '<br><br>';print_r($question); echo '<br><br>';
			$expanded_nodes_u3 = $this->ontology->Parent($question);
			
			foreach($usermodel as $id => $um)
			{
				if(in_array($um['name'], $expanded_nodes_u3)) $usermodel[$id]['leaf'] = false;
			}
			
			$this->CI->session->set_userdata(array('usermodel' => $usermodel));
			//echo 'u3';
			return $question;
		}
		else
		{
			$this->CI->session->set_userdata(array('reset' => true));
			return $this->GenerateGeneralQ();
		}
	}
	
	function SearchCandidat($usermodel, $level)
	{
		if($level <= 1)
		{
			$n1 = $this->ontology->get_fr();
			
			$umlevel1 = array();
			foreach($usermodel as $um) 
				if($um['level'] == $level && ($um['status'] == 'fh' || $um['status'] == 'fs' || $um['status'] == 'fx')) 
					$umlevel1[] = $um['name'];
					
			//PotN = (node level 1)- (node level 1 yang status fh fs dan fx)
			$potn = array();
			foreach($n1 as $n)
				if(!in_array($n, $umlevel1))
					$potn[] = $n;
			
			$this->CI->session->set_userdata(array('level' => 1));
			return $potn;
		}
		else
		{
			$umlevelminus1 	= array();
			$umlevel	 	= array();
			foreach($usermodel as $um)
			{
				if($um['level'] == ($level-1) && ($um['status'] == 'fh' || $um['status'] == 'fs')) 
					$umlevelminus1[] = $um['name'];
					
				if($um['level'] == $level && ($um['status'] == 'fh' || $um['status'] == 'fs' || $um['status'] == 'fx')) 
					$umlevel[] = $um['name'];
			}
			//print_r($umlevelminus1); echo '<br><br>';
			//print_r($umlevel); echo '<br><br>';
			$upper = $this->ontology->Children($umlevelminus1);
			
			$potn = array();
			foreach($upper as $n)
				if(!in_array($n, $umlevel))
					$potn[] = $n;
					
					
			//print_r($upper); echo '<br><br>';
			//print_r($potn); echo '<br><br>';
					
			if(empty($potn))
			{
				//echo 'here empty '.$level;
				$this->SearchCandidat($usermodel, $level-1);
			}
			else
			{
				//echo 'here '.$level;
				$this->CI->session->set_userdata(array('level' => $level));
				return $potn;
			}
		}
	}
	/*
	|--------------------------------------------------------------------------
	| Case U4 Function
	|--------------------------------------------------------------------------
	|
	*/
	function GenerateSpecificQ($usermodel)
	{
		$alpha 		= $this->CI->config->item('alpha');
		$depth		= $this->_get_depth($usermodel);
		$lastpref	= $this->_get_depth_pref($usermodel, $depth);
		$candidat	= $this->ontology->Children($lastpref);
		
		if(!empty($candidat))
		{
			$question = $this->SelectQ($alpha, $candidat);
			$expanded_nodes_u4 = $this->ontology->Parent($question);
			
			foreach($usermodel as $id => $um)
			{
				if(in_array($um['name'], $expanded_nodes_u4)) $usermodel[$id]['leaf'] = false;
			}
			
			$this->CI->session->set_userdata(array('usermodel' => $usermodel, 'level' => $depth+1));
			
			return $question;
		}
		else
		{
			return $this->GenerateUnExploredQ($usermodel);
		}
	}
	
	/*
	|--------------------------------------------------------------------------
	| Case U5 Function
	|--------------------------------------------------------------------------
	|
	*/
	function GenerateContradictoryQ($usermodel, $pref)
	{
		$lastpref = $this->_get_last_pref($usermodel);
		$product  = array();
		
		$result['pref'] 	 = $pref;
		$result['usermodel'] = $lastpref;
		
		$find = false;
		$pref_shadow = $pref;
		while(!empty($pref_shadow) && empty($product))
		{
			$index = array_rand($pref_shadow, 1);
			$temp_pref  = $pref_shadow;
			
			unset($pref_shadow[$index]);
			
			$product = $this->_try_recommend($lastpref, $pref_shadow);
			
			if(!empty($product))
				$find = true;
		}
		
		if(!$find)
		{
			$lastpref_shadow = $lastpref;
			while(!empty($lastpref_shadow) && empty($product))
			{
				$index = array_rand($lastpref_shadow, 1);
				$temp_lastpref = $lastpref_shadow;
				
				unset($lastpref_shadow[$index]);
				
				$product = $this->_try_recommend($lastpref_shadow, $pref);
			}
			
			if(!empty($product))
				$find = true;
		}
		
		if(!$find)
		{		
			//generate array of pref and usermodel
			$all = array();
			$i	 = 0;
			foreach($lastpref as $id => $lp)
			{
				$all[$i] = array('tipe' => 'fh', 'nama' => $lp, 'index' => $id);
				$i++;
			}
			
			if((isset($pref['price']['start']) && !empty($pref['price']['start'])) && (isset($pref['price']['end']) && !empty($pref['price']['end'])))
			{
				$all[$i] = array('tipe' => 'price');
				$i++;
			}
			
			if(isset($pref['brand']) && count($pref['brand']) == 1)
			{
				$all[$i] = array('tipe' => 'brand', 'nama' => $pref['brand'][0]);
				$i++;
			}
			
			if(isset($pref['os']) && count($pref['os']) == 1)
			{
				$all[$i] = array('tipe' => 'os', 'nama' => $pref['os'][0]);
				$i++;
			}
			
			if(isset($pref['type']) && count($pref['type']) == 1)
			{
				$all[$i] = array('tipe' => 'type', 'nama' => $pref['type'][0]);
				$i++;
			}
			
			while(!empty($all) && empty($product))
			{
				$index = array_rand($all, 1);
				$temp_pref  	= $pref;
				$temp_lastpref  = $lastpref;
				
				if($all[$index]['tipe'] == 'fh')
					unset($lastpref[$all[$index]['index']]);
				else
					unset($pref[$all[$index]['tipe']]);
				
				unset($all[$index]);
				$product = $this->_try_recommend($lastpref, $pref);
			}
		}
		
		if(empty($temp_pref))
			$result['contra_pref'] = array();
		else
			$result['contra_pref'] = $temp_pref;
		
		if(empty($temp_lastpref))
			$result['contra_usermodel'] = array();
		else
			$result['contra_usermodel'] = $temp_lastpref;
		
		return $result;
		//print_r($lastpref);
		//$index = array_rand($lastpref, 1); print_r($index);
		/*while(!empty($lastpref) && empty($product))
		{
			$index = array_rand($lastpref, 1);
			$temp  = $lastpref;
			unset($lastpref[$index]);
			$product = $this->_try_recommend($lastpref, $pref);
		}
		$result['contra'] = $temp;
		
		return $result;*/
	}
	
	/*
	|--------------------------------------------------------------------------
	| Custom Function
	|--------------------------------------------------------------------------
	|
	*/	
	function SelectQ($alpha, $candidat)
	{
		//echo count($candidat).' -- '.$alpha.'<br><br>';
		if(count($candidat) > $alpha)
		{
			$list = array();
			for($i=1; $i<=$alpha; $i++)
			{
				$random = $candidat[array_rand($candidat)];
				if(!in_array($random, $list))
					$list[] = $random;
				else
					$i--;
			}
			
			return $list;
		}
		else return $candidat;
	}
	
	function _get_depth_pref($usermodel, $depth)
	{
		$result = array();
		foreach($usermodel as $um) 
			if($um['level'] == $depth && ($um['status'] == 'fh' || $um['status'] == 'fs')) 
				$result[] = $um['name'];
		
		return $result;
	}
	
	function _get_depth($usermodel)
	{
		$result = 0;
		foreach	($usermodel as $um)
			if($um['level'] > $result) $result = $um['level'];
		
		return $result;
	}	
	
	function _get_last_pref($usermodel)
	{
		$result = array();
		foreach($usermodel as $um) 
			if($um['leaf'] && $um['status'] == 'fh') 
				$result[] = $um['name'];
		
		return $result;
	}
	
	function _log($text)
	{
		$path = realpath(APPPATH.'../cdn');
		$file = $path.'/log.crs';
		
		file_put_contents($file, $text."\n", FILE_APPEND);
	}
	
	function _try_recommend($fh, $pref)
	{
		$product = $this->ontology->get_product();
		
		$brand_os = $this->ontology->get_brand_os($pref);
		$type	  = $this->ontology->get_type($pref);
		$product_filtered1 = array_intersect($brand_os, $type);
		$product_filtered2 = array();
		
		//get suppf
		if(!empty($pref))
		{
			foreach($product as $prod)
			{
				if(in_array($prod->produk, $product_filtered1))
					$product_filtered2[] = array('produk' => $prod->produk, 'suppf' => $prod->suppf);
			}
		}
		else
		{
			foreach($product as $prod)
			{
				$product_filtered2[] = array('produk' => $prod->produk, 'suppf' => $prod->suppf);
			}
		}
		
		$fh_result = $this->_fh($fh, $product_filtered2);
		
		return $fh_result;
	}
	
	function _fh($fh, $product)
	{
		$result = array();
		
		if(empty($fh))
		{
			$result = $product;	
		}
		else
		{
			foreach($fh as $f) $instances[$f] = $this->ontology->get_individu($f);
			
			foreach($product as $prod)
			{
				$sat = true;
				$tempfh = array();
				foreach($fh as $f)
				{
					$instance = $instances[$f];
					if(empty($instance))
					{
						$sat = $sat && (in_array($f, $prod['suppf']));
						
						if($sat === true)
							$tempfh[] = $f;
					}
					else
					{
						$sattemp = false;
						foreach($instance as $ins)
						{
							$adafh 	 = in_array($ins, $prod['suppf']);
							$sattemp = $sattemp || $adafh;
							
							if($adafh === true)
								$tempfh[] = $ins;
						}
						
						$sat = $sat && $sattemp;
					}
				}
			
				if($sat === true)
					$result[] = array('produk' => $prod['produk'], 'suppf' => $prod['suppf'], 'suppfh' => $tempfh);
			}
		}
		
		return $result;
	}
}

?>