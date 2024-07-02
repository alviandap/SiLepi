<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SR extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_Model', 'cm', TRUE);
		$this->load->model('User_Model', '', TRUE);
		$this->load->model('Session_Model', 'ses', TRUE);
		$this->load->driver('crs');
	}
	
	/*public function index()
	{
		$data['view'] 	= 'sr/_index';
		$data['title']	= 'Rekomendasi Berdasarkan Kebutuhan Spesifikasi Teknis';
		
		$this->load->view('tpl', $data);
	}
	
	public function start()
	{
		if(!$this->input->is_ajax_request()) return false;
		if(!$this->input->post('inp')) return false;
		
		$data = $this->input->post('inp');
		
		$id = $this->User_Model->add($data);
		
		$this->session->set_userdata(array('iduser' => $id));
		
		echo 'ok;';
	}*/
	
	public function ui_question()
	{
		$data['brand']	= $this->cm->brand();
		$data['os']		= $this->cm->os();
		$data['type']	= $this->cm->type();
		
		$data['screen_technology']	= $this->cm->screen_technology();
		$data['screen_resolution']	= $this->cm->screen_resolution();
		$data['processor']			= $this->cm->processor();
		$data['ram'] 				= $this->cm->ram();
		$data['primary_camera'] 	= $this->cm->primary_camera();
		$data['secondary_camera'] 	= $this->cm->secondary_camera();
		$data['internal_memmory'] 	= $this->cm->internal_memmory();
		$data['video_record'] 		= $this->cm->video_record();
		$data['screen_size'] 		= $this->cm->screen_size();
		$data['battery_capacity'] 	= $this->cm->battery_capacity();
		
		echo $this->load->view('sr/_question_', $data, true);
	}
	
	public function ui_question2()
	{
		$data['brand']	= $this->cm->brand();
		$data['os']		= $this->cm->os();
		$data['type']	= $this->cm->type();
		
		$data['screen_technology']	= $this->cm->screen_technology();
		$data['screen_resolution']	= $this->cm->screen_resolution();
		$data['processor']			= $this->cm->processor();
		$data['ram'] 				= $this->cm->ram();
		$data['primary_camera'] 	= $this->cm->primary_camera();
		$data['secondary_camera'] 	= $this->cm->secondary_camera();
		$data['internal_memmory'] 	= $this->cm->internal_memmory();
		$data['video_record'] 		= $this->cm->video_record();
		$data['screen_size'] 		= $this->cm->screen_size();
		$data['battery_capacity'] 	= $this->cm->battery_capacity();
		
		echo $this->load->view('sr/_question_2', $data, true);
	}
	
	public function ui_recommend()
	{
		if(!$this->input->is_ajax_request()) return false;
		
		$inp	= $this->input->post('inp');
		$inp2	= $this->input->post('inp2');
		
		if(!empty($inp2['price']['start']) && empty($inp2['price']['end']))
		{
			$inp2['price']['start'] = (int) str_replace(array('.', '_'), '', $inp2['price']['start']);
			$inp2['price']['end'] 	= 30000000;
		}
		else if(empty($inp2['price']['start']) && !empty($inp2['price']['end']))
		{
			$inp2['price']['start'] = 0;
			$inp2['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp2['price']['end']);
		}
		else if(!empty($inp2['price']['start']) && !empty($inp2['price']['end']))
		{
			$inp2['price']['start'] = (int) str_replace(array('.', '_'), '', $inp2['price']['start']);
			$inp2['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp2['price']['end']);
		}
		
		$data['brand']	= $this->cm->brand();
		$data['os']		= $this->cm->os();
		$data['type']	= $this->cm->type();
		
		$data['screen_technology']	= $this->cm->screen_technology();
		$data['screen_resolution']	= $this->cm->screen_resolution();
		$data['processor']			= $this->cm->processor();
		$data['ram'] 				= $this->cm->ram();
		$data['primary_camera'] 	= $this->cm->primary_camera();
		$data['secondary_camera'] 	= $this->cm->secondary_camera();
		$data['internal_memmory'] 	= $this->cm->internal_memmory();
		$data['video_record'] 		= $this->cm->video_record();
		$data['screen_size'] 		= $this->cm->screen_size();
		$data['battery_capacity'] 	= $this->cm->battery_capacity();

		$data['inp'] = $inp;
		$data['inp2'] = $inp2;
		$data['result'] = $this->crs->pre->RecommendSR($inp, $inp2);
		
		
		
		//$data['result'] = $this->crs->pre->explain($result, $usermodel, $pref);
		echo $this->load->view('sr/_recommend', $data, true);
	}
	
	public function ui_qsr_u3()
	{
		if(!$this->input->is_ajax_request()) return false;
		
		$inp	= $this->input->post('inp');
		$inp2	= $this->input->post('inp2');
		
		if(!empty($inp2['price']['start']) && empty($inp2['price']['end']))
		{
			$inp2['price']['start'] = (int) str_replace(array('.', '_'), '', $inp2['price']['start']);
			$inp2['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp2['price']['end']);
		}
		else if(empty($inp2['price']['start']) && !empty($inp2['price']['end']))
		{
			$inp2['price']['start'] = 0;
			$inp2['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp2['price']['end']);
		}
		else if(!empty($inp2['price']['start']) && !empty($inp2['price']['end']))
		{
			$inp2['price']['start'] = (int) str_replace(array('.', '_'), '', $inp2['price']['start']);
			$inp2['price']['end'] 	= (int) str_replace(array('.', '_'), '', $inp2['price']['end']);
		}
		
		$data['brand']	= $this->cm->brand();
		$data['os']		= $this->cm->os();
		$data['type']	= $this->cm->type();
		
		$data['screen_technology']	= $this->cm->screen_technology();
		$data['screen_resolution']	= $this->cm->screen_resolution();
		$data['processor']			= $this->cm->processor();
		$data['ram'] 				= $this->cm->ram();
		$data['primary_camera'] 	= $this->cm->primary_camera();
		$data['secondary_camera'] 	= $this->cm->secondary_camera();
		$data['internal_memmory'] 	= $this->cm->internal_memmory();
		$data['video_record'] 		= $this->cm->video_record();
		$data['screen_size'] 		= $this->cm->screen_size();
		$data['battery_capacity'] 	= $this->cm->battery_capacity();

		$data['inp'] = $inp;
		$data['inp2'] = $inp2;
		$data['result'] = $this->crs->pre->RecommendSR($inp, $inp2);
		
		//$data['result'] = $this->crs->pre->explain($result, $usermodel, $pref);
		echo $this->load->view('sr/_question_2', $data, true);
	}
	
	public function ui_choose()
	{
		if(!$this->input->is_ajax_request()) return false;
		if(!$this->input->post('prod')) return false;
		
		$inp 	 = $this->input->post('prod');
		$result	 = explode('||', $inp);
		
		if(!empty($result))
			$data['result'] = $this->crs->pre->explainSR($result);
		else
			$data['result'] = array();
		
		echo $this->load->view('sr/_choose', $data, true);
	}
}

?>