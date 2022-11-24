<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('username')) {
			redirect('Auth');
		}

	}

	public function index()
	{
		
		$data["title"] = "Settings";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$getAdmin = $this->db->get_where('admin', ['level' => 'admin', 'username' => $sessU])->result_array();
		$data['jum'] = count($getAdmin);

		if ($sessL == 'admin') {
			$data['res'] = $this->db->get_where('admin', ['level' => 'admin', 'username' => $sessU])->result_array();
		} else {
			$data['res'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();
		}

		

		$this->load->view('templates/header',$data);
		$this->load->view('settings',$data);
		$this->load->view('templates/footer');
	}

	public function update(){
		$id			= $this->input->post('id');
		$nip 		= $this->input->post('nip');
		$nama		= $this->input->post('nama');
		$email		= $this->input->post('email');
		$username	= $this->input->post('username');
		$pass1		= $this->input->post('passlama');
		$pass2		= $this->input->post('passbaru');
		$upload_image = $_FILES['photo']['name'];


		if (isset($_POST['update'])) {

			if ($upload_image == "") {

				if ($pass1 == "" && $pass2 == "") {

					if (count($nip)>0) {
						$data = [
							'username' 	  => $username,
							'namalengkap' => $nama,
							'email'		  => $email					
						];

						$this->db->where('nip',$nip);
						$this->db->update('pegawai',$data);

						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "success",
								text: "Berhasil!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Home');
					} else {
						$data = [
							'username' 	  => $username,
							'namalengkap' => $nama,
							'email'		  => $email	
						];

						$this->db->where('idadmin',$id);
						$this->db->update('admin',$data);

						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "success",
								text: "Berhasil!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Home');
					}					
					
				} else {

					if ($pass1 == $pass2) {

						if (count($nip)>0) {
							$data = [
								'username' 	  => $username,
								'namalengkap' => $nama,
								'email'		  => $email,
								'password'	  => sha1($pass1)
							];

							$this->db->where('nip',$nip);
							$this->db->update('pegawai',$data);

							$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
								<script>
								swal({
									icon: "success",
									text: "Berhasil!",
									button: false,
									timer: 3000,
									});
									</script>');
							redirect('Home');
						} else {
							$data = [
								'username' 	  => $username,
								'namalengkap' => $nama,
								'email'		  => $email,
								'password'	  => sha1($pass1)
							];

							$this->db->where('idadmin',$id);
							$this->db->update('admin',$data);

							$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
								<script>
								swal({
									icon: "success",
									text: "Berhasil!",
									button: false,
									timer: 3000,
									});
									</script>');
							redirect('Home');
						}

					} else {
						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "error",
								text: "Password baru gagal konfirmasi!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Settings');
					}

				}
				
			} else {
				$this->load->library('image_lib');

				if ($upload_image) {
					$config['upload_path']   = './assets/img/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']      = '2048';
					$config['create_thumb']  = FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']       = '50%';
					$config['width']		 = 250;
					$config['height']		 = 250;
				}


				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('photo')) {
					$old_image = $data['admin']['photo'];
					if ($old_image != 'dummy.png') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}



				if ($pass1 == "" && $pass2 == "") {

					if (count($nip)>0) {
						$data = [
							'username' 	  => $username,
							'namalengkap' => $nama,
							'photo'		  => $new_image,
							'email'		  => $email					
						];

						$this->db->where('nip',$nip);
						$this->db->update('pegawai',$data);

						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "success",
								text: "Berhasil!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Home');
					} else {
						$data = [
							'username' 	  => $username,
							'namalengkap' => $nama,
							'photo'		  => $new_image,
							'email'		  => $email					
						];

						$this->db->where('idadmin',$id);
						$this->db->update('admin',$data);

						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "success",
								text: "Berhasil!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Home');
					}

				} else {

					if ($pass1 == $pass2) {

						if (count($nip)>0) {
							$data = [
								'username' 	  => $username,
								'namalengkap' => $nama,
								'email'		  => $email,
								'photo'		  => $new_image,
								'password'	  => sha1($pass1)
							];

							$this->db->where('nip',$nip);
							$this->db->update('pegawai',$data);

							$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
								<script>
								swal({
									icon: "success",
									text: "Berhasil!",
									button: false,
									timer: 3000,
									});
									</script>');

							redirect('Home');
						} else {
							$data = [
								'username' 	  => $username,
								'namalengkap' => $nama,
								'email'		  => $email,
								'photo'		  => $new_image,
								'password'	  => sha1($pass1)
							];

							$this->db->where('idadmin',$id);
							$this->db->update('admin',$data);

							$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
								<script>
								swal({
									icon: "success",
									text: "Berhasil!",
									button: false,
									timer: 3000,
									});
									</script>');

							redirect('Home');
						}

					} else {
						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "error",
								text: "Password baru gagal konfirmasi!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Settings');
					}

				}
			}

			
		} else {
			redirect('Home');
		}		
	}

}
