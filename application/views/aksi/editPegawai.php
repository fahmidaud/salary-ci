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
							<h2 class="section-title"><i class="lnr lnr-cog"></i> Edit Data Pegawai</h2>
						</div>
						<div class="panel-content">
							<div class="row col-md-6" style="padding: 20px;">

								<?= form_open_multipart('Datauser/updatePegawai'); ?>

								<div class="profile-section" >
									<div class="media">
										<div class="media-left" style="min-width: 300px;">
											<?php foreach ($pegawai as $p) : ?>
												<img src="<?= base_url('assets/img/').$p['photo']; ?>" class="user-photo media-object" alt="User" style="max-width: 100%;
												max-height: 100%;">
											<?php endforeach; ?>
										</div>
										<div class="media-body" >
											<!-- <p>Upload your photo.
												<br> <em>Image should be at least 140px x 140px</em></p>
												<button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload Photo</button>
												<input type="file" id="filePhoto" class="sr-only"> -->

												<div class="custom-file">
													<input type="file" class="custom-file-input" id="photo" name="photo">
													<label class="custom-file-label" for="photo">Choose file</label>
												</div>
											</div>
										</div>
									</div>
									<div class="profile-section">
										<h2 class="profile-heading" style="visibility: hidden;">Basic Information</h2>
										<div class="clearfix">
											<!-- LEFT SECTION -->
											<div class="left">

												<?php foreach ($pegawai as $p) : ?>

													<input type="hidden" class="form-control" value="<?= $p['nip']; ?>" name="nip">

													<div class="form-group">
														<label>Nama Lengkap</label>
														<input type="text" class="form-control" value="<?= $p['namalengkap']; ?>" name="nama" onkeypress="return event.charCode < 48 || event.charCode  >57" maxlength="42">
													</div>

													<div class="form-group">									
														<label>Jabatan</label>									
														<select class="form-control" name="kode_jabatan">
															<?php
															$sqlJabatan = "SELECT * FROM jabatan ORDER BY kode_jabatan ASC";

															$query = $this->db->query($sqlJabatan)->result_array();

															foreach ($query as $k) {
																$selected = ($k['kode_jabatan'] == $p['kode_jabatan']) ? 'selected="selected"' : "";
																echo "
																<option value='$k[kode_jabatan]' $selected>$k[kode_jabatan] - $k[nama_jabatan]</option>
																";
															}
															?>
														</select>
													</div>

													<div class="form-group">									
														<label>Golongan</label>									
														<select class="form-control" name="kode_golongan">
															<?php
															$sqlGolongan = "SELECT * FROM golongan ORDER BY kode_golongan ASC";

															$query = $this->db->query($sqlGolongan)->result_array();

															foreach ($query as $k) {
																$selected = ($k['kode_golongan'] == $p['kode_golongan']) ? 'selected="selected"' : "";
																echo "
																<option value='$k[kode_golongan]' $selected>$k[kode_golongan] - $k[nama_golongan]</option>
																";
															}
															?>								
														</select>
													</div>	

													<div class="form-group">									
														<label>Status</label>	
														<select name="status" class="form-control" id="status" onChange="autoAnak()">
															<option value="<?php echo $p['status'];?>" selected><?php echo $p['status'];?></option>
															<option disabled value="">Ubah ke: </option>
															<option value="Menikah">Menikah</option>
															<option value="Belum Menikah">Belum Menikah</option>
														</select>								
														
													</div>

													<div class="form-group">
														<label>Alamat</label>
														<input type="text" class="form-control" value="<?= $p['alamat']; ?>" name="alamat" id="alamat" required>
													</div>

													<div class="form-group">
														<label>No Telp</label>
														<input type="number" class="form-control" value="<?= $p['notelp']; ?>" name="notelp" id="notelp" required>
													</div>

													<div class="form-group">
														<label>Jumlah Anak</label>
														<input type="number" class="form-control" value="<?= $p['jumlah_anak']; ?>" name="jumlah_anak" id="jumlah_anak" required>
													</div>

													<div class="form-group">
														<label>Email</label>
														<input type="email" class="form-control" value="<?= $p['email']; ?>" name="email" id="form-input">
													</div>
													<div class="form-group">
														<label>Username</label>
														<input type="text" class="form-control" value="<?= $p['username']; ?>" name="username" id="form-input1" maxlength="42" readonly>
													</div>
													<div class="form-group">
														<label>Password Baru</label>
														<input type="password" class="form-control" placeholder="Bisa dikosongkan" name="passlama">
													</div>
													<div class="form-group">
														<label>Konfirmasi Password</label>
														<input type="password" class="form-control" placeholder="Bisa dikosongkan" name="passbaru">
													</div>



												<?php endforeach; ?>

												<p class="margin-top-30">
													<button type="submit" name="update" class="btn btn-primary">Update</button> &nbsp;&nbsp;
													<button type="submit" name="cancel" class="btn btn-default">Cancel</button>
												</p>								

											</div>
											<!-- END LEFT SECTION -->
										</div>								

									</div>

								</form>
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

			function autoAnak(){
				var status = $('#status').val();
				if(status == 'Belum Menikah'){
					$('#jumlah_anak').val('0');
					$('#jumlah_anak').prop('readonly', true);
				}else{
					$('#jumlah_anak').val();
					$('#jumlah_anak').prop('readonly', false);
				}
			}
		</script>
	</body>

	</html>
