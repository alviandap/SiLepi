<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FR extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_Model', 'cm', TRUE);
		$this->load->model('User_Model', '', TRUE);
		$this->load->model('RatingModel', 'rating', TRUE);
		$this->load->model('Session_Model', 'ses', TRUE);
		$this->load->driver('Crs');
	}

	/*public function test()
	{
		print_r($this->crs->ontology->Type('Lenovo_IdeaTab_S6000'));	
	}*/

	public function index()
	{
		$data['view'] 	= 'fr/_index';
		$data['title']	= 'Rekomendasi Berdasarkan Kebutuhan Fungsional';

		$this->load->view('tpl', $data);
	}

	public function start()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('inp')) return false;

		$data = $this->input->post('inp');

		$id = $this->User_Model->add($data);

		$this->session->set_userdata(array('iduser' => $id));

		echo 'ok;';
	}


	public function ui_question_u1()
	{
		$data['brand']	= $this->cm->brand();
		//$data['os']		= $this->cm->os();
		$data['type']	= $this->cm->type();
		$data['fr'] 	= $this->crs->usermodeling->GenerateGeneralQ();

		echo $this->load->view('fr/_fr', $data, true);
	}

	public function ui_question_u4()
	{
		$usermodel	= $this->session->userdata('usermodel');
		$data['fr'] = $this->crs->usermodeling->GenerateSpecificQ($usermodel);
		$data['function'] = 'recommend';

		$this->session->set_userdata(array('uu' => 'u4'));

		echo $this->load->view('fr/_fr_no', $data, true);
	}

	public function ui_question_u2()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('product')) return false;

		$product 	= $this->input->post('product');
		$products 	= explode('||', $product);
		$data['result'] = $this->crs->usermodeling->GenerateDistinguishQ($products);

		// COBA save to db
		$iduser		= $this->session->userdata('iduser');
		foreach ($products as $prod) {
			$this->ses->adding($iduser, $prod, '', 'u2');
		}

		echo $this->load->view('fr/_u2', $data, true);
	}

	public function ui_question_u3()
	{
		$usermodel	= $this->session->userdata('usermodel');
		$data['fr'] = $this->crs->usermodeling->GenerateUnExploredQ($usermodel);
		$data['function'] = 'recommend';

		$this->session->set_userdata(array('uu' => 'u3'));

		echo $this->load->view('fr/_fr_no', $data, true);
	}

	public function ui_question_u5()
	{

		$usermodel	= $this->session->userdata('usermodel');
		$pref		= $this->session->userdata('pref');
		$data['result'] = $this->crs->usermodeling->GenerateContradictoryQ($usermodel, $pref);
		$data['brand']	= $this->cm->brand();
		// $data['os']		= $this->cm->os();
		$data['type']	= $this->cm->type();

		echo $this->load->view('fr/_u5', $data, true);
	}

	public function ui_recommend_u1()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('inp')) return false;


		$inp		= $this->input->post('inp');
		$usermodel 	= array();
		$usermodell 	= array();
		$pref		= array();
		$preff		= array();
		$iduser		= $this->session->userdata('iduser');

		foreach ($inp['usermodel'] as $name => $value) {
			$usermodel[] = array('name' => $name, 'level' => 1, 'status' => $value, 'leaf' => true);
			$usermodell[] = array('name' => $name, 'level' => 1, 'status' => $value === "fs" ? "fx" : "fs", 'leaf' => true);
		}

		if (!empty($inp['brand'])) 	$pref['brand'] = $inp['brand'];
		if (!empty($inp['os'])) 		$pref['os'] = $inp['os'];
		if (!empty($inp['type'])) 	$pref['type'] = $inp['type'];

		if (!empty($inp['price']['start']) && empty($inp['price']['end'])) {
			$pref['price']['start'] = (int) str_replace(array('.', '_'), '', $inp['price']['start']);
			$pref['price']['end'] 	= 30000000;
		} else if (empty($inp['price']['start']) && !empty($inp['price']['end'])) {
			$pref['price']['start'] = 0;
			$pref['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp['price']['end']);
		} else if (!empty($inp['price']['start']) && !empty($inp['price']['end'])) {
			$pref['price']['start'] = (int) str_replace(array('.', '_'), '', $inp['price']['start']);
			$pref['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp['price']['end']);
		}


		if (!empty($inp['brand'])) {
			$preff['brand'] = ["Acer", "Apple", "Asus", "Dell", "Hp", "Lenovo", "Microsoft", "Msi", "Samsung"];
			$preff['brand'] = array_diff($preff['brand'], $inp['brand']);
		} else {
			$preff['brand'] = ["Acer", "Apple", "Asus", "Dell", "Hp", "Lenovo", "Microsoft", "Msi", "Samsung"];
		}

		foreach ($usermodel as $um) {
			$this->ses->adding($iduser, $um["name"], $um["status"], 'u1');
		}

		$result = $this->crs->pre->Recommend($usermodel, $pref);
		$resultt = $this->crs->pre->Recommend($usermodell, $preff);

		// echo json_encode($usermodel);
		// die;

		$allProducts = $this->crs->pre->getAllProduct();

		if (empty($result)) {
			echo "error;;u5";
		} else if (!empty($result) && count($result) <= $this->config->item('limit_recommend')) {

			$data['result'] = $this->crs->pre->explain($result, $usermodel, $pref);
			$data['resultt'] = $this->crs->pre->explain($resultt, $usermodel, $preff);


			$produkArray = array();

			$allProdukArray = array();

			foreach ($data['result'] as $key => $res) {
				$produkArray[$key] = $res['produk'];
				$tamp[$key] = $res['produk'];
			}

			foreach ($allProducts as $key => $res) {
				$allProdukArray[$key] = $res->produk;
			}

			foreach ($data['result'] as $key => $res) {
				$data['result'][$key]['rating'] = $this->rating->get_rating($res['produk']);
				$data['result'][$key]['jmlhuser'] = $this->rating->get_user($res['produk']);
			}

			foreach ($data['resultt'] as $key => $res) {
				$data['resultt'][$key]['rating'] = $this->rating->get_rating($res['produk']);
				$data['resultt'][$key]['jmlhuser'] = $this->rating->get_user($res['produk']);
				$data['resultt'][$key]['mae'] = $this->rating->similarity($res['produk'], $allProdukArray, $iduser);
			}

			usort($data['resultt'], function ($a, $b) {
				return $b['mae'] - $a['mae'];
			});
			$data['resultt'] = array_slice($data['resultt'], 0, 3);
			usort($data['result'], function ($a, $b) {
				return $b['rating'] - $a['rating'];
			});

			$rating = $this->input->post('rating');
			if ($rating != 0)
				$data['result'] = array_filter($data['result'], function ($var) use ($rating) {
					return ($var['rating'] >= $rating);
				});

			echo $this->load->view('fr/_recommend', $data, true);
		} else if (!empty($result) && count($result) > $this->config->item('limit_recommend')) {
			echo "error;;produk yang sesuai sebanyak = " . count($result) . " produk\nJumlah produk yang sesuai masih terlalu banyak\nTekan ok untuk pertanyaan berikutnya yang lebih spesifik atau cancel untuk berhenti";
		}
	}

	public function ui_recommend()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('inp')) return false;

		$inp		= $this->input->post('inp');
		$usermodel 	= $this->session->userdata('usermodel');
		$level 		= $this->session->userdata('level');
		$pref		= $this->session->userdata('pref');
		$iduser		= $this->session->userdata('iduser');
		$uu			= $this->session->userdata('uu');

		foreach ($inp['usermodel'] as $name => $value) {
			$usermodel[] = array('name' => $name, 'level' => $level, 'status' => $value, 'leaf' => true);
		}

		$this->session->set_userdata(array('usermodel' => $usermodel));
		/*echo 'recommend<pre>';
		echo 'usermodel :';
		var_dump($usermodel);
		echo 'preferensi :';
		var_dump($pref);
		var_dump($level);
		echo '</pre>';*/

		$result = $this->crs->pre->Recommend($usermodel, $pref);

		if (empty($result)) {
			echo "error;;u5";
		} else if (!empty($result) && count($result) <= $this->config->item('limit_recommend')) {
			// COBA save to db
			if (!empty($inp['usermodel'])) {
				foreach ($inp['usermodel'] as $name => $value) {
					$this->ses->adding($iduser, $name, $value, 'uu');
				}
			}

			$data['result'] = $this->crs->pre->explain($result, $usermodel, $pref);
			//echo 'b';
			echo $this->load->view('fr/_recommend', $data, true);
		} else if (!empty($result) && count($result) > $this->config->item('limit_recommend')) {
			// COBA save to db uu -> u4
			if (!empty($inp['usermodel'])) {
				foreach ($inp['usermodel'] as $name => $value) {
					$this->ses->adding($iduser, $name, $value, 'u4');
				}
			}

			echo "error;;produk yang sesuai sebanyak = " . count($result) . " produk\nJumlah produk yang sesuai masih terlalu banyak\nTekan ok untuk pertanyaan berikutnya yang lebih spesifik atau cancel untuk berhenti";
		}
	}

	public function ui_recommend_u5()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('inp')) return false;

		$inp		= $this->input->post('inp');
		$usermodel 	= $this->session->userdata('usermodel');
		$level 		= $this->session->userdata('level');
		$pref		= $this->session->userdata('pref');
		$iduser		= $this->session->userdata('iduser');
		//var_dump($usermodel);

		if (!empty($inp['usermodel'])) {
			foreach ($inp['usermodel'] as $name => $value) {
				foreach ($usermodel as $id => $um) {
					if ($name == $um['name'])
						$usermodel[$id]['status'] = $value;
				}
			}
			$this->session->set_userdata(array('usermodel' => $usermodel));
		} else {
			//save to db
			$this->ses->adding($iduser, '', '', 'u5');
		}

		if (!empty($inp['chk_pref'])) {
			foreach ($inp['chk_pref'] as $p)
				$pref[$p] = isset($inp[$p]) ? $inp[$p] : array();

			$this->session->set_userdata(array('pref' => $pref));
		}

		if (!empty($inp['price'])) {
			if (!empty($inp['price']['start']) && empty($inp['price']['end'])) {
				$pref['price']['start'] = (int) str_replace(array('.', '_'), '', $inp['price']['start']);
				$pref['price']['end'] 	= 30000000;
			} else if (empty($inp['price']['start']) && !empty($inp['price']['end'])) {
				$pref['price']['start'] = 0;
				$pref['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp['price']['end']);
			} else if (!empty($inp['price']['start']) && !empty($inp['price']['end'])) {
				$pref['price']['start'] = (int) str_replace(array('.', '_'), '', $inp['price']['start']);
				$pref['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp['price']['end']);
			}

			$this->session->set_userdata(array('pref' => $pref));
		}

		/*echo 'recommend5<pre>';
		echo 'usermodel :';
		var_dump($usermodel);
		echo 'preferensi :';
		var_dump($pref);
		echo '</pre>';*/

		$result = $this->crs->pre->Recommend($usermodel, $pref);

		if (empty($result)) {
			echo "error;;u5";
		} else if (!empty($result) && count($result) <= $this->config->item('limit_recommend')) {
			// COBA save to db
			if (!empty($inp['usermodel'])) {
				foreach ($inp['usermodel'] as $name => $value) {
					$this->ses->adding($iduser, $name, $value, 'uu');
				}
			}

			$data['result'] = $this->crs->pre->explain($result, $usermodel, $pref);
			//echo 'c';
			echo $this->load->view('fr/_recommend', $data, true);
		} else if (!empty($result) && count($result) > $this->config->item('limit_recommend')) {
			// COBA save to db uu -> u4
			if (!empty($inp['usermodel'])) {
				foreach ($inp['usermodel'] as $name => $value) {
					$this->ses->adding($iduser, $name, $value, 'u4');
				}
			}

			echo "error;;produk yang sesuai sebanyak = " . count($result) . " produk\nJumlah produk yang sesuai masih terlalu banyak\nTekan ok untuk pertanyaan berikutnya yang lebih spesifik atau cancel untuk berhenti";
		}
	}

	public function ui_choose()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('prod')) return false;

		$inp 	 = $this->input->post('prod');
		$product = $this->crs->ontology->get_product();
		$result  = array();

		$usermodel 	= $this->session->userdata('usermodel');
		$level 		= $this->session->userdata('level');
		$pref		= $this->session->userdata('pref');
		$iduser		= $this->session->userdata('iduser');

		foreach ($product as $prod) {
			if ($prod->produk == $inp) {
				$result[] = array('produk' => $prod->produk, 'suppf' => $prod->suppf);

				//save to db
				$this->ses->adding($iduser, $prod->produk, '', 'choose');
			}
		}

		$resultx = $this->crs->pre->recommend_single($result, $usermodel, $pref);

		if (!empty($result)) {
			$data['result'] = $this->crs->pre->explain($resultx, $usermodel, $pref);
			foreach ($data['result'] as $key => $res) {
				$data['result'][$key]['rating'] = $this->rating->get_rating($res['produk']);
				$data['result'][$key]['is_rated'] = $this->rating->is_rated($res['produk'], $iduser);
			}
		} else $data['result'] = array();

		echo $this->load->view('fr/_choose', $data, true);
	}

	public function ui_recommend_u3()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('inp')) return false;

		$inp		= $this->input->post('inp');
		$usermodel 	= $this->session->userdata('usermodel');
		$level 		= $this->session->userdata('level');
		$pref		= array();

		foreach ($inp['usermodel'] as $name => $value)
			$usermodel[] = array('name' => $name, 'level' => $level, 'status' => $value, 'leaf' => true);

		$this->session->set_userdata(array('usermodel' => $usermodel));
		echo '<pre>';
		var_dump($usermodel);
		echo '</pre>';
		$result = $this->crs->pre->Recommend($usermodel, $pref);

		if (count($result) <= $this->config->item('limit_recommend')) {
			$data['result'] = $this->crs->pre->explain($result, $usermodel, $pref);
			echo $this->load->view('fr/_recommend', $data, true);
		} else {
			echo "error;;produk yang sesuai sebanyak = " . count($result) . " produk\nJumlah produk masih terlalu banyak\nTekan ok untuk memasukkan kebutuhan yang lebih spesifik atau cancel untuk berhenti";
		}
	}

	// input ke PHP
	public function give_rating()
	{
		if (!$this->input->is_ajax_request()) return false;
		if (!$this->input->post('rating')) return false;
		if (!$this->input->post('product')) return false;

		$rating = $this->input->post('rating');
		$product = $this->input->post('product');
		$iduser		= $this->session->userdata('iduser');

		$this->rating->give_rating($product, $iduser, $rating);

		echo 'ok';
	}
}
