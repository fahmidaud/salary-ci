<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Pegawai - Pixel Salary</title>
	<!-- <link rel="shortcut icon" href="Assets/IMG/Favicon.png" type="image/x-icon"> -->
	<style type="text/css">
	body{
		font-family: Arial;
	}

	@media print{
		.no-print
		{
			display: none;
		}

		body{
			font-family: Arial;
		}

	}

	table{
		border-collapse: collapse;
	}
</style>
</head>
<body id='data'>

	<!-- SETTING  -->
	<form action="" method="GET" class="no-print">
		<select name="bulan" required>
			<option value="" disabled selected>Pilih Bulan</option>
			<option value="01">Januari</option>
			<option value="02">Februari</option>
			<option value="03">Maret</option>
			<option value="04">April</option>
			<option value="05">Mei</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">Agustus</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
		<select name="tahun" required>
			<option value="" disabled selected>Pilih Tahun</option>
			<?php
			$y = date('Y');
			for ($i=2019; $i <= $y+2 ; $i++) { 
				echo "
				<option value='$i'>$i</option>
				";
			}
			?>
		</select>
		<input type="submit" value="Filter Data">
	</form>

	<form action="" method="GET" class="no-print">
		<input type="submit" value="Tampil semua data">
	</form>

	<h3 align="center">PT. PIXEL SALARY<br>DAFTAR PEGAWAI</h3>
	<hr>

	<?php include('function.php');?>

	<?php
	if ((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')) 
	{
		$bulan_ket = bulanIDN($_GET['bulan']);
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
	}
	else
	{
		$bulan_ket = "Semua Bulan";
		$tahun = "Semua Tahun";
	}
	?>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan_ket; ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?php echo $tahun; ?></td>
		</tr>
	</table>
	

	<table border="1" cellpadding="4" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>NIP</th>
				<th>Nama Pegawai</th>
				<th>Jabatan</th>
				<th>Golongan</th>
				<th>Status</th>
				<th>Jumlah Anak</th>
				<th>Username</th>
				<th>Email</th>
				<th>Bulan/Tahun Daftar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!isset($_GET['bulan']) || !isset($_GET['tahun']) || $_GET['bulan'] == '' || $_GET['tahun'] == ''){
				$sql = "SELECT pegawai.*, jabatan.nama_jabatan, golongan.nama_golongan FROM pegawai INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
				INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan 
				ORDER BY pegawai.nip ASC";

				$query = $this->db->query($sql)->result_array();
			}else{
				$sql = "SELECT pegawai.*, jabatan.nama_jabatan, golongan.nama_golongan FROM pegawai INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
				INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan WHERE pegawai.bulan='$bulan' AND pegawai.tahun='$tahun'
				ORDER BY pegawai.nip ASC";

				$query = $this->db->query($sql)->result_array();
			}

			$no=1;

			if (count($query) == 0) {
				echo"
				<tr>
				<td colspan='10' align='center'>Tidak ada data yang ditambahkan</td>
				</tr>
				";
			}

			foreach ($query as $d) {

				$bulan_ket = bulanIDN($d['bulan']);

				echo "<tr>
				<td width='40px' align='center'>$no</td>
				<td>$d[nip]</td>
				<td>$d[namalengkap]</td>
				<td>$d[nama_jabatan]</td>
				<td>$d[nama_golongan]</td>
				<td>$d[status]</td>
				<td>$d[jumlah_anak]</td>
				<td>$d[username]</td>
				<td>$d[email]</td>
				<td>$bulan_ket/$d[tahun]</td>
				</tr>";
				$no++;

			}
			
			?>
		</tbody>
	</table>

	<table width="100%">
		<tr>
			<td><a href="#" class="no-print" onclick="window.print();">Cetak/Print</a><br>
			</td>
			<td width="200px">
				<p>PIXEL SALARY, <?php echo tglIDN(date("Y-m-d")); ?><br>________________,</p>
				<br>
				<br>
				<br>
				<p>_______________________</p>
			</td>
		</tr>
	</table>
</body>
</html>
