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

						<img src="<?= base_url("assets/img/") . $p['photo']; ?>" class="img-responsive img-circle user-photo" alt="User Profile Picture">
						<div class="dropdown">

							<a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Hello,
								<strong>
									<?= $p['namalengkap']; ?>
								</strong> <i class="fa fa-caret-down"></i></a>
							<ul class="dropdown-menu dropdown-menu-right account">
								<li><a href="<?= base_url("Settings"); ?>">Settings</a></li>
								<li class="divider"></li>
								<li><a href="<?= base_url("Auth/logout"); ?>" onclick="confirm('Apakah anda yakin ingin logout?');">Logout</a></li>
							</ul>
						</div>

					<?php endforeach; ?>
				</div>
				<nav id="left-sidebar-nav" class="sidebar-nav">
					<ul id="main-menu" class="metismenu">
						<li class=""><a href="<?= base_url("Home"); ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
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
								<li class="active"><a href="<?= base_url("DataP/data_kehadiran"); ?>">Data Kehadiran</a></li>
								<li class=""><a href="<?= base_url("DataP/data_penggajian"); ?>">Data Penggajian</a></li>
								<li class=""><a href="<?= base_url("DataP/laporan"); ?>">Laporan</a></li>
							</ul>
						</li>
					</ul>
				</nav>

			</div>
		</div>
		<!-- END LEFT SIDEBAR -->


		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<h1 class="sr-only">Data Kehadiran</h1>
				<!-- WEBSITE ANALYTICS -->
				<div class="dashboard-section">
					<div class="section-heading clearfix">
						<h2 class="section-title"><i class="lnr lnr-cog"></i> Tambah Data Kehadiran</h2>
					</div>
					<div class="panel-content">

						<form method="GET">

							<div class="col-md-1">
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

							<div class="col-md-1" style="margin-left: 15px;">
								<label>Tahun</label>
								<br>
								<select id="single-selection" name="tahun" class="multiselect multiselect-custom">
									<!-- <option value="2019">2019</option>
										<option value="2020">2020</option> -->
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
								</select>
							</div>

							<div class="col-md-1" style="margin-top: 10px;margin-right: 30px;">
								<button type="submit" name="generate" class="btn btn-primary">Generate</button>
							</div>

						</form>

						<div class="col-md-3" style="margin-top: 10px; float: right;">
							<div style="background-color: #5C8ED4; color: white; padding: 9.5px; border-radius: 4px; text-align: center;" id="ketWaktu">

								<?php
								$b = $this->input->get('bulan');
								$t = $this->input->get('tahun');
								?>

								<span>Bulan : <?= $b; ?>,</span>
								<span>Tahun : <?= $t; ?></span>
							</div>
						</div>
						<br><br><br>

						<?php if (isset($_GET['generate'])) { ?>

							<form method="post" action="<?= base_url('DataP/addKehadiran'); ?>">
								<!-- TABEL -->
								<table class="table table-striped table-bordered data">
									<thead id="formPgw">
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">NIP</th>
											<th class="text-center">Nama</th>
											<th class="text-center">Masuk</th>
											<th class="text-center">Sakit</th>
											<th class="text-center">Izin</th>
											<th class="text-center">Alpha</th>
											<th class="text-center">Lembur</th>
											<th class="text-center">Potongan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM master_gaji
											WHERE bulan = '$b'
											AND tahun = '$t'
											";

										$query = $this->db->query($sql)->result_array();
										$count = count($query);

										if ($count < 1) {
										?>

											<?php $no = 1; ?>
											<?php foreach ($pegawai as $p) : ?>
												<tr>

													<input type="hidden" name="nip[]" value="<?= $p['nip']; ?>" required>
													<td><?= $no++; ?></td>
													<td><?= $p['nip']; ?></td>
													<td><?= $p['namalengkap']; ?></td>
													<td>
														<input type="number" name="masuk[]" min="0" maxlength="2" style="width:85%;outline: none;border: none;padding: 10px 5px;border-bottom: 1.3px solid #DDE2E9;">
													</td>
													<td>
														<input type="number" name="sakit[]" min="0" style="width:85%;outline: none;border: none;padding: 10px 5px;border-bottom: 1.3px solid #DDE2E9;">
													</td>
													<td>
														<input type="number" name="izin[]" min="0" style="width:85%;outline: none;border: none;padding: 10px 5px;border-bottom: 1.3px solid #DDE2E9;">
													</td>
													<td>
														<input type="number" name="alpha[]" min="0" style="width:85%;outline: none;border: none;padding: 10px 5px;border-bottom: 1.3px solid #DDE2E9;">
													</td>
													<td>
														<input type="number" name="lembur[]" min="0" style="width:85%;outline: none;border: none;padding: 10px 5px;border-bottom: 1.3px solid #DDE2E9;">
													</td>
													<td>
														<input type="number" name="potongan[]" min="0" style="width:85%;outline: none;border: none;padding: 10px 5px;border-bottom: 1.3px solid #DDE2E9;">
													</td>
												</tr>

											<?php endforeach; ?>
									</tbody>

								</table>

								<?php
											$b = $this->input->get('bulan');
											$t = $this->input->get('tahun');
								?>
								<input type="hidden" name="bulan" value="<?= $b; ?>">
								<input type="hidden" name="tahun" value="<?= $t; ?>">


								<div style="float: right;">
									<button type="submit" name="close" class="btn btn-default"><i class="fa fa-times-circle"></i> Close</button>
									<button type="submit" name="tambah" class="btn btn-primary" style="margin-left:15px;"><i class="fa fa-check-circle"></i> Tambah</button>
								</div>

							</form>

						<?php } else { ?>

							<tr>
								<td colspan="9" style="text-align: center;">Data Sudah Diinputkan</td>
							</tr>

						<?php } ?>

					<?php } ?>

					</div>
				</div>
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
</body>

</html>