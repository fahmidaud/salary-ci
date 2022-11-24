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
							<?php
							$lev = $this->session->userdata('level');
							if ($lev === "admin") {
							?>
								<li class="dropdown">
									<a href="<?= base_url('DataP/addKehadiran'); ?>" class="icon-menu">
										<i class="lnr lnr-plus-circle"></i>
									</a>
								</li>
							<?php } ?>
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
									<li class="active"><a href="<?= base_url("DataP/data_kehadiran"); ?>">Data Kehadiran</a></li>
									<li class=""><a href="<?= base_url("DataP/data_penggajian"); ?>">Data Penggajian</a></li>
									<li class=""><a href="<?= base_url("DataP/laporan"); ?>">Laporan</a></li>
								</ul>
							</li>

						<?php
						} else {

						?>

							<li class="active"><a href="<?= base_url("DataP/data_kehadiran"); ?>"><i class="lnr lnr-home"></i> <span>Data Kehadiran</span></a></li>
							<li class=""><a href="<?= base_url("DataP/data_penggajian"); ?>"><i class="lnr lnr-home"></i> <span>Data Penggajian</span></a></li>


						<?php } ?>

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
						<h2 class="section-title"><i class="lnr lnr-checkmark-circle"></i> Data Kehadiran</h2>
					</div>

					<div class="col-10">

						<?php
						$lev = $this->session->userdata('level');
						if ($lev === "admin") {
						?>

							<div class="panel-content">

								<form method="POST" action="<?= base_url('DataP/data_kehadiran'); ?>">

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
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
										</select>
									</div>

									<div class="col-md-1" style="margin-top: 10px;margin-right: 30px;">
										<button type="button" name="tampil" class="btn btn-primary" onclick="tampilKehadiran()">Tampil</button>
									</div>

								</form>

								<div class="col-md-3" style="margin-top: 10px; float: right;">
									<div style="background-color: #5C8ED4; color: white; padding: 9.5px; border-radius: 4px; text-align: center;" id="ketWaktu">
										<span>Bulan : ,</span>
										<span>Tahun : </span>
									</div>
								</div>

							</div>
					</div>

					<div class="panel-content" style="margin-top:30px;">

						<div class="row" style="padding: 20px;">

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
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody id="tampilKehadiran">

								</tbody>

							</table>

							<div style="width: 100%;text-align: right;" id="submitKhdrn">

							</div>

						</div>
					</div>
				</div>
				<!-- END WEBSITE ANALYTICS -->

			<?php
						} else {

			?>

				<div class="panel-content" style="margin-top:30px;">

					<div class="row" style="padding: 20px;">

						<table class="table table-striped table-bordered data">
							<thead id="formPgw">
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Bulan/Tahun</th>
									<th class="text-center">Nama/NIP</th>
									<th class="text-center">Jabatan</th>
									<th class="text-center">Masuk</th>
									<th class="text-center">Sakit</th>
									<th class="text-center">Izin</th>
									<th class="text-center">Alpha</th>
									<th class="text-center">Lembur</th>
								</tr>
							</thead>
							<tbody>
								<?php include 'aksi/func.php'; ?>
								<?php $no = 1; ?>
								<?php foreach ($kehadiranP as $d) : ?>

									<?php
									$potongan = buatRP($d['potongan']);
									$bulan_ket = bulanIDN($d['bulan']);
									?>

									<tr>
										<td><?= $no++; ?></td>
										<td><?= $bulan_ket . '/' . $d['tahun']; ?></td>
										<td><?= $d['namalengkap'] . ' / ' . $d['nip']; ?></td>
										<td><?= $d['nama_jabatan']; ?></td>
										<td><?= $d['masuk']; ?></td>
										<td><?= $d['sakit']; ?></td>
										<td><?= $d['izin']; ?></td>
										<td><?= $d['alpha']; ?></td>
										<td><?= $d['lembur']; ?></td>
									</tr>

								<?php endforeach; ?>
							</tbody>

						</table>

						<div style="width: 100%;text-align: right;" id="submitKhdrn">

						</div>

					</div>
				</div>

			<?php } ?>

			</div>
		</div>
		<!-- END MAIN CONTENT -->
		<div class="clearfix"></div>
		<footer>
			<p class="copyright">&copy; 2019 <a href="https://www.themeineed.com" target="_blank">Pixel Salary</a>. All Rights Reserved.</p>
		</footer>
	</div>
	<!-- END WRAPPER -->

	<script>
		// AJAX
		function tampilKehadiran() {
			var bulan = $("[name='bulan']").val();
			var tahun = $("[name='tahun']").val();

			$.ajax({
				type: "POST",
				data: 'bulan=' + bulan + '&tahun=' + tahun,
				url: '<?= base_url("DataP/tampilKehadiran"); ?>',
				dataType: 'json',
				success: function(data) {
					var no = 1;
					var baris = '';
					if (data.length > 0) {
						for (var i = 0; i < data.length; i++) {
							baris += '<tr>' +
								'<td>' + no++ + '</td>' +
								'<td>' + data[i].nip + '</td>' +
								'<td>' + data[i].namalengkap + '</td>' +
								'<td>' + data[i].masuk + '</td>' +
								'<td>' + data[i].sakit + '</td>' +
								'<td>' + data[i].izin + '</td>' +
								'<td>' + data[i].alpha + '</td>' +
								'<td>' + data[i].lembur + '</td>' +
								'<td style="text-align:center;">' +
								'<form method="POST" action="<?= base_url('DataP/editKehadiran'); ?>">' +
								'<input type="hidden" name="bulan" value="' + bulan + '">' +
								'<input type="hidden" name="tahun" value="' + tahun + '">' +
								'<input type="hidden" name="nip" value="' + data[i].nip + '">' +
								'<button type="submit" class="btn btn-default" title="Edit" style="background-color: #3367D6;"><span class="sr-only">Edit</span> <i class="lnr lnr-pencil" style="font-weight: 700; color: white;">' + '</i></button>' +
								'</form>' +
								'</td>' +
								'</tr>';
						}
					} else {
						baris += '<tr>' +
							'<td colspan="9" style="text-align:center;">' + 'Data Belum Diinputkan' + '</td>' +
							'</tr>';
					}
					$('#tampilKehadiran').html(baris);


					// MENAMPILKAN KET BLN TH
					var ket = '';
					ket += '<span>' +
						'Bulan : ' + bulan +
						'</span>' +
						'<span>' +
						', Tahun : ' + tahun +
						'</span>';

					$('#ketWaktu').html(ket);
				}
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.data').DataTable();
		});
	</script>
</body>

</html>