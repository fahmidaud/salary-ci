<!doctype html>
<html lang="en">

<head>
	<title><?= $title; ?> | Pixel Salary</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/linearicons/style.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/metisMenu/metisMenu.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/chartist/css/chartist.min.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("assets/vendor/toastr/toastr.min.css"); ?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url("assets/css/main.css"); ?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url("assets/css/demo.css"); ?>">
	<!-- GOOGLE FONTS -->
	<link href="<?= base_url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700"); ?>" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url("assets/img/apple-icon.png"); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url("assets/img/favicon.png"); ?>">

	<script src="<?= base_url("assets/vendor/jquery/jquery.min.js"); ?>"></script>

	<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/datatables.min.css"); ?>">

	<!-- STYLE Qu -->
	<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/style.css"); ?>">

	<script type="text/javascript">
		// USERNAME MENCEGAH SPASI
		$(document).ready(function(){
			$("#form-input").on({
				keydown: function(e) {
					if (e.which === 32)
						return false;
				},
				keyup: function(){
					this.value = this.value.toLowerCase();
				},
				change: function() {
					this.value = this.value.replace(/\s/g, "");

				}
			});

			$("#form-input1").on({
				keydown: function(e) {
					if (e.which === 32)
						return false;
				},
				keyup: function(){
					this.value = this.value.toLowerCase();
				},
				change: function() {
					this.value = this.value.replace(/\s/g, "");

				}
			});
		});
	</script>

</head>

