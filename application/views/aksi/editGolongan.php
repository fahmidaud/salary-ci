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
									<li class="active"><a href="<?= base_url("DataP/data_golongan"); ?>">Data Golongan</a></li>
									<li class=""><a href="<?= base_url("DataP/data_kehadiran"); ?>">Data Kehadiran</a></li>
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
					<h1 class="sr-only">Data Golongan</h1>
					<!-- WEBSITE ANALYTICS -->
					<div class="dashboard-section">
						<div class="section-heading clearfix">
							<h2 class="section-title"><i class="lnr lnr-cog"></i> Edit Data Golongan</h2>
						</div>
						<div class="panel-content">
							<div class="row col-md-6" style="padding: 0px 20px;">
								<div class="profile-section">
									<h2 class="profile-heading" style="visibility: hidden;">Basic Information</h2>
									<div class="clearfix">
										<?php foreach ($golongan as $j) : ?>

											<form method="POST" action="<?= base_url('DataP/updateGol'); ?>">

												<div class="form-group">
													<label>Kode Golongan</label>
													<input type="text" class="form-control" value="<?= $j['kode_golongan']; ?>" name="kode_golongan" readonly>
												</div>

												<div class="form-group">
													<label>Nama Golongan</label>
													<input type="text" class="form-control" value="<?= $j['nama_golongan']; ?>" name="nama_golongan" required>
												</div>

												<div class="form-group">
													<label>Tunjangan S/I</label>
													<input type="number" class="form-control" value="<?= $j['tunjangan_suami_istri']; ?>" name="tjsi" required>
												</div>

												<div class="form-group">
													<label>Tunjangan Anak</label>
													<input type="number" class="form-control" value="<?= $j['tunjangan_anak']; ?>" name="tunjangan_anak" required>
												</div>

												<div class="form-group">
													<label>Uang Makan</label>
													<input type="number" class="form-control" value="<?= $j['uang_makan']; ?>" name="uang_makan" required>
												</div>

												<div class="form-group">
													<label>Uang Lembur</label>
													<input type="number" class="form-control" value="<?= $j['uang_lembur']; ?>" name="uang_lembur" required>
												</div>

												<div class="form-group">
													<label>Asuransi Kesehatan</label>
													<input type="number" class="form-control" value="<?= $j['asuransi_kesehatan']; ?>" name="ak" required>
												</div>

												<button type="submit" name="close" class="btn btn-default"><i class="fa fa-times-circle"></i> Close</button>
												<button type="submit" name="update" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>

											</form>

										<?php endforeach; ?>
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


		<script type="text/javascript">
			$(document).ready(function(){
				$('.data').DataTable();
			});
		</script>
	</body>

	</html>
