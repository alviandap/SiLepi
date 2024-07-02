<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include('crs_product.php');

class CRS_PRE extends CI_Driver
{
	function __construct()
	{
		//$this->CI =& get_instance();
	}

	function getAllProduct()
	{
		$product = $this->ontology->get_product();
		return $product;
	}

	function Recommend($usermodel, $pref)
	{
		$product = $this->ontology->get_product();
		$leaf	 = $this->_get_leaf($usermodel);
		$fs		 = $this->_get_status($leaf, 'fs');
		$fh		 = $this->_get_status($leaf, 'fh');

		$brand_os = $this->ontology->get_brand_os($pref);
		$type	  = $this->ontology->get_type($pref);

		$product_filtered1 = array_intersect($brand_os, $type);
		$product_filtered2 = array();
		//get suppf
		if (!empty($pref)) {
			foreach ($product as $prod) {
				if (in_array($prod->produk, $product_filtered1))
					$product_filtered2[] = array('produk' => $prod->produk, 'suppf' => $prod->suppf);
			}
		} else {
			foreach ($product as $prod) {
				$product_filtered2[] = array('produk' => $prod->produk, 'suppf' => $prod->suppf);
			}
		}

		//$a[0] = $product_filtered2[0];
		//$a[1] = $product_filtered2[1];

		$fh_result = $this->_fh($fh, $product_filtered2);
		$fs_result = $this->_fs($fs, $fh_result);

		return $fs_result;
	}

	function recommend_single($prod, $usermodel, $pref)
	{
		$leaf	 = $this->_get_leaf($usermodel);
		$fs		 = $this->_get_status($leaf, 'fs');
		$fh		 = $this->_get_status($leaf, 'fh');

		$fh_result = $this->_fh($fh, $prod);
		$fs_result = $this->_fs($fs, $fh_result);

		return $fs_result;
	}

	function explain($product, $usermodel, $pref)
	{
		$lastpref 	= $this->_get_last_pref($usermodel);
		//print_r($lastpref);
		//echo '<br><br>';
		$fr		= array();
		foreach ($lastpref as $lp) {
			$instance = $this->ontology->get_individu($lp['name']);

			if (!empty($instance))
				$fr[$lp['name']] = array('class' => true, 'child' => $instance);
			else
				$fr[$lp['name']] = array('class' => false);
		}
		//print_r($fr);
		//get type
		$this->CI->load->model('Common_Model');
		$type = $this->CI->Common_Model->type();
		$prod_type = array();
		foreach ($type as $id => $name) {
			$p = $this->ontology->has_type($id);
			$prod_type[$id] = $p;
		}

		foreach ($product as $id => $prod) {
			$os		= $this->ontology->has_os($prod['produk']);
			$price	= $this->ontology->has_price($prod['produk']);
			$detail	= $this->ontology->has_detail($prod['produk']);
			$type	= $this->_get_type($prod['produk'], $prod_type);
			$txt = 'Produk ' . str_replace('_', ' ', $prod['produk']) . ' adalah Laptop bertipe ' . $type . ' dengan harga ' . $this->_num2idr(isset($price[0]) ? $price[0] : 0) . ' . Yang mendukung kebutuhan seperti : <ul>';

			foreach ($fr as $fname => $f) {
				if ($f['class']) {
					// Check if 'suppfh' key exists in the $prod array
					if (isset($prod['suppfh']) && is_array($prod['suppfh'])) {
						$child = array_intersect($f['child'], $prod['suppfh']);

						if (!empty($child)) {
							$txt .= '<li>' . str_replace('_', ' ', implode(', ', $child)) . '</li>';
						}
					} else {
						// Handle the case when 'suppfh' is not defined or not an array
						// You can choose to skip this iteration or handle it differently.
						// Here, we'll skip it and continue with the next iteration.
						continue;
					}
				}
			}


			foreach ($fr as $fname => $f) {
				if (!$f['class']) {
					if (in_array($fname, $prod['suppfh']))
						$txt .= '<li>' . str_replace('_', ' ', $fname) . '</li>';/*'Mendukung kebutuhan '.*/
				}
			}

			/*if(!empty($prod['suppfs']))
			{
				foreach($prod['suppfs'] as $sfs)
					$txt .= '<li>Mendukung kebutuhan '.$sfs.'</li>';
			}*/
			//fs
			foreach ($fr as $fname => $f) {
				if ($f['class']) {
					$child = array_intersect($f['child'], $prod['suppfs']);

					if (!empty($child))
						$txt .= '<li>' . str_replace('_', ' ', implode(', ', $child)) . '</li>';
				}
			}

			foreach ($fr as $fname => $f) {
				if (!$f['class']) {
					if (in_array($fname, $prod['suppfs']))
						$txt .= '<li>' . str_replace('_', ' ', $fname) . '</li>';/*'Mendukung kebutuhan '.*/
				}
			}

			$product[$id]['explain'] = $txt . '</ul>';
			$product[$id]['details'] = $detail;
			$product[$id]['price'] = (isset($price[0]) ? $price[0] : 0);
		}
		/*echo '<pre>';
		print_r($product);
		echo '</pre>';*/
		return $this->_sort($product);
		/*echo '<pre>';
		print_r($product);
		echo '</pre>';*/
	}

	function recommendSR($pref, $pref2)
	{
		//get type
		$this->CI->load->model('Common_Model');
		$type = $this->CI->Common_Model->type();
		$prod_type = array();
		foreach ($type as $id => $name) {
			$p = $this->ontology->has_type($id);
			$prod_type[$id] = $p;
		}

		if (empty($pref)) {
			$product  = $this->ontology->get_product();
			$result   = array();
			foreach ($product as $prod) {
				$result[] = $prod->produk;
			}

			$brand_os = $this->ontology->get_brand_os($pref2);
			$type	  = $this->ontology->get_type($pref2);

			$result1 = array_intersect($brand_os, $type);

			if (!empty($result1))
				$result2 = array_intersect($result, $result1);
			else
				$result2 = array();

			$return = array();
			$id 	= 0;
			foreach ($result2 as $prod) {
				$return[$id]['produk'] 	= $prod;
				$return[$id]['detail']	= $this->ontology->has_detail($prod);
				$return[$id]['os']		= $os		= $this->ontology->has_os($prod);
				$return[$id]['price']	= $price	= $this->ontology->has_price($prod);
				$return[$id]['type']	= $type 	= $this->_get_type($prod, $prod_type);
				/*$return[$id]['explain'] = 'Produk '.str_replace('_', ' ', $prod).' adalah '.$type.' dengan harga '.$this->_num2idr(isset($price[0]) ? $price[0] : 0).' .';*/
				$return[$id]['explain'] = 'Harga ' . $this->_num2idr(isset($price[0]) ? $price[0] : 0);

				$id++;
			}
		} else {
			$brand_os = $this->ontology->get_brand_os($pref2);
			$type	  = $this->ontology->get_type($pref2);

			$result1 = array_intersect($brand_os, $type);
			$result2 = $this->ontology->get_by_sr($pref);
			$result3 = array_intersect($result1, $result2);

			$return = array();
			if (!empty($result3)) {
				$id = 0;
				foreach ($result3 as $prod) {
					$return[$id]['produk'] 	= $prod;
					$return[$id]['detail']	= $this->ontology->has_detail($prod);
					// $return[$id]['fork']	= $this->ontology->has_fork($prod);
					$return[$id]['os']		= $os		= $this->ontology->has_os($prod);
					$return[$id]['price']	= $price	= $this->ontology->has_price($prod);
					$return[$id]['type']	= $type 	= $this->_get_type($prod, $prod_type);
					/*$return[$id]['explain'] = 'Produk '.str_replace('_', ' ', $prod).' adalah '.$type.' dengan harga '.$this->_num2idr(isset($price[0]) ? $price[0] : 0).' .';*/
					$return[$id]['explain'] = 'Harga ' . $this->_num2idr(isset($price[0]) ? $price[0] : 0);

					$id++;
				}
			}
		}

		return $return;
	}

	function explainSR($result)
	{
		$return = array();
		if (!empty($result)) {
			//get type
			$this->CI->load->model('Common_Model');
			$type = $this->CI->Common_Model->type();
			$prod_type = array();
			foreach ($type as $id => $name) {
				$p = $this->ontology->has_type($id);
				$prod_type[$id] = $p;
			}

			$id = 0;
			foreach ($result as $prod) {
				$return[$id]['produk'] 	= $prod;
				$return[$id]['os']		= $this->ontology->has_os($prod);
				$return[$id]['price']	= $price	= $this->ontology->has_price($prod); /*ini*/
				$return[$id]['detail']	= $this->ontology->has_detail($prod);
				$return[$id]['type']	= $this->_get_type($prod, $prod_type);
				$return[$id]['explain'] = 'Harga ' . $this->_num2idr(isset($price[0]) ? $price[0] : 0); /*ini*/

				$id++;
			}
		}
		//print_r($return);

		return $return;
	}

	function _get_leaf($um)
	{
		$result = array();
		foreach ($um as $u)
			if ($u['leaf'])
				$result[] = $u;

		return $result;
	}

	function _get_status($um, $status)
	{
		$result = array();
		foreach ($um as $u)
			if ($u['status'] == $status)
				$result[] = $u['name'];

		return $result;
	}

	function _get_last_pref($um)
	{
		$result = array();
		foreach ($um as $u)
			if ($u['leaf'] && ($u['status'] == 'fh' || $u['status'] == 'fs'))
				$result[] = $u;

		return $result;
	}

	function _get_type($product, $array)
	{
		$result = '';
		foreach ($array as $type => $a) {
			if (in_array($product, $a)) {
				$result = $type;
				break;
			}
		}

		return $result;
	}

	function _fh($fh, $product)
	{
		$result = array();

		if (empty($fh)) {
			$result = $product;
		} else {
			foreach ($fh as $f) $instances[$f] = $this->ontology->get_individu($f);

			foreach ($product as $prod) {
				$sat = true;
				$tempfh = array();
				foreach ($fh as $f) {
					$instance = $instances[$f];
					if (empty($instance)) {
						$sat = $sat && (in_array($f, $prod['suppf']));

						if ($sat === true)
							$tempfh[] = $f;
					} else {
						$sattemp = false;
						foreach ($instance as $ins) {
							$adafh 	 = in_array($ins, $prod['suppf']);
							$sattemp = $sattemp || $adafh;

							if ($adafh === true)
								$tempfh[] = $ins;
						}

						$sat = $sat && $sattemp;
					}
				}

				if ($sat === true)
					$result[] = array('produk' => $prod['produk'], 'suppf' => $prod['suppf'], 'suppfh' => $tempfh);
			}
		}

		return $result;
	}

	function _fs($fs, $product)
	{
		if (!empty($fs)) {
			foreach ($fs as $f) $instances[$f] = $this->ontology->get_individu($f);

			foreach ($product as $id => $prod) {
				$tempfs = array();
				foreach ($fs as $f) {
					$instance = $instances[$f];
					if (empty($instance)) {
						if (in_array($f, $prod['suppf']))
							$tempfs[] = $f;
					} else {
						foreach ($instance as $ins) {
							if (in_array($ins, $prod['suppf']))
								$tempfs[] = $ins;
						}
					}
				}

				$product[$id]['suppfs'] = $tempfs;
				$product[$id]['utility'] = count($tempfs);
			}
		} else {
			foreach ($product as $id => $prod) {
				$product[$id]['suppfs'] = array();
				$product[$id]['utility'] = 0;
			}
		}

		return $product;
	}

	function _sort($data)
	{
		foreach ($data as $key => $row) {
			$utility[$key] = $row['utility'];
		}
		foreach ($data as $key => $row) {
			$price[$key] = $row['price'];
		}

		array_multisort($utility, SORT_DESC, $price, SORT_ASC, $data);
		return $data;
	}

	function _num2idr($number)
	{
		$number = floatval($number);
		return 'Rp. ' . number_format($number, 0, ',', '.') . ',-';
	}
}
