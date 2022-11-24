<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('username')) {
			redirect('Auth');
		}

	}

	public function index()
	{

		// CEK LOGIN / BLM
		if ($this->session->userdata('username')) {
			
			$data['title'] 	 = "Dashboard";

			$sessU = $this->session->userdata('username');
			$sessL = $this->session->userdata('level');

			if ($sessL === "admin") {
				$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
			} else {
				$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
			}

			$this->load->view('templates/header',$data);
			$this->load->view('index',$data);
			$this->load->view('templates/footer');
			
		} else {
			$data['title'] = "Login";

			$this->load->view('templates/header',$data);
			$this->load->view('page-login');
		}
		
	}

}
