	<!DOCTYPE html>
	<html>
	<head>
		<title>Laporan Penggajian - Pixel Salary</title>
		<link rel="shortcut icon" href="Assets/IMG/Favicon.png" type="image/x-icon">
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

	<?php include('function.php');?>

	<h3 align="center">PT. PIXEL SALARY<br>DAFTAR GAJI PEGAWAI</h3>
	<hr>
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
				<th>Bulan/Tahun</th>
				<th>NIP</th>
				<th>Nama Pegawai</th>
				<th>Jabatan</th>
				<th>Golongan</th>
				<th>Status</th>
				<th>Jumlah Anak</th>
				<th>Gaji Pokok</th>
				<th>Tj Jabatan</th>
				<th>Tj S/I</th>
				<th>Tj Anak</th>
				<th>Uang Makan</th>
				<th>Uang Lembur</th>
				<th>Asuransi Kesehatan</th>
				<th>Pendapatan</th>
				<th>Potongan</th>
				<th>Total Gaji</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!isset($_GET['bulan']) || !isset($_GET['tahun']) || $_GET['bulan'] == '' || $_GET['tahun'] == ''){
				$sql = "SELECT pegawai.nip, pegawai.namalengkap, pegawai.status, pegawai.jumlah_anak,
				CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max, 
				jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan,
				golongan.tunjangan_anak AS tjanak, golongan.nama_golongan, golongan.tunjangan_suami_istri AS tjsi, golongan.uang_makan, golongan.asuransi_kesehatan, 
				master_gaji.*

				FROM pegawai INNER JOIN master_gaji ON master_gaji.nip = pegawai.nip
				INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
				INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
				ORDER BY master_gaji.bulan, pegawai.nip";

				$query = $this->db->query($sql)->result_array();
			}else{
				$sql = "SELECT pegawai.nip, pegawai.namalengkap, pegawai.status, pegawai.jumlah_anak,
				CASE WHEN pegawai.jumlah_anak > 3 then 3 ELSE pegawai.jumlah_anak END AS jmlanak_max, 
				jabatan.nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan,
				golongan.tunjangan_anak AS tjanak, golongan.nama_golongan, golongan.tunjangan_suami_istri AS tjsi, golongan.uang_makan, golongan.asuransi_kesehatan, 
				master_gaji.*

				FROM pegawai INNER JOIN master_gaji ON master_gaji.nip = pegawai.nip
				INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
				INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
				WHERE master_gaji.bulan='$bulan' AND master_gaji.tahun='$tahun' ORDER BY master_gaji.bulan, pegawai.nip";

				$query = $this->db->query($sql)->result_array();
			}

			$no=1;
			
			if (count($query) == 0) {
				echo"
				<tr>
				<td colspan='18' align='center'>Tidak ada data yang ditambahkan</td>
				</tr>
				";
			}

			foreach ($query as $d) {

				if($d['status'] != "Menikah"){
					$d['tjsi'] = 0;
				}

				$gajiPokok = buatRP($d['gaji_pokok']);
				$tunjanganJabatan = buatRP($d['tunjangan_jabatan']);
				$tjsi = buatRP($d['tjsi']);
				$tjanak = buatRP($d['tjanak'] * $d['jmlanak_max']);
				$uangMakan = buatRP($d['uang_makan']);
				$uangLembur = buatRP($d['uang_lembur']);
				$asuransiKesehatan = buatRP($d['asuransi_kesehatan']);
				$pendapatan = buatRP($d['pendapatan']);
				$potongan_ketidakhadiran = $d['potongan_sakit'] + $d['potongan_izin'] + $d['potongan_alpha'];
				$potongan = buatRP($d['potongan'] + $potongan_ketidakhadiran);
				$totalGaji = buatRP($d['total_gaji']);

				$bulan_ket = bulanIDN($d['bulan']);

				echo "<tr>
				<td width='40px' align='center'>$no</td>
				<td>$bulan_ket/$d[tahun]</td>
				<td>$d[nip]</td>
				<td>$d[namalengkap]</td>
				<td>$d[nama_jabatan]</td>
				<td>$d[nama_golongan]</td>
				<td>$d[status]</td>
				<td>$d[jumlah_anak]</td>
				<td>$gajiPokok</td>
				<td>$tunjanganJabatan</td>
				<td>$tjsi</td>
				<td>$tjanak</td>
				<td>$uangMakan</td>
				<td>$uangLembur</td>
				<td>$asuransiKesehatan</td>
				<td>$pendapatan</td>
				<td>$potongan</td>
				<td>$totalGaji</td>

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