<body>
	<!-- WRAPPER -->
	<?= $this->session->flashdata('message'); ?>
	<div id="wrapper">
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
							<li class="active"><a href="<?= base_url("Home"); ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

							<?php 
							$lev = $this->session->userdata('level');
							if ($lev === "admin") {							
								?>

								<li class="">
									<a href="#uiElements" class="has-arrow" aria-expanded="true"><i class="lnr lnr-users"></i> <span>Data User</span></a>
									<ul aria-expanded="true">
										<li class=""><a href="<?= base_url("Datauser/data_admin"); ?>">Data Admin</a></li>
										<li class=""><a href="<?= base_url("Datauser/data_pegawai"); ?>">Data Pegawai</a></li>
									</ul>
								</li>
								<li class="">
									<a href="#subPages" class="has-arrow" aria-expanded="false"><i class="lnr lnr-apartment"></i> <span>Data Perusahaan</span></a>
									<ul aria-expanded="true">
										<li class=""><a href="<?= base_url("DataP/data_jabatan"); ?>">Data Jabatan</a></li>
										<li class=""><a href="<?= base_url("DataP/data_golongan"); ?>">Data Golongan</a></li>
										<li class=""><a href="<?= base_url("DataP/data_kehadiran"); ?>">Data Kehadiran</a></li>
										<li class=""><a href="<?= base_url("DataP/data_penggajian"); ?>">Data Penggajian</a></li>
										<li class=""><a href="<?= base_url("DataP/laporan"); ?>">Laporan</a></li>
									</ul>
								</li>

								<?php 
							} else {	

								?>

								<li class=""><a href="<?= base_url("DataP/data_kehadiran"); ?>"><i class="lnr lnr-home"></i> <span>Data Kehadiran</span></a></li>
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
					<h1 class="sr-only">Dashboard</h1>
					<!-- WEBSITE ANALYTICS -->
					<div class="dashboard-section">
						<div class="section-heading clearfix">
							<h2 class="section-title"><i class="lnr lnr-home"></i> Dashboard</h2>
						</div>
						<div class="panel-content">
							<div class="row">

								<?php 
								$lev = $this->session->userdata('level');
								if ($lev === "admin") {							
									?>

									<div class="col-md-3 col-sm-6">
										<div class="number-chart">
											<div class="mini-stat">
												<span class="lnr lnr-user" style="font-size: 30px; color: #9079D9; font-weight: 700;"></span>
											</div>
											<div class="number"><span>
												<?php
												$sql 	 = "SELECT nip FROM pegawai";

												$query 	 = $this->db->query($sql)->result_array();

												$jum_peg = count($query);										
												?>

												<div><?= $jum_peg; ?></div>

											</span> <span>DATA PEGAWAI</span></div>
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="number-chart">
											<div class="mini-stat">
												<span class="lnr lnr-briefcase" style="font-size: 30px; color: #64D3E7; font-weight: 700;"></span>
											</div>
											<div class="number"><span>

												<?php
												$sql 	 = "SELECT kode_jabatan FROM jabatan";

												$query 	 = $this->db->query($sql)->result_array();

												$jum_jab = count($query);										
												?>

												<div><?= $jum_jab; ?></div>

											</span> <span>DATA JABATAN</span></div>
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="number-chart">
											<div class="mini-stat">
												<span class="lnr lnr-chart-bars" style="font-size: 30px; color: #F9C656; font-weight: 700;"></span>
											</div>
											<div class="number"><span>

												<?php
												$sql 	 = "SELECT kode_golongan FROM golongan";

												$query 	 = $this->db->query($sql)->result_array();

												$jum_gol = count($query);										
												?>

												<div><?= $jum_gol; ?></div>

											</span> <span>DATA GOLONGAN</span></div>
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="number-chart">
											<div class="mini-stat">
												<span class="lnr lnr-select" style="font-size: 30px; color: #FF69A8; font-weight: 700;"></span>
											</div>
											<div class="number"><span>

												<?php
												$sql 	 = "SELECT idadmin FROM admin";

												$query 	 = $this->db->query($sql)->result_array();

												$jum_adm = count($query);										
												?>

												<div><?= $jum_adm; ?></div>

											</span> <span>DATA ADMIN</span></div>
										</div>
									</div>

								</div>

								<?php 
							} else {	

								?>

								<div class="col-md-3 col-sm-6">
									<div class="number-chart">
										<a href="<?= base_url('Settings'); ?>">
											<div class="mini-stat">
												<span class="lnr lnr-user" style="font-size: 30px; color: #9079D9; font-weight: 700;"></span>
											</div>
											<div class="number">
												<span></span>
												<span>LIHAT PROFIL</span>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="number-chart">
										<a href="<?= base_url('DataP/data_kehadiran'); ?>">
											<div class="mini-stat">
												<span class="lnr lnr-briefcase" style="font-size: 30px; color: #64D3E7; font-weight: 700;"></span>
											</div>
											<div class="number">
												<span></span> 
												<span>LIHAT KEHADIRAN</span>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="number-chart">
										<a href="<?= base_url('DataP/data_penggajian'); ?>">
											<div class="mini-stat">
												<span class="lnr lnr-chart-bars" style="font-size: 30px; color: #F9C656; font-weight: 700;"></span>
											</div>
											<div class="number">
												<span></span> 
												<span>LIHAT GAJI</span>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="number-chart">
										<a href="<?= base_url('Settings'); ?>">
											<div class="mini-stat">
												<span class="lnr lnr-select" style="font-size: 30px; color: #FF69A8; font-weight: 700;"></span>
											</div>
											<div class="number">
												<span></span> 
												<span>SETTINGS PROFIL</span>
											</div>
										</a>
									</div>
								</div>

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

		<script>
			$(function() {

		// KEHADIRAN 7 BULAN TERAKHIR
		var dataStackedBar = {
			labels: ['Jan', 'Feb', 'Mar', 'Ap', 'Mei', 'Jun', 'Jul'],
			series: [
			[29, 25, 27, 28, 25, 27, 28],
			[1, 2, 3, 1, 2, 3, 1],
			[1, 1, 1, 1, 1, 1, 1]
			]
		};

		new Chartist.Bar('#chart-top-products', dataStackedBar, {
			height: "250px",
			stackBars: true,
			axisX: {
				showGrid: false
			},
			axisY: {
				labelInterpolationFnc: function(value) {
					return (value / 1);
				}
			},
			plugins: [
			Chartist.plugins.tooltip({
				appendToBody: true
			}),
			Chartist.plugins.legend({
				legendNames: ['Masuk', 'Izin', 'Alpha']
			})
			]
		}).on('draw', function(data) {
			if (data.type === 'bar') {
				data.element.attr({
					style: 'stroke-width: 30px'
				});
			}
		});


		// notification popup
		toastr.options.closeButton = true;
		toastr.options.positionClass = 'toast-bottom-right';
		toastr.options.showDuration = 1000;
		toastr['info']('Hello, Selamat Datang di Pixel Salary.');

	});
</script>
</body>

</html>
