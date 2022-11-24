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
							<li class="active">
								<a href="#uiElements" class="has-arrow" aria-expanded="true"><i class="lnr lnr-users"></i> <span>Data User</span></a>
								<ul aria-expanded="true">
									<li class=""><a href="<?= base_url("Datauser/data_admin"); ?>">Data Admin</a></li>
									<li class="active"><a href="<?= base_url("Datauser/data_pegawai"); ?>">Data Pegawai</a></li>
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
						</ul>
					</nav>
					
				</div>
			</div>
			<!-- END LEFT SIDEBAR -->


			<!-- MAIN CONTENT -->
			<div id="main-content">
				<div class="container-fluid">
					<h1 class="sr-only">Data Pegawai</h1>
					<!-- WEBSITE ANALYTICS -->
					<div class="dashboard-section">
						<div class="section-heading clearfix">
							<h2 class="section-title"><i class="lnr lnr-users"></i> Data Pegawai</h2>
						</div>
						<div class="panel-content">
							

							<div class="row" style="padding: 20px;">
								
								<table class="table table-striped table-bordered data">
									<thead>
										<tr>			
											<th class="text-center">No</th>
											<th class="text-center">NIP</th>
											<th class="text-center">Nama</th>
											<th class="text-center">Jabatan</th>
											<th class="text-center">Golongan</th>
											<th class="text-center">Status</th>
											<th class="text-center">Jumlah Anak</th>
											<th class="text-center">Alamat</th>
											<th class="text-center">No Telp</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>
										<?php foreach ($pegawai as $p) : ?>											

											<tr>				
												<td class="text-center"><?= $no++; ?></td>
												<td class="text-center"><?= $p['nip']; ?></td>
												<td class="text-center"><?= $p['namalengkap']; ?></td>
												<td class="text-center"><?= $p['nama_jabatan']; ?></td>
												<td class="text-center"><?= $p['nama_golongan']; ?></td>
												<td class="text-center"><?= $p['status']; ?></td>
												<td class="text-center"><?= $p['jumlah_anak']; ?></td>
												<td class="text-center"><?= $p['alamat']; ?></td>
												<td class="text-center"><?= $p['notelp']; ?></td>
												<td class="text-center">

													<form method="POST" action="<?= base_url("Datauser/editPegawai"); ?>"> 
														<input type="hidden" name="nip" value="<?= $p['nip']; ?>">

														<button type="submit" name="edit" class="btn btn-default" title="Edit" style="background-color: #3367D6;"><span class="sr-only">Edit</span> <i class="lnr lnr-pencil" style="font-weight: 700; color: white;"></i></button>
														<button type="submit" name="delete" class="btn btn-danger" title="Delete" onclick="return confirm('Yakin ingin dihapus?');"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>
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

						<?= form_open_multipart('Datauser/tambahPegawai'); ?>

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">Tambah Pegawai</h4>
						</div>
						<div class="modal-body">

							<?php 

							$simbol = 01;
							$sql = "SELECT max(nip) AS last 
							FROM pegawai 
							WHERE nip 
							LIKE '$simbol%'
							";

							$query = $this->db->query($sql)->row_array();

							$kodeterakhir = $query['last'];

							$nomorterakhir = substr($kodeterakhir, 1, 2);

							$nextNomor = $nomorterakhir + 1;
							$nextKode = $simbol.sprintf('%02s',$nextNomor);


							?>

							<div class="form-group">
								<label>NIP</label>
								<input type="text" class="form-control" value="<?= $nextKode; ?>" name="nip" readonly>
							</div>

							<div class="form-group">
								<label>Foto</label>
								<input type="file" class="form-control" value="" name="photo" required>
							</div>
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" class="form-control" value="" name="nama" onkeypress="return event.charCode < 48 || event.charCode  >57" maxlength="42" required>
							</div>

							<div class="form-group">									
								<label>Jabatan</label>									
								<select class="form-control" name="kode_jabatan">
									<?php foreach ($jabatan as $j) : ?>
										<option value="<?= $j['kode_jabatan']; ?>"><?= $j['kode_jabatan'].' - '.$j['nama_jabatan']; ?></option>
									<?php endforeach; ?>									
								</select>
							</div>

							<div class="form-group">									
								<label>Golongan</label>									
								<select class="form-control" name="kode_golongan">
									<?php foreach ($golongan as $g) : ?>
										<option value="<?= $g['kode_golongan']; ?>"><?= $g['kode_golongan'].' - '.$g['nama_golongan']; ?></option>
									<?php endforeach; ?>									
								</select>
							</div>		

							<div class="form-group">									
								<label>Status</label>									
								<select class="form-control" name="status" id="status" onChange="autoAnak()">
									<option disabled selected value="">Pilih Status</option>
									<option value="Belum Menikah">Belum Menikah</option>
									<option value="Menikah">Menikah</option>
								</select>
							</div>

							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" value="" name="alamat" required>
							</div>

							<div class="form-group">
								<label>No Telp</label>
								<input type="number" class="form-control" value="" name="notelp" required>
							</div>

							<div class="form-group">
								<label>Jumlah Anak</label>
								<input type="number" class="form-control" value="" name="jumlah_anak" id="jumlah_anak" required>
							</div>

							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" value="" name="email" id="form-input" required>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" value="" name="username" required id="form-input1" maxlength="42">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" placeholder="" name="pass" required>
							</div>
							<div class="form-group">
								<label>Konfirmasi Password</label>
								<input type="password" class="form-control" placeholder="" name="passC" required>
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

		function autoAnak(){
			var status = $('#status').val();
			if(status == 'Belum Menikah'){
				$('#jumlah_anak').val('0');
				$('#jumlah_anak').prop('readonly', true);
			}else{
				$('#jumlah_anak').val('0');
				$('#jumlah_anak').prop('readonly', false);
			}
		}
	</script>

</body>

</html>
