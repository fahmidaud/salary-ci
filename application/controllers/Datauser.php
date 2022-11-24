<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('username')) {
			redirect('Auth');
		}

	}

	public function data_admin()
	{
		$data['title'] = "Data Admin";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$data['admin'] = $this->db->get_where('admin', ['level' => 'admin'])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('data_admin',$data);
		$this->load->view('templates/footer');		

	}

	public function data_pegawai(){
		$data['title'] = "Data Pegawai";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}


		$sql = "SELECT *
		FROM pegawai 
		JOIN jabatan
		ON jabatan.kode_jabatan = pegawai.kode_jabatan
		JOIN golongan
		ON pegawai.kode_golongan = golongan.kode_golongan
		ORDER BY pegawai.nip
		";

		$data['pegawai'] = $this->db->query($sql)->result_array();
		$data['jabatan'] = $this->db->get('jabatan')->result_array();
		$data['golongan'] = $this->db->get('golongan')->result_array();
		$data['nama_peg'] = $this->db->get_where('pegawai',['username' => $sessU])->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('data_pegawai',$data);
		$this->load->view('templates/footer');
	}

	public function editAdmin(){
		$data["title"] = "Edit Admin";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$id = $this->input->post('id');

		$data['admin'] = $this->db->get_where('admin', ['idadmin' => $id])->result_array();

		if (isset($_POST['edit'])) {
			$this->load->view('templates/header',$data);
			$this->load->view('aksi/editAdmin',$data);
			$this->load->view('templates/footer');	
		} else if(isset($_POST['hapus'])){
			$this->db->where('idadmin',$id);
			$this->db->delete('admin');

			redirect('Datauser/data_admin');
		}		

	}


	public function updateAdmin(){
		// GET PW
		$sessU = $this->session->userdata('username');
		$getPW = $this->db->get_where('admin', ['username' => $sessU])->row_array();

		$id			= $this->input->post('id');
		$nama		= $this->input->post('nama');
		$email		= $this->input->post('email');
		$username	= $this->input->post('username');
		$pass1		= $this->input->post('passlama');
		$pass2		= $this->input->post('passbaru');
		$upload_image = $_FILES['photo']['name'];


		if (isset($_POST['update'])) {

			if (!$upload_image) {

				if ($pass1 == "" && $pass2 == "") {

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
							text: "Berhasil",
							button: false,
							timer: 3000,
							});
							</script>');

					redirect('Datauser/data_admin');

					
				} else {

					if ($pass1 == $pass2) {

						if ($jum > 1) {
							$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
								<script>
								swal({
									icon: "error",
									text: "Username Sudah Ada!",
									button: false,
									timer: 3000,
									});
									</script>');

							redirect('Datauser/data_admin');
							
						} else {
							$data = [
								'username' 	  => $username,
								'namalengkap' => $nama,
								'email'		  => $email,
								'password'	  => sha1($pass1)
							];

							$this->db->where('idadmin',$id);
							$this->db->update('admin',$data);

							redirect('Datauser/data_admin');
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

						redirect('Datauser/data_admin');
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

					if ($jum > 0) {
						$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
							<script>
							swal({
								icon: "error",
								text: "Username Sudah Ada!",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Datauser/data_admin');

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
								text: "Berhasil",
								button: false,
								timer: 3000,
								});
								</script>');

						redirect('Datauser/data_admin');
					}

				} else {

					if ($pass1 == $pass2) {

						if ($jum > 0) {
							$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
								<script>
								swal({
									icon: "error",
									text: "Username Sudah Ada!",
									button: false,
									timer: 3000,
									});
									</script>');

							redirect('Datauser/data_admin');
							
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
									text: "Berhasil",
									button: false,
									timer: 3000,
									});
									</script>');

							redirect('Datauser/data_admin');
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

						redirect('Datauser/data_admin');
					}

				}

			}
			
		} else {
			redirect('Datauser/data_admin');
		}

	}


	public function tambahAdmin(){
		$username = $this->input->post('username');

		$getU = $this->db->get_where('admin', ['username' => $username])->row_array();
		$jum = count($getU);

		$pass     = $this->input->post('pass');
		$passC	  = $this->input->post('passC');
		$nama 	  = $this->input->post('nama');
		$email 	  = $this->input->post('email');
		$level 	  = $this->input->post('level');
		$upload_image = $_FILES['photo']['name'];

		$this->load->library('image_lib');		

		if ($pass == $passC) {

			if ($jum > 0) {
				$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script>
					swal({
						icon: "error",
						text: "Username Sudah Ada!",
						button: false,
						timer: 3000,
						});
						</script>');

				redirect('Datauser/data_admin');
			} else {

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


					$data = [
						'username' 		=> $username,
						'password' 		=> sha1($pass),
						'namalengkap'	=> $nama,
						'photo' 		=> $new_image,
						'email'			=> $email,
						'level'			=> $level
					];

					$this->db->insert('admin',$data);

					$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
						<script>
						swal({
							icon: "success",
							text: "Berhasil",
							button: false,
							timer: 3000,
							});
							</script>');

					redirect('Datauser/data_admin');
				} else {
					echo $this->upload->display_errors();
				}

			}
		} else {
			$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script>
				swal({
					icon: "error",
					text: "Password tidak sama!",
					button: false,
					timer: 3000,
					});
					</script>');

			redirect('Datauser/data_admin');
		}
	}


	public function tambahPegawai(){
		$nip 	  = $this->input->post('nip');
		$nama 	  = $this->input->post('nama');
		$kode_jabatan 	  = $this->input->post('kode_jabatan');
		$kode_golongan 	  = $this->input->post('kode_golongan');
		$status 	  = $this->input->post('status');
		$jumlah_anak 	  = $this->input->post('jumlah_anak');
		$username = $this->input->post('username');

		$getP = $this->db->get_where('pegawai', ['username' => $username])->row_array();
		$jum = count($getP);

		$pass     = $this->input->post('pass');
		$passC	  = $this->input->post('passC');
		// $foto 	  = $this->input->post('foto');
		$email 	  = $this->input->post('email');
		$alamat   = $this->input->post('alamat');
		$notelp   = $this->input->post('notelp');
		$upload_image	= $_FILES['photo']['name'];

		if ($pass == $passC) {

			if ($jum > 0) {
				$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script>
					swal({
						icon: "error",
						text: "Username Sudah Ada!",
						button: false,
						timer: 3000,
						});
						</script>');

				redirect('Datauser/data_pegawai');
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

				$data = [
					'nip'			=> $nip,
					'namalengkap'	=> $nama,
					'kode_jabatan'	=> $kode_jabatan,
					'kode_golongan'	=> $kode_golongan,
					'status'		=> $status,
					'jumlah_anak'	=> $jumlah_anak,
					'username' 		=> $username,
					'password' 		=> sha1($pass),
					'photo' 		=> $new_image,
					'email'			=> $email,
					'bulan'			=> Date('m'),
					'tahun'			=> Date('Y'),
					'alamat'		=> $alamat,
					'notelp'		=> $notelp
				];

				$this->db->insert('pegawai',$data);

				$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script>
					swal({
						icon: "success",
						text: "Berhasil",
						button: false,
						timer: 3000,
						});
						</script>');

				redirect('Datauser/data_pegawai');
			}

		} else {
			$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script>
				swal({
					icon: "error",
					text: "Password tidak sama!",
					button: false,
					timer: 3000,
					});
					</script>');

			redirect('Datauser/data_pegawai');
		}		
		
	}


	public function editPegawai(){
		$data["title"] = "Edit Pegawai";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$nip = $this->input->post('nip');	

		$data['pegawai'] 	= $this->db->get_where('pegawai', ['nip' => $nip])->result_array();
		$data['golongan'] 	= $this->db->get('golongan')->result_array();

		if (isset($_POST['edit'])) {
			$this->load->view('templates/header',$data);
			$this->load->view('aksi/editPegawai',$data);
			$this->load->view('templates/footer');	
		} else if(isset($_POST['delete'])){
			$this->db->where('nip',$nip);
			$this->db->delete('pegawai');

			redirect('Datauser/data_pegawai');
		}		

	}

	public function updatePegawai(){
		$nip			= $this->input->post('nip');
		$nama			= $this->input->post('nama');
		$kode_jabatan 	= $this->input->post('kode_jabatan');
		$kode_golongan 	= $this->input->post('kode_golongan');
		$status 		= $this->input->post('status');
		$alamat 		= $this->input->post('alamat');
		$notelp 		= $this->input->post('notelp');
		$jumlah_anak 	= $this->input->post('jumlah_anak');
		$email			= $this->input->post('email');
		$username		= $this->input->post('username');
		$pass1			= $this->input->post('passlama');
		$pass2			= $this->input->post('passbaru');
		$upload_image	= $_FILES['photo']['name'];


		if (isset($_POST['update'])) {

			if (!$upload_image) {

				if ($pass1 == "" && $pass2 == "") {

					$data = [					
						'namalengkap' 	=> $nama,
						'kode_jabatan'	=> $kode_jabatan,
						'kode_golongan'	=> $kode_golongan,
						'status'		=> $status,
						'jumlah_anak'	=> $jumlah_anak,
						'username' 	 	=> $username,
						'email'		  	=> $email,
						'alamat'		=> $alamat,
						'notelp'		=> $notelp
					];

					$this->db->where('nip',$nip);
					$this->db->update('pegawai',$data);

					redirect('Datauser/data_pegawai');

				} else {

					if ($pass1 == $pass2) {

						$data = [
							'namalengkap' 	=> $nama,
							'kode_jabatan'	=> $kode_jabatan,
							'kode_golongan'	=> $kode_golongan,
							'status'		=> $status,
							'jumlah_anak'	=> $jumlah_anak,
							'username' 	  	=> $username,
							'email'		  	=> $email,	
							'password'	  	=> sha1($pass1),
							'alamat'		=> $alamat,
							'notelp'		=> $notelp
						];

						$this->db->where('nip',$nip);
						$this->db->update('pegawai',$data);

						redirect('Datauser/data_pegawai');

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

						redirect('Datauser/data_pegawai');
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

					$data = [					
						'namalengkap' 	=> $nama,
						'kode_jabatan'	=> $kode_jabatan,
						'kode_golongan'	=> $kode_golongan,
						'status'		=> $status,
						'jumlah_anak'	=> $jumlah_anak,
						'username' 	 	=> $username,
						'photo'		  	=> $new_image,
						'email'		  	=> $email,
						'alamat'		=> $alamat,
						'notelp'		=> $notelp		
					];

					$this->db->where('nip',$nip);
					$this->db->update('pegawai',$data);

					redirect('Datauser/data_pegawai');

				} else {

					if ($pass1 == $pass2) {

						$data = [
							'namalengkap' 	=> $nama,
							'kode_jabatan'	=> $kode_jabatan,
							'kode_golongan'	=> $kode_golongan,
							'status'		=> $status,
							'jumlah_anak'	=> $jumlah_anak,
							'username' 	  	=> $username,
							'photo'		  	=> $new_image,
							'email'		  	=> $email,	
							'password'	  	=> sha1($pass1),
							'alamat'		=> $alamat,
							'notelp'		=> $notelp
						];

						$this->db->where('nip',$nip);
						$this->db->update('pegawai',$data);

						redirect('Datauser/data_pegawai');

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

						redirect('Datauser/data_pegawai');
					}

				}

			}

		} else {
			redirect('Datauser/data_pegawai');
		}

	}


}
