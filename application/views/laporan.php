<body>
	<!-- WRAPPER -->
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
							<li class=""><a href="<?= base_url("Home"); ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
							<li class="">
								<a href="#uiElements" class="has-arrow" aria-expanded="true"><i class="lnr lnr-users"></i> <span>Data User</span></a>
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
									<li class=""><a href="<?= base_url("DataP/data_penggajian"); ?>">Data Penggajian</a></li>
									<li class="active"><a href="<?= base_url("DataP/laporan"); ?>">Laporan</a></li>
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
					<h1 class="sr-only">Laporan</h1>
					<!-- WEBSITE ANALYTICS -->
					<div class="dashboard-section">
						<div class="section-heading clearfix">
							<h2 class="section-title"><i class="lnr lnr-file-empty"></i> Laporan</h2>
						</div>
						<div class="panel-content">
							<div class="row">

								<div class="dashboard-section no-margin">
									<div class="panel-content">
										<div class="row">
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-users" style="font-size: 40px; font-weight: 600;"></i> Data Pegawai <span>
														<a href="<?= base_url('DataP/lapPgw'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-license" style="font-size: 40px; font-weight: 600;"></i> Data Jabatan <span>
														<a href="<?= base_url('DataP/lapJab'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-list" style="font-size: 40px; font-weight: 600;"></i> Data Golongan <span>
														<a href="<?= base_url('DataP/lapGol'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-checkmark-circle" style="font-size: 40px; font-weight: 600;"></i> Data Kehadiran <span>
														<a href="<?= base_url('DataP/lapKhr'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-gift" style="font-size: 40px; font-weight: 600;"></i> Data Lembur <span>
														<a href="<?= base_url('DataP/lapLem'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-tag" style="font-size: 40px; font-weight: 600;"></i> Potongan Gaji <span>
														<a href="<?= base_url('DataP/lapPG'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											<div class="col-md-3 col-sm-6">
												<p class="metric-inline" style="font-size: 25px;">
													<i class="lnr lnr-user" style="font-size: 40px; font-weight: 600;"></i> Gaji Pegawai <span>
														<a href="<?= base_url('DataP/lapTOT'); ?>" target="_blank">Print</a>
													</span>
												</p>
											</div>
											
										</div>
									</div>
								</div>

							</div>
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
