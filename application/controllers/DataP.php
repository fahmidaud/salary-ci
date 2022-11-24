<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataP extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->session->userdata('username')) {
			redirect('Auth');
		}

	}

	public function data_jabatan()
	{
		$data["title"] = "Data Jabatan";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$data['jabatan'] = $this->db->get('jabatan')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('data_jabatan',$data);
		$this->load->view('templates/footer');
	}

	public function data_golongan(){
		$data["title"] = "Data Golongan";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$data['golongan'] = $this->db->get('golongan')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('data_golongan',$data);
		$this->load->view('templates/footer');
	}

	public function data_kehadiran(){
		$data["title"] = "Data Kehadiran";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		// PEGAWAI PAGE
		$getNIP = $this->db->get_where('pegawai',['username' => $sessU])->row_array();

		$sql = "SELECT master_gaji.*, pegawai.namalengkap, pegawai.kode_jabatan,
		jabatan.nama_jabatan 
		FROM master_gaji
		INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
		INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
		WHERE master_gaji.nip = '$getNIP[nip]'
		ORDER BY master_gaji.bulan DESC";

		$data['kehadiranP'] = $this->db->query($sql)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('data_khadiran',$data);
		$this->load->view('templates/footer');
	}

	public function iseng(){
		$ketik = $this->input->post('masukiki');
		echo json_encode($ketik);
	}

	public function addKehadiran(){
		$data["title"] = "Data Kehadiran";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		// MENAMPILKAN NIP DAN NAMA
		$sql = "SELECT * FROM pegawai";

		$data['pegawai'] = $this->db->query($sql)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('aksi/addKehadiran',$data);
		$this->load->view('templates/footer');

		// $data['pegawai'] = $this->db->get('pegawai')->result_array();

		// tambah
		if (isset($_POST['tambah'])) {
			$bulan 		= $this->input->post('bulan');
			$tahun 		= $this->input->post('tahun');
			$nip 		= $this->input->post('nip');
			$masuk 		= $this->input->post('masuk');
			$sakit 		= $this->input->post('sakit');
			$izin 		= $this->input->post('izin');
			$alpha 		= $this->input->post('alpha');
			$lembur 	= $this->input->post('lembur');
			$potongan 	= $this->input->post('potongan');

			$index = count($nip);


			if ($bulan == 02) {
				$max = 28;
			}else{
				$max = 30;
			}

			for ($i=0; $i < $index; $i++) { 
				$total = $masuk[$i] + $sakit[$i] + $izin[$i] + $alpha[$i];
				if ($masuk[$i] > $max || $sakit[$i] > $max || $izin[$i] > $max || $alpha[$i] > $max || $total > $max) {
					$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
						<script>
						swal({
							icon: "error",
							text: "Masukkan Data Dengan Benar",
							button: false,
							timer: 3000,
							});
							</script>');

					redirect('DataP/addKehadiran');
				} else {

					for ($i=0; $i<$index; $i++) { 

						$sqlPeg = "SELECT pegawai.jumlah_anak, pegawai.status AS status, CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max,
						golongan.tunjangan_suami_istri AS tjsi, golongan.tunjangan_anak AS tjanak, golongan.uang_makan AS uangmakan, golongan.uang_lembur AS uanglembur, golongan.asuransi_kesehatan AS asuransi_kesehatan,
						jabatan.gaji_pokok AS gaji_pokok, jabatan.tunjangan_jabatan AS tjjabatan, jabatan.potongan_sakit, jabatan.potongan_izin, jabatan.potongan_alpha
						FROM pegawai 
						INNER JOIN golongan 
						ON golongan.kode_golongan = pegawai.kode_golongan 
						INNER JOIN jabatan  
						ON jabatan.kode_jabatan   = pegawai.kode_jabatan 
						WHERE pegawai.nip = '$nip[$i]'";

						$d = $this->db->query($sqlPeg)->row_array();

						if($d['status'] != "Menikah"){
							$d['tjsi'] = 0;
						}

						$potongan_sakit = $sakit[$i] * $d['potongan_sakit'];
						$potongan_izin  = $izin[$i] * $d['potongan_izin'];
						$potongan_alpha = $alpha[$i] * $d['potongan_alpha'];
						$potongan_ketidakhadiran = $potongan_sakit + $potongan_izin + $potongan_alpha;

						$tjanak = $d['tjanak'] * $d['jmlanak_max'];
						$uanglembur = $d['uanglembur'] * $lembur[$i];

						if ($masuk[$i] != 0) {
							$pendapatan = $d['gaji_pokok'] + $d['tjjabatan'] + $d['tjsi'] + $tjanak + $d['uangmakan'] + $uanglembur + $d['asuransi_kesehatan'];    
						}else{
							$pendapatan = 0;
						}

						$totalgaji = ($pendapatan - $potongan[$i]) - $potongan_ketidakhadiran;

						if ($totalgaji < 0) {
							$totalgaji = 0;
						}

						$data = [
							'bulan' => $bulan,
							'tahun' => $tahun,
							'nip'	=> $nip[$i],
							'masuk'	=> $masuk[$i],
							'sakit'	=> $sakit[$i],
							'izin'	=> $izin[$i],
							'alpha'	=> $alpha[$i],
							'lembur' => $lembur[$i],
							'uang_lembur' => $uanglembur,
							'potongan'	=> $potongan[$i],
							'potongan_sakit' => $potongan_sakit,
							'potongan_izin'	=> $potongan_izin,
							'potongan_alpha'	=> $potongan_alpha,
							'pendapatan'	=> $pendapatan,
							'total_gaji'	=> $totalgaji
						];

						$this->db->insert('master_gaji',$data);
					}			

					$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
						<script>
						swal({
							icon: "success",
							text: "Berhasil",
							button: false,
							timer: 3000,
							});
							</script>');

					redirect('DataP/data_kehadiran');

				}
			}
			
		} else if(isset($_POST['close'])) {
			redirect('DataP/data_kehadiran');
		}
		
	}


	public function editKehadiran(){
		$data["title"] = "Edit Kehadiran";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$nip = $this->input->post('nip');

		$sql = "SELECT master_gaji.*, pegawai.namalengkap, jabatan.nama_jabatan 
		FROM master_gaji
		INNER JOIN pegawai ON master_gaji.nip = pegawai.nip
		INNER JOIN jabatan ON pegawai.kode_jabatan = jabatan.kode_jabatan
		WHERE master_gaji.bulan='$bulan' 
		AND master_gaji.tahun='$tahun' 
		AND master_gaji.nip = '$nip'
		ORDER BY master_gaji.nip ASC";

		$data['editK'] = $this->db->query($sql)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('aksi/editKehadiran',$data);
		$this->load->view('templates/footer');
	}

	public function updateKehadiran(){
		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');
		$nip 		= $this->input->post('nip');
		$masuk 		= $this->input->post('masuk');
		$sakit 		= $this->input->post('sakit');
		$izin 		= $this->input->post('izin');
		$alpha 		= $this->input->post('alpha');
		$lembur 	= $this->input->post('lembur');
		$potongan 	= $this->input->post('potongan');

		$index = count($nip);

		if ($bulan == 02) {
			$max = 28;
		}else{
			$max = 30;
		}

		$total = $masuk + $sakit + $izin + $alpha;
		if ($masuk > $max || $sakit > $max || $izin > $max || $alpha > $max || $total > $max) {
			$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script>
				swal({
					icon: "error",
					text: "Masukkan Data Dengan Benar",
					button: false,
					timer: 3000,
					});
					</script>');

			redirect('DataP/editKehadiran');
		} else {

			$sqlPeg = "SELECT pegawai.jumlah_anak, pegawai.status AS status, CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max,
			golongan.tunjangan_suami_istri AS tjsi, golongan.tunjangan_anak AS tjanak, golongan.uang_makan AS uangmakan, golongan.uang_lembur AS uanglembur, golongan.asuransi_kesehatan AS asuransi_kesehatan,
			jabatan.gaji_pokok AS gaji_pokok, jabatan.tunjangan_jabatan AS tjjabatan, jabatan.potongan_sakit, jabatan.potongan_izin, jabatan.potongan_alpha
			FROM pegawai 
			INNER JOIN golongan 
			ON golongan.kode_golongan = pegawai.kode_golongan 
			INNER JOIN jabatan  
			ON jabatan.kode_jabatan   = pegawai.kode_jabatan 
			WHERE pegawai.nip = '$nip'";

			$d = $this->db->query($sqlPeg)->row_array();

			if($d['status'] != "Menikah"){
				$d['tjsi'] = 0;
			}

			$potongan_sakit = $sakit * $d['potongan_sakit'];
			$potongan_izin  = $izin * $d['potongan_izin'];
			$potongan_alpha = $alpha * $d['potongan_alpha'];
			$potongan_ketidakhadiran = $potongan_sakit + $potongan_izin + $potongan_alpha;

			$tjanak = $d['tjanak'] * $d['jmlanak_max'];
			$uanglembur = $d['uanglembur'] * $lembur;

			if ($masuk[$i] != 0) {
				$pendapatan = $d['gaji_pokok'] + $d['tjjabatan'] + $d['tjsi'] + $tjanak + $d['uangmakan'] + $uanglembur + $d['asuransi_kesehatan'];    
			}else{
				$pendapatan = 0;
			}

			$totalgaji = ($pendapatan - $potongan) - $potongan_ketidakhadiran;

			if ($totalgaji < 0) {
				$totalgaji = 0;
			}

			$data = [
				'bulan' => $bulan,
				'tahun' => $tahun,
				'nip'	=> $nip,
				'masuk'	=> $masuk,
				'sakit'	=> $sakit,
				'izin'	=> $izin,
				'alpha'	=> $alpha,
				'lembur' => $lembur,
				'uang_lembur' => $uanglembur,
				'potongan'	=> $potongan,
				'potongan_sakit' => $potongan_sakit,
				'potongan_izin'	=> $potongan_izin,
				'potongan_alpha'	=> $potongan_alpha,
				'pendapatan'	=> $pendapatan,
				'total_gaji'	=> $totalgaji
			];

			$array = array('nip' => $nip, 'bulan' => $bulan, 'tahun' => $tahun);
			$this->db->where($array);
			$this->db->update('master_gaji',$data);


			$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script>
				swal({
					icon: "success",
					text: "Berhasil",
					button: false,
					timer: 3000,
					});
					</script>');

			redirect('DataP/data_kehadiran');

		}
		
		
	}






	public function data_penggajian(){
		$data["title"] = "Data Penggajian";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}


		if (isset($_POST['tampil'])) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');

			$sql = "SELECT * FROM master_gaji
			JOIN pegawai
			ON pegawai.nip = master_gaji.nip
			JOIN jabatan
			ON jabatan.kode_jabatan = pegawai.kode_jabatan
			JOIN golongan
			ON golongan.kode_golongan = pegawai.kode_golongan
			WHERE master_gaji.bulan = '$bulan'
			AND master_gaji.tahun = '$tahun'
			ORDER BY pegawai.nip
			";

			$data['gaji'] = $this->db->query($sql)->result_array();
		}


		// PEGAWAI
		$getNIP = $this->db->get_where('pegawai',['username' => $sessU])->row_array();

		$sql = "SELECT pegawai.nip, pegawai.namalengkap, pegawai.status, pegawai.jumlah_anak,
		CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max, 
		jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan,
		golongan.tunjangan_anak AS tjanak, golongan.nama_golongan, golongan.tunjangan_suami_istri AS tjsi, golongan.uang_makan, golongan.asuransi_kesehatan, 
		master_gaji.id,master_gaji.bulan, master_gaji.tahun, master_gaji.masuk, master_gaji.sakit, master_gaji.izin, master_gaji.alpha, master_gaji.lembur, master_gaji.uang_lembur, master_gaji.potongan,
		master_gaji.potongan_sakit, master_gaji.potongan_izin, master_gaji.potongan_alpha, master_gaji.pendapatan, master_gaji.total_gaji

		FROM pegawai INNER JOIN master_gaji ON master_gaji.nip = pegawai.nip
		INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
		INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
		WHERE master_gaji.nip = '$getNIP[nip]' ORDER BY master_gaji.bulan DESC";

		$data['gajiP'] = $this->db->query($sql)->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('data_peng',$data);
		$this->load->view('templates/footer');
	}

	public function print_gaji(){
		$data["title"] = "Print Slip Gaji";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		// RINCIAN
		$nip = $this->input->post('nip');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$sql = "SELECT pegawai.nip, pegawai.namalengkap, pegawai.status, pegawai.jumlah_anak,
		CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max, 
		jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan,
		golongan.tunjangan_anak AS tjanak, golongan.nama_golongan, golongan.tunjangan_suami_istri AS tjsi, golongan.uang_makan, golongan.asuransi_kesehatan, 
		master_gaji.bulan, master_gaji.tahun, master_gaji.masuk, master_gaji.sakit, master_gaji.izin, master_gaji.alpha, master_gaji.lembur, master_gaji.uang_lembur, master_gaji.potongan,
		master_gaji.potongan_sakit, master_gaji.potongan_izin, master_gaji.potongan_alpha, master_gaji.pendapatan, master_gaji.total_gaji

		FROM pegawai 
		INNER JOIN master_gaji 
		ON master_gaji.nip = pegawai.nip
		INNER JOIN golongan 
		ON golongan.kode_golongan = pegawai.kode_golongan
		INNER JOIN jabatan 
		ON jabatan.kode_jabatan = pegawai.kode_jabatan
		WHERE master_gaji.bulan='$bulan' 
		AND master_gaji.tahun='$tahun' 
		AND master_gaji.nip='$nip'
		ORDER BY nip";

		$data['rin'] = $this->db->query($sql)->result_array();



		// PEGAWAI
		$id = $this->input->post('id');
		$getNIP = $this->db->get_where('pegawai',['username' => $sessU])->row_array();

		$sql = "SELECT pegawai.nip, pegawai.namalengkap, pegawai.status, pegawai.jumlah_anak,
		CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max, 
		jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan,
		golongan.tunjangan_anak AS tjanak, golongan.nama_golongan, golongan.tunjangan_suami_istri AS tjsi, golongan.uang_makan, golongan.asuransi_kesehatan, 
		master_gaji.bulan, master_gaji.tahun, master_gaji.masuk, master_gaji.sakit, master_gaji.izin, master_gaji.alpha, master_gaji.lembur, master_gaji.uang_lembur, master_gaji.potongan,
		master_gaji.potongan_sakit, master_gaji.potongan_izin, master_gaji.potongan_alpha, master_gaji.pendapatan, master_gaji.total_gaji

		FROM pegawai INNER JOIN master_gaji ON master_gaji.nip = pegawai.nip
		INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
		INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
		WHERE master_gaji.nip = '$getNIP[nip]' 
		AND master_gaji.id = '$id'
		ORDER BY master_gaji.bulan DESC";

		$data['gajiP'] = $this->db->query($sql)->result_array();

		
		$this->load->view('aksi/print_gaji',$data);
	}

	public function laporan(){
		$data["title"] = "Laporan";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$this->load->view('templates/header',$data);
		$this->load->view('laporan',$data);
		$this->load->view('templates/footer');
	}

	public function lapPgw(){
		$this->load->view('laporan/data_pegawai');
	}

	public function lapJab(){
		$this->load->view('laporan/data_jabatan');
	}

	public function lapGol(){
		$this->load->view('laporan/data_golongan');		
	}

	public function lapKhr(){
		$this->load->view('laporan/data_kehadiran');	
	}

	public function lapLem(){
		$this->load->view('laporan/data_lembur');	
	}

	public function lapPG(){
		$this->load->view('laporan/data_potongan_gaji');
	}

	public function lapTOT(){
		$this->load->view('laporan/total_gaji_pegawai');
	}

	public function tambahJab(){
		$kode_jab = $this->input->post('kode_jabatan');
		$nama_jab = $this->input->post('nama_jabatan');
		$gaji_pok = $this->input->post('gaji_pokok');
		$tunj_jab = $this->input->post('tunjangan_jabatan');
		$pt_sakit = 0 * $gaji_pok;
		$pt_izin  = 0.03 * $gaji_pok;
		$pt_alpha = 0.05 * $gaji_pok;
		$bulan 	  = date('m');
		$tahun 	  = date('Y');

		$data = [
			'kode_jabatan' 		=> $kode_jab,
			'nama_jabatan' 		=> $nama_jab,
			'gaji_pokok'   		=> $gaji_pok,
			'tunjangan_jabatan' => $tunj_jab,
			'potongan_sakit'	=> $pt_sakit,
			'potongan_izin'		=> $pt_izin,
			'potongan_alpha'	=> $pt_alpha,
			'bulan'				=> $bulan,
			'tahun'				=> $tahun
		];

		$this->db->insert('jabatan',$data);

		$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script>
			swal({
				icon: "success",
				text: "Berhasil",
				button: false,
				timer: 3000,
				});
				</script>');

		redirect('DataP/data_jabatan');

	}

	public function editJabatan(){
		$data["title"] = "Edit Jabatan";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$kode_jabatan = $this->input->post('kode_jabatan');

		$data['jabatan'] = $this->db->get_where('jabatan', ['kode_jabatan' => $kode_jabatan])->result_array();

		if (isset($_POST['edit'])) {
			$this->load->view('templates/header',$data);
			$this->load->view('aksi/editJabatan',$data);
			$this->load->view('templates/footer');	
		} else if(isset($_POST['delete'])){
			$this->db->where('kode_jabatan',$kode_jabatan);
			$this->db->delete('jabatan');

			redirect('DataP/data_jabatan');
		}	

	}

	public function updateJab(){
		$kode_jabatan		= $this->input->post('kode_jabatan');
		$nama_jabatan		= $this->input->post('nama_jabatan');
		$gaji_pokok			= $this->input->post('gaji_pokok');
		$tunjangan_jabatan	= $this->input->post('tunjangan_jabatan');

		$pt_sakit = 0 * $gaji_pokok;
		$pt_izin  = 0.03 * $gaji_pokok;
		$pt_alpha = 0.05 * $gaji_pokok;

		if (isset($_POST['update'])) {

			$data = [
				'nama_jabatan' 		  => $nama_jabatan,
				'gaji_pokok'		  => $gaji_pokok,
				'tunjangan_jabatan'   => $tunjangan_jabatan,
				'potongan_sakit'	  => $pt_sakit,
				'potongan_izin'		  => $pt_izin,
				'potongan_alpha'	  => $pt_alpha,
				'bulan'				  => $bulan,
				'tahun'				  => $tahun
			];

			$this->db->where('kode_jabatan',$kode_jabatan);
			$this->db->update('jabatan',$data);

			redirect('DataP/data_jabatan');
			
		} else {
			redirect('DataP/data_jabatan');
		}

	}


	public function tambahGol(){
		$kode_gol = $this->input->post('kode_gol');
		$nama_gol = $this->input->post('nama_gol');
		$tjsi 	  = $this->input->post('tjsi');
		$tja	  = $this->input->post('tja');
		$um 	  = $this->input->post('um');
		$ul  	  = $this->input->post('ul');
		$ak 	  = $this->input->post('ak');
		$bulan 	  = date('m');
		$tahun 	  = date('Y');

		$data = [
			'kode_golongan'			=> $kode_gol,
			'nama_golongan' 	    => $nama_gol,
			'tunjangan_suami_istri' => $tjsi,
			'tunjangan_anak'		=> $tja,
			'uang_makan'			=> $um,
			'uang_lembur'			=> $ul,
			'asuransi_kesehatan' 	=> $ak,
			'bulan'					=> $bulan,
			'tahun'					=> $tahun
		];

		$this->db->insert('golongan',$data);

		$this->session->set_flashdata('message','<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script>
			swal({
				icon: "success",
				text: "Berhasil",
				button: false,
				timer: 3000,
				});
				</script>');

		redirect('DataP/data_golongan');
	}

	public function editGol(){
		$data["title"] = "Edit Golongan";

		$sessU = $this->session->userdata('username');
		$sessL = $this->session->userdata('level');

		if ($sessL === "admin") {
			$data['profile'] = $this->db->get_where('admin', ['username' => $sessU])->result_array();
		} else {
			$data['profile'] = $this->db->get_where('pegawai', ['username' => $sessU])->result_array();	
		}

		$kode_golongan = $this->input->post('kode_golongan');

		$data['golongan'] = $this->db->get_where('golongan', ['kode_golongan' => $kode_golongan])->result_array();

		if (isset($_POST['edit'])) {
			$this->load->view('templates/header',$data);
			$this->load->view('aksi/editGolongan',$data);
			$this->load->view('templates/footer');	
		} else if(isset($_POST['delete'])){
			$this->db->where('kode_golongan',$kode_golongan);
			$this->db->delete('golongan');

			redirect('DataP/data_golongan');
		}	
	}

	public function updateGol(){
		$kode_golongan		= $this->input->post('kode_golongan');
		$nama_golongan		= $this->input->post('nama_golongan');
		$tjsi				= $this->input->post('tjsi');
		$tunjangan_anak		= $this->input->post('tunjangan_anak');
		$uang_makan			= $this->input->post('uang_makan');
		$uang_lembur		= $this->input->post('uang_lembur');
		$asuransi_kesehatan	= $this->input->post('ak');
		$bulan 	  			= date('m');
		$tahun 	  			= date('Y');

		if (isset($_POST['update'])) {

			$data = [
				'nama_golongan'		 	  => $nama_golongan,
				'tunjangan_suami_istri'   => $tjsi,
				'tunjangan_anak'	  	  => $tunjangan_anak,
				'uang_makan'		  	  => $uang_makan,
				'uang_lembur'	 		  => $uang_lembur,
				'asuransi_kesehatan'	  => $asuransi_kesehatan,
				'bulan'				 	  => $bulan,
				'tahun'				 	  => $tahun
			];

			$this->db->where('kode_golongan',$kode_golongan);
			$this->db->update('golongan',$data);

			redirect('DataP/data_golongan');
			
		} else {
			redirect('DataP/data_golongan');
		}
	}

	// AJAX TAMPIL KEHADIRAN
	public function tampilKehadiran(){

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$sql = "SELECT * FROM master_gaji
		JOIN pegawai
		ON pegawai.nip = master_gaji.nip
		JOIN jabatan
		ON jabatan.kode_jabatan = pegawai.kode_jabatan
		JOIN golongan
		ON golongan.kode_golongan = pegawai.kode_golongan
		WHERE master_gaji.bulan = '$bulan'
		AND master_gaji.tahun = '$tahun'
		ORDER BY pegawai.nip
		";

		$data = $this->db->query($sql)->result_array();
		
		echo json_encode($data);
	}

}
