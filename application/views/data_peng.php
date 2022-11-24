<body>
	<!-- WRAPPER -->
	<div id="wrapper">

		<?= $this->session->flashdata('message'); ?>

		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu"></i></button>
				</div>
				<!-- logo -->
				<div class="navbar-brand">
					<!-- <a href="index.html"><img src="assets/img/logo.png" alt="DiffDash Logo" class="img-responsive logo"></a> -->
				</div>
				<!-- end logo -->
				<div class="navbar-right">

					<!-- navbar menu -->
					<div id="navbar-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="<?= base_url("Settings"); ?>" class="icon-menu">
									<i class="lnr lnr-cog"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- end navbar menu -->

				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->


		<!-- LEFT SIDEBAR -->
		<div id="left-sidebar" class="sidebar">
			<button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
				<span class="sr-only">Toggle Fullwidth</span>
				<i class="fa fa-angle-left"></i>
			</button>
			<div class="sidebar-scroll">
				<div class="user-account">
					<?php foreach ($profile as $p) : ?>

						<img src="<?= base_url("assets/img/").$p['photo']; ?>" class="img-responsive img-circle user-photo" alt="User Profile Picture">
						<div class="dropdown">

							<a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Hello, 
								<strong>
									<?= $p['namalengkap']; ?>							
								</strong> <i class="fa fa-caret-down"></i></a>
								<ul class="dropdown-menu dropdown-menu-right account">
									<li><a href="<?= base_url("Settings"); ?>">Settings</a></li>
									<li class="divider"></li>
									<li><a href="<?= base_url("Auth/logout"); ?>" onclick="return confirm('Apakah anda yakin ingin logout?');">Logout</a></li>
								</ul>
							</div>

						<?php endforeach; ?>
					</div>
					<nav id="left-sidebar-nav" class="sidebar-nav">
						<ul id="main-menu" class="metismenu">
							<li class=""><a href="<?= base_url("Home"); ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

							<?php 
							$lev = $this->session->userdata('level');
							if ($lev === "admin") {							
								?>

								<li class="">
									<a href="#uiElements" class="has-arrow" aria-expanded="false"><i class="lnr lnr-users"></i> <span>Data User</span></a>
									<ul aria-expanded="true">
										<li class=""><a href="<?= base_url("Datauser/data_admin"); ?>">Data Admin</a></li>
										<li class=""><a href="<?= base_url("Datauser/data_pegawai"); ?>">Data Pegawai</a></li>
									</ul>
								</li>
								<li class="active">
									<a href="#subPages" class="has-arrow" aria-expanded="true"><i class="lnr lnr-apartment"></i> <span>Data Perusahaan</span></a>
									<ul aria-expanded="true">
										<li class=""><a href="<?= base_url("DataP/data_jabatan"); ?>">Data Jabatan</a></li>
										<li class=""><a href="<?= base_url("DataP/data_golongan"); ?>">Data Golongan</a></li>
										<li class=""><a href="<?= base_url("DataP/data_kehadiran"); ?>">Data Kehadiran</a></li>
										<li class="active"><a href="<?= base_url("DataP/data_penggajian"); ?>">Data Penggajian</a></li>
										<li class=""><a href="<?= base_url("DataP/laporan"); ?>">Laporan</a></li>
									</ul>
								</li>

								<?php 
							} else {	

								?>

								<li class=""><a href="<?= base_url("DataP/data_kehadiran"); ?>"><i class="lnr lnr-home"></i> <span>Data Kehadiran</span></a></li>
								<li class="active"><a href="<?= base_url("DataP/data_penggajian"); ?>"><i class="lnr lnr-home"></i> <span>Data Penggajian</span></a></li>


							<?php } ?>
							
						</ul>
					</nav>

				</div>
			</div>
			<!-- END LEFT SIDEBAR -->


			<!-- MAIN CONTENT -->
			<div id="main-content">
				<div class="container-fluid">
					<h1 class="sr-only">Data Penggajian</h1>
					<!-- WEBSITE ANALYTICS -->
					<div class="dashboard-section">
						<div class="section-heading clearfix">
							<h2 class="section-title"><i class="lnr lnr-database"></i> Data Penggajian</h2>
						</div>

						<?php 
						$lev = $this->session->userdata('level');
						if ($lev === "admin") {				
							?>

							<div class="col-10">
								<div class="panel-content">

									<form method="POST" action="<?= base_url('DataP/data_penggajian'); ?>">

										<div class="col-md-2 col-sm-3">
											<label>Bulan</label>
											<br>
											<select id="single-selection" name="bulan" class="multiselect multiselect-custom">
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
										</div>

										<div class="col-md-2 col-sm-3">
											<label>Tahun</label>
											<br>
											<select id="single-selection" name="tahun" class="multiselect multiselect-custom">
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
											</select>
										</div>								

										<div class="col-md-2" style="margin-top: 10px;">
											<button type="submit" name="tampil" class="btn btn-primary">Tampilkan Data</button>
										</div>

									</form>

									<div class="col-md-3" style="margin-top: 10px; float: right;">
										<div style="background-color: #5C8ED4; color: white; padding: 9.5px; border-radius: 4px; text-align: center;">

											<?php 
											$bulan = $this->input->post('bulan'); 
											$tahun = $this->input->post('tahun'); 
											?>

											Bulan : <span><?= $bulan; ?>,</span>
											Tahun : <span><?= $tahun; ?></span>

										</div>
									</div>

								</div>
							</div>

							<?php if (isset($_POST['tampil'])) { ?>

								<div class="panel-content" style="display: block; margin-top:30px;">


									<div class="row" style="padding: 20px;">

										<table class="table table-striped table-bordered data">
											<thead>
												<tr>			
													<th class="text-center">No</th>
													<th class="text-center">NIP</th>
													<th class="text-center">Nama</th>
													<th class="text-center">Jabatan</th>
													<th class="text-center">Golongan</th>
													<th class="text-center">Total Gaji</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>

												<?php $no=1; ?>
												<?php foreach ($gaji as $g) : ?>									

													<tr>
														<td class="text-center"><?= $no++; ?></td>
														<td class="text-center"><?= $g['nip']; ?></td>
														<td class="text-center"><?= $g['namalengkap']; ?></td>
														<td class="text-center"><?= $g['nama_jabatan']; ?></td>
														<td class="text-center"><?= $g['nama_golongan']; ?></td>
														<td class="text-center"><?= "Rp ".number_format($g['total_gaji'],0,',','.'); ?></td>
														<td class="text-center">
															<form method="POST" action="<?= base_url('DataP/print_gaji'); ?>">

																<input type="hidden" name="nip" value="<?= $g['nip']; ?>">

																<?php 
																$b = $this->input->post('bulan');
																$t = $this->input->post('tahun');
																?>

																<input type="hidden" name="bulan" value="<?= $b; ?>">
																<input type="hidden" name="tahun" value="<?= $t; ?>">

																<button type="submit" class="btn btn-default" title="Rincian" style="background-color: #3367D6;" formtarget="_blank">
																	<span class="sr-only">Rincian</span> 
																	<i class="lnr lnr-arrow-right" style="font-weight: 700; color: white;"></i>
																</button>

															</form>
														</td>
													</tr>

												<?php endforeach; ?>

											</tbody>
										</table>

									</div>

								<?php } ?>

							</div>
						</div>

						<?php 
					} else {	

						?>

						

						<table class="table table-striped table-bordered data">
							<thead>
								<tr>
									<th>No.</th>
									<th>Bulan / Tahun</th>
									<th>Nama / NIP</th>
									<th>Total Gaji</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php include 'aksi/func.php'; ?>
								<?php $no = 1; ?>
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


									<tr>
										<td><?= $no++; ?></td>
										<td><?= $bulan_ket.' / '.$d['tahun']; ?></td>
										<td><?= $d['namalengkap'].' / '.$d['nip']; ?></td>
										<td><?= $totalGaji; ?></td>
										<td class="text-center">
											<form method="POST" action="<?= base_url('DataP/print_gaji'); ?>">

												<input type="hidden" name="id" value="<?= $d['id']; ?>">

												<button type="submit" class="btn btn-default" title="Rincian" style="background-color: #3367D6;" formtarget="_blank">
													<span class="sr-only">Rincian</span> 
													<i class="lnr lnr-arrow-right" style="font-weight: 700; color: white;"></i>
												</button>

											</form>
										</td>
									</tr>


								<?php endforeach; ?>

							<?php } ?>
						</tbody>
					</table>


					<!-- END WEBSITE ANALYTICS -->

				</div>
			</div>

			

			<!-- END MAIN CONTENT -->
			<div class="clearfix"></div>
			<footer>
				<p class="copyright">&copy; 2019 <a href="https://www.themeineed.com" target="_blank">Pixel Salary</a>. All Rights Reserved.</p>
			</footer>
		</div>
		<!-- END WRAPPER -->


		<script type="text/javascript">
			$(document).ready(function(){
				$('.data').DataTable();
			});
		</script>
	</body>

	</html>
