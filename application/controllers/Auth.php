<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		// CEK LOGIN / BLM
		if ($this->session->userdata('username')) {
			redirect('Home');
		} else {
			$data['title'] = "Login";

			$this->load->view('templates/header',$data);
			$this->load->view('page-login');
		}
		
	}


	public function verf(){
		// MENERIMA DATA
		$uname	 	= $this->input->post('uname');
		$pass 	 	= $this->input->post('pass');
		$passAcak	= sha1($this->input->post('pass'));
		// GET DATABASE
		$dataAdmin 	 = $this->db->get_where('admin', ['username' => $uname])->row_array();
		$dataPgw	 = $this->db->get_where('pegawai', ['username' => $uname])->row_array();


		if (count($dataAdmin) > 0) {

			if ($uname === $dataAdmin['username'] && $passAcak === $dataAdmin['password']) {
				// SESS
				$data = [
					'username' 	=> $uname,
					'level'     => $dataAdmin['level']
				];

				$this->session->set_userdata($data);

				redirect('Home');

			} else {
				$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script>
					swal({
						icon: "error",
						text: "Username atau Password salah!",
						button: false,
						timer: 3000,
						});
						</script>');

				redirect('Auth');
			}
			
		} else if (count($dataPgw > 0)) {

			if ($uname === $dataPgw['username'] && $passAcak === $dataPgw['password']) {
				// SESS
				$data = [
					'username' 	=> $uname
				];

				$this->session->set_userdata($data);

				redirect('Home');

			} else {
				$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script>
					swal({
						icon: "error",
						text: "Username atau Password salah!",
						button: false,
						timer: 3000,
						});
						</script>');

				redirect('Auth');
			}

		}

	}



	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
		
		redirect('Auth');
	}

}
