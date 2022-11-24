<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
	@media print
	{
		.no-print
		{
			display: none;
		}
	}

	.tb tr td{
		font-size: 18px;
		font-weight: 500;
	}

	.tb span{
		font-size: 18px;
		font-weight: 500;
	}
</style>
</head>
<body>

	<?php 
	$lev = $this->session->userdata('level');
	if ($lev === "admin") {							
		?>

		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<!-- WEBSITE ANALYTICS -->
				<div class="dashboard-section">
					<div class="panel-content">
						<?php
						include 'func.php';
						?>

						<?php foreach ($rin as $d) : ?>

							<?php 
							if($d['status'] != "Menikah"){
								$d['tjsi'] = 0;
							}

							if ($d['masuk'] == 0) {
								$d['gaji_pokok'] = 0;
								$d['tunjangan_jabatan'] = 0;
								$d['tjsi'] = 0;
								$d['tjanak'] = 0;
								$d['uang_makan'] = 0;
								$d['uang_lembur'] = 0;
								$d['asuransi_kesehatan'] = 0;
							}

							$tidakHadir = $d['sakit'] + $d['izin'] + $d['alpha'];
							$gajiPokok = buatRP($d['gaji_pokok']);
							$tunjanganJabatan = buatRP($d['tunjangan_jabatan']);
							$tjsi = buatRP($d['tjsi']);
							$tjanak = buatRP($d['tjanak'] * $d['jmlanak_max']);
							$uangMakan = buatRP($d['uang_makan']);
							$uangLembur = buatRP($d['uang_lembur']);
							$asuransiKesehatan = buatRP($d['asuransi_kesehatan']);
							$pendapatan = buatRP($d['pendapatan']);
							$potongan = buatRP($d['potongan']);
							$potongan_sakit = buatRP($d['potongan_sakit']);
							$potongan_izin = buatRP($d['potongan_izin']);
							$potongan_alpha = buatRP($d['potongan_alpha']);
							$totalGaji = buatRP($d['total_gaji']);
							$totalPotongan = buatRP($d['potongan_sakit'] + $d['potongan_izin'] + $d['potongan_alpha'] + $d['potongan']);

							$bulan_ket = bulanIDN($d['bulan']);
							?>

							<div class="header">
								<div class="waktu tb">
									<span>Bulan / </span><span>Tahun : </span>
									<span><?= $bulan_ket.' / '; ?></span><span><?= $d['tahun']; ?></span>
									<br>
								</div>
								<div class="nama tb">
									<span>Nama / </span><span>NIP : </span>
									<span><?= $d['namalengkap'].' / '; ?></span><span><?= $d['nip']; ?></span>
									<br><br>
								</div>

								<table class="tb" width="50%" style="float: left;background-color: transparent;">
									<tr>
										<td>Jumlah Kehadiran</td>
										<td><?= $d['masuk']; ?></td>
									</tr>
									<tr>
										<td>Jumlah Tidak Hadir</td>		
										<td><?= $tidakHadir; ?></td>
									</tr>
									<tr>
										<td>Status / Jumlah Anak</td>
										<td><?= $d['status'].' / '.$d['jumlah_anak']; ?></td>
									</tr>
									<tr>
										<td>Jabatan / Golongan</td>
										<td><?= $d['nama_jabatan'].' / '.$d['nama_golongan']; ?></td>
									</tr>
									<tr>
										<td>Gaji Pokok</td>
										<td><?= $gajiPokok; ?></td>
									</tr>
									<tr>
										<td>Tunjangan Jabatan</td>
										<td><?= $tunjanganJabatan; ?></td>
									</tr>
									<tr>
										<td>Tunjangan Suami / Istri</td>
										<td><?= $tjsi; ?></td>
									</tr>
									<tr>
										<td>Tunjangan Anak</td>
										<td><?= $tjanak; ?></td>
									</tr>

								</table>

								<table class="tb" width="50%" style="float: right;">
									<tr>
										<td>Uang Makan</td>
										<td><?= $uangMakan; ?></td>
									</tr>
									<tr>
										<td>Uang Lembur / Lama Lembur</td>
										<td><?= $uangLembur.' / '.$d['lembur']; ?></td>
									</tr>
									<tr>
										<td>Asuransi Kesehatan</td>
										<td><?= $asuransiKesehatan; ?></td>
									</tr>
									<tr>
										<td>Pendapatan</td>
										<td><?= $pendapatan; ?></td>
									</tr>
									<tr>
										<td>Potongan Sakit</td>
										<td><?= $potongan_sakit; ?></td>
									</tr>
									<tr>
										<td>Potongan Izin</td>
										<td><?= $potongan_izin; ?></td>
									</tr>
									<tr>
										<td>Potongan Alpha</td>
										<td><?= $potongan_alpha; ?></td>
									</tr>
									<tr>
										<td>Potongan Tambahan</td>
										<td><?= $potongan; ?></td>
									</tr>
									<tr>
										<td>Jumlah Potongan</td>
										<td><?= $totalPotongan; ?></td>
									</tr>
								</table>

								<table width="100%" style="padding-top: 30px;">
									<tr>
										<td style="text-align: center;font-size: 25px;font-weight: bold;">Total Gaji : <?= $totalGaji; ?></td>
									</tr>
								</table>


								<table>
									<tr>
										<td>
											<a href="#" class="no-print" onclick="window.print()">Print</a>
										</td>
									</tr>
								</table>
							</div>

						<?php endforeach; ?>

					</div>
				</div>
				<!-- END WEBSITE ANALYTICS -->

			</div>
		</div>

		<?php 
	} else {	

		?>

		<?php foreach ($gajiP as $d) : ?>


			<div class="container-fluid">
				<!-- WEBSITE ANALYTICS -->
				<div class="dashboard-section">
					<div class="panel-content">
						<?php
						include 'func.php';
						?>

						<?php foreach ($gajiP as $d) : ?>

							<?php 
							if($d['status'] != "Menikah"){
								$d['tjsi'] = 0;
							}

							if ($d['masuk'] == 0) {
								$d['gaji_pokok'] = 0;
								$d['tunjangan_jabatan'] = 0;
								$d['tjsi'] = 0;
								$d['tjanak'] = 0;
								$d['uang_makan'] = 0;
								$d['uang_lembur'] = 0;
								$d['asuransi_kesehatan'] = 0;
							}

							$tidakHadir = $d['sakit'] + $d['izin'] + $d['alpha'];
							$gajiPokok = buatRP($d['gaji_pokok']);
							$tunjanganJabatan = buatRP($d['tunjangan_jabatan']);
							$tjsi = buatRP($d['tjsi']);
							$tjanak = buatRP($d['tjanak'] * $d['jmlanak_max']);
							$uangMakan = buatRP($d['uang_makan']);
							$uangLembur = buatRP($d['uang_lembur']);
							$asuransiKesehatan = buatRP($d['asuransi_kesehatan']);
							$pendapatan = buatRP($d['pendapatan']);
							$potongan = buatRP($d['potongan']);
							$potongan_sakit = buatRP($d['potongan_sakit']);
							$potongan_izin = buatRP($d['potongan_izin']);
							$potongan_alpha = buatRP($d['potongan_alpha']);
							$totalGaji = buatRP($d['total_gaji']);
							$totalPotongan = buatRP($d['potongan_sakit'] + $d['potongan_izin'] + $d['potongan_alpha'] + $d['potongan']);

							$bulan_ket = bulanIDN($d['bulan']);
							?>
							<div class="header">
								<div class="waktu tb">
									<span>Bulan / </span><span>Tahun : </span>
									<span><?= $bulan_ket.' / '; ?></span><span><?= $d['tahun']; ?></span>
									<br>
								</div>
								<div class="nama tb">
									<span>Nama / </span><span>NIP : </span>
									<span><?= $d['namalengkap'].' / '; ?></span><span><?= $d['nip']; ?></span>
									<br><br>
								</div>

								<table class="tb" width="50%" style="float: left;background-color: transparent;">
									<tr>
										<td>Jumlah Kehadiran</td>
										<td><?= $d['masuk']; ?></td>
									</tr>
									<tr>
										<td>Jumlah Tidak Hadir</td>		
										<td><?= $tidakHadir; ?></td>
									</tr>
									<tr>
										<td>Status / Jumlah Anak</td>
										<td><?= $d['status'].' / '.$d['jumlah_anak']; ?></td>
									</tr>
									<tr>
										<td>Jabatan / Golongan</td>
										<td><?= $d['nama_jabatan'].' / '.$d['nama_golongan']; ?></td>
									</tr>
									<tr>
										<td>Gaji Pokok</td>
										<td><?= $gajiPokok; ?></td>
									</tr>
									<tr>
										<td>Tunjangan Jabatan</td>
										<td><?= $tunjanganJabatan; ?></td>
									</tr>
									<tr>
										<td>Tunjangan Suami / Istri</td>
										<td><?= $tjsi; ?></td>
									</tr>
									<tr>
										<td>Tunjangan Anak</td>
										<td><?= $tjanak; ?></td>
									</tr>

								</table>

								<table class="tb" width="50%" style="float: right;">
									<tr>
										<td>Uang Makan</td>
										<td><?= $uangMakan; ?></td>
									</tr>
									<tr>
										<td>Uang Lembur / Lama Lembur</td>
										<td><?= $uangLembur.' / '.$d['lembur']; ?></td>
									</tr>
									<tr>
										<td>Asuransi Kesehatan</td>
										<td><?= $asuransiKesehatan; ?></td>
									</tr>
									<tr>
										<td>Pendapatan</td>
										<td><?= $pendapatan; ?></td>
									</tr>
									<tr>
										<td>Potongan Sakit</td>
										<td><?= $potongan_sakit; ?></td>
									</tr>
									<tr>
										<td>Potongan Izin</td>
										<td><?= $potongan_izin; ?></td>
									</tr>
									<tr>
										<td>Potongan Alpha</td>
										<td><?= $potongan_alpha; ?></td>
									</tr>
									<tr>
										<td>Potongan Tambahan</td>
										<td><?= $potongan; ?></td>
									</tr>
									<tr>
										<td>Jumlah Potongan</td>
										<td><?= $totalPotongan; ?></td>
									</tr>
								</table>

								<table width="100%" style="padding-top: 30px;">
									<tr>
										<td style="text-align: center;font-size: 25px;font-weight: bold;">Total Gaji : <?= $totalGaji; ?></td>
									</tr>
								</table>


								<table>
									<tr>
										<td>
											<a href="#" class="no-print" onclick="window.print()">Print</a>
										</td>
									</tr>
								</table>
							</div>

						<?php endforeach; ?>

					</div>
				</div>
				<!-- END WEBSITE ANALYTICS -->

			</div>			

		<?php endforeach; ?>


	<?php } ?>	

</body>
</html>
