<?php 

function cek_status1($nip){

	$thiskw = get_instance();

	$data = [
		'nip' => $nip,
		'status' => "Belum Menikah"
	];

	$result = $thiskw->db->get_where('pegawai',$data);

	if ($result->num_rows() != 0) {
		return "selected";
	}

}

function cek_status2($nip){

	$thiskw = get_instance();

	$data = [
		'nip' => $nip,
		'status' => "Menikah"
	];

	$result = $thiskw->db->get_where('pegawai',$data);

	if ($result->num_rows() != 0) {
		return "selected";
	}

}


?>