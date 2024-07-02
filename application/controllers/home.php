<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_Model', 'User_Model', TRUE);
	}

	public function index()
	{
		// if ($this->session->userdata('login')) redirect('home/menu');

		$data['view'] 	= 'crs/_index';
		$data['title']	= 'Rekomendasi Berdasarkan Kebutuhan Fungsional';

		$this->load->view('tpl', $data);
	}

	public function start()
	{
		if (!$this->input->post('inp')) return false;

		$data = $this->input->post('inp');

		$id = $this->User_Model->add($data);

		$this->session->set_userdata(array('login' => true, 'iduser' => $id, 'nama' => $data['u_name'], 'data' => $data));

		redirect('home/menu');
	}

	public function menu()
	{
		if (!$this->session->userdata('login')) redirect('');

		$data['view'] 	= 'crs/_menu';
		$data['menu']	= false;
		$data['title']	= 'Rekomendasi Berdasarkan Kebutuhan Fungsional';

		$this->load->view('tpl', $data);
	}
}
