<body>
	<?= $this->session->flashdata('message'); ?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box">
					<div class="content">
						<div class="header">
							<div class="logo text-center"><img src="assets/img/Pixel_logo.png" alt="DiffDash" style="width: 100px; height: 100px;"></div>
							<p class="lead">Login to your account</p>
						</div>
						<form class="form-auth-small" method="POST" action="<?= base_url("Auth/verf"); ?>">
							<div class="form-group">
								<label for="signin-email" class="control-label sr-only">Username</label>
								<input type="text" class="form-control" id="signin-email" value="" placeholder="Username" name="uname" required>
							</div>
							<div class="form-group">
								<label for="signin-password" class="control-label sr-only">Password</label>
								<input type="password" class="form-control" id="signin-password" value="" placeholder="Password" name="pass" required>
							</div>
							
							<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							<div class="bottom" style="visibility: hidden;">
								<span class="helper-text"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
