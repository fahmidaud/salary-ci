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
							<li class="dropdown">
								<a href="#" class="icon-menu" data-toggle="modal" data-target="#large-modal">
									<i class="lnr lnr-plus-circle"></i>
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
								<a href="#uiElements" class="has-arrow" aria-expanded="false"><i class="lnr lnr-users"></i> <span>Data User</span></a>
								<ul aria-expanded="true">
									<li class=""><a href="<?= base_url("Datauser/data_admin"); ?>">Data Admin</a></li>
									<li class=""><a href="<?= base_url("Datauser/data_pegawai"); ?>">Data Pegawai</a></li>
								</ul>
							</li>
							<li class="active">
								<a href="#subPages" class="has-arrow" aria-expanded="true"><i class="lnr lnr-apartment"></i> <span>Data Perusahaan</span></a>
								<ul aria-expanded="true">
									<li class="active"><a href="<?= base_url("DataP/data_jabatan"); ?>">Data Jabatan</a></li>
									<li class=""><a href="<?= base_url("DataP/data_golongan"); ?>">Data Golongan</a></li>
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
					<h1 class="sr-only">Data Jabatan</h1>
					<!-- WEBSITE ANALYTICS -->
					<div class="dashboard-section">
						<div class="section-heading clearfix">
							<h2 class="section-title"><i class="lnr lnr-license"></i> Data Jabatan</h2>
						</div>
						<div class="panel-content">
							

							<div class="row" style="padding: 20px;">
								
								<table class="table table-striped table-bordered data">
									<thead>
										<tr>			
											<th class="text-center">Kode</th>
											<th class="text-center">Jabatan</th>
											<th class="text-center">Gaji Pokok</th>
											<th class="text-center">Tunj Jabatan</th>
											<th class="text-center">Potongan Sakit</th>
											<th class="text-center">Potongan Izin</th>
											<th class="text-center">Potongan Alpha</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($jabatan as $j) : ?>

											<tr>				
												<td class="text-center"><?= $j['kode_jabatan']; ?></td>
												<td class="text-center"><?= $j['nama_jabatan']; ?></td>
												<td class="text-center"><?= "Rp ".number_format($j['gaji_pokok'],0,',','.'); ?></td>
												<td class="text-center"><?= "Rp ".number_format($j['tunjangan_jabatan'],0,',','.'); ?></td>
												<td class="text-center"><?= "Rp ".number_format($j['potongan_sakit'],0,',','.'); ?></td>
												<td class="text-center"><?= "Rp ".number_format($j['potongan_izin'],0,',','.'); ?></td>
												<td class="text-center"><?= "Rp ".number_format($j['potongan_alpha'],0,',','.'); ?></td>
												<td class="text-center">
													<form method="POST" action="<?= base_url('DataP/editJabatan'); ?>">
														<input type="hidden" name="kode_jabatan" value="<?= $j['kode_jabatan']; ?>">

														<button type="submit" class="btn btn-default" title="Edit" style="background-color: #3367D6;" name="edit"><span class="sr-only">Edit</span> <i class="lnr lnr-pencil" style="font-weight: 700; color: white;"></i></button>
														<button type="submit" class="btn btn-danger" name="delete" title="Delete" onclick="return confirm('Yakin ingin dihapus?');"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>

													</form>
												</td>
											</tr>

										<?php endforeach; ?>

									</tbody>
								</table>

							</div>

						</div>
					</div>
					<!-- END WEBSITE ANALYTICS -->

				</div>
			</div>


			<!-- TAMBAH DATA -->
			<div id="large-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">

						<form method="POST" action="<?= base_url('DataP/tambahJab'); ?>">

							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Data Jabatan</h4>
							</div>
							<div class="modal-body">

								<?php 
								$simbol = "J";
								$sql = "SELECT max(kode_jabatan) AS last FROM jabatan WHERE kode_jabatan LIKE '$simbol%'";
								$query = $this->db->query($sql)->row_array();

								$kodeterakhir = $query['last'];
								$nomorterakhir = substr($kodeterakhir, 1, 2);
								$nextNomor = $nomorterakhir + 1;
								$nextKode = $simbol.sprintf('%02s',$nextNomor);
								?>

								<div class="form-group">
									<label>Kode Jabatan</label>
									<input type="text" class="form-control" value="<?= $nextKode; ?>" name="kode_jabatan" readonly>
								</div>

								<div class="form-group">
									<label>Nama Jabatan</label>
									<input type="text" class="form-control" value="" name="nama_jabatan" required>
								</div>

								<div class="form-group">
									<label>Gaji Pokok</label>
									<input type="number" class="form-control" value="" name="gaji_pokok" required>
								</div>

								<div class="form-group">
									<label>Tunjangan Jabatan</label>
									<input type="number" class="form-control" value="" name="tunjangan_jabatan" required>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
								<button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Tambah</button>
							</div>

						</form>

					</div>
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
