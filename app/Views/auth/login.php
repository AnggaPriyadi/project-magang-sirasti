<?php

?>
<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Sistem Informasi Infrastruktur IT</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/vendors/images/cropped-inti-2 (2)">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/vendors/images/cropped-inti-2.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/vendors/images/cropped-inti-2.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Hind:wght@700&display=swap" rel="stylesheet">
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/style.css">


	<!-- js -->
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/script.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/jquery.validate.js"></script>
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login">
					<img src="<?php echo base_url(); ?>assets/vendors/images/Industri_Telekomunikasi_Indonesia_Logo.svg" style="height:90%"
						alt="SI Infrastruktur IT">
					<h3 class="text-blue" style="font-family: 'Hind', sans-serif; line-height: 50px; letter-spacing: -0.5px;">&nbsp; SI Infrastruktur IT</h3>
				</a>
			</div>
			<div class="login-menu">
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<?php 
				if (session('error') !== null) {
					$session = session('error');
					
					echo '
					<div class="modal fade" id="alert-modal-error-login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content bg-danger text-white">
								<div class="modal-body text-center">
									<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Gagal Login</h3>
									<p>'.$session. '</p>
									<button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>

					<script>
						$("#alert-modal-error-login").modal("show");
					</script>
					';

				}
			?>
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?php echo base_url(); ?>assets/vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login Ke SI Infrastruktur IT</h2>
						</div>

						<form id="form-login" action="<?= site_url('auth/authenticate') ?>" method="POST">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="role" id="admin" value="admin"
											required>
										<div class="icon"><img src="<?php echo base_url(); ?>assets/vendors/images/briefcase.svg" class="svg"
												alt=""></div>
										<span>Saya</span>
										Admin
									</label>
									<label class="btn">
										<input type="radio" name="role" id="operator"
											value="operator" required>
										<div class="icon"><img src="<?php echo base_url(); ?>assets/vendors/images/person.svg" class="svg"
												alt=""></div>
										<span>Saya</span>
										Operator
									</label>
									<label for="role" class="error" style="display:none;">Please choose one.</label>
								</div>
							</div>
							<div class="form-group has-danger">
								<div class="input-group custom">
									<input id="username" name="username" type="text"
										class="form-control form-control-lg inputclass" placeholder="Username"
										onblur="cekEmptyUsername()" required>
									<div class="input-group-append custom">
										<span id="icon-user" class="input-group-text"><i
												class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
								<div id="userfeedback-salah" class="form-control-feedback" style="display:none">
									Username tidak boleh kosong.</div>
							</div>
							<div class="form-group has-danger">
								<div class="input-group custom">
									<input id="password" name="password" type="password"
										class="form-control form-control-lg inputclass" placeholder="Password"
										onblur="cekEmptyPassword()" required>
									<div class="input-group-append custom">
										<span id="icon-password" class="input-group-text"><i
												class="dw dw-padlock1"></i></span>
									</div>
								</div>
								<div id="passfeedback-salah" class="form-control-feedback" style="display:none">
									Password tidak boleh kosong.</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label href="<?= site_url('reset_password') ?>" class="custom-control-label"
											for="customCheck1">Remember</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<!-- <div class="font-16 weight-600 pb-20 text-center" data-color="#707373">TEKAN UNTUK LOGIN</div> -->
									<div class="input-group mb-0">
										<input id="buttonLogin" type="submit" class="btn btn-outline-primary btn-lg btn-block"
											value="Login"/>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function cekEmptyUsername() {

			if ($("#username").val() == '') {
				$("#username").closest('.form-control').addClass('form-control-danger');
				$('#userfeedback-salah').show();
				$('#icon-user').hide();

				document.getElementById("buttonLogin").disabled = true;

			} else if ($("#username").val() != '') {
				$("#username").closest('.form-control').removeClass('form-control-danger');
				$('#userfeedback-salah').hide();
				$('#icon-user').show();
				document.getElementById("buttonLogin").disabled = false;
			}
		}

		function cekEmptyPassword() {

			if ($("#password").val() == '') {
				$("#password").closest('.form-control').addClass('form-control-danger');
				$('#passfeedback-salah').show();
				$('#icon-password').hide();

				document.getElementById("buttonLogin").disabled = true;

			} else if ($("#password").val() != '') {
				$("#password").closest('.form-control').removeClass('form-control-danger');
				$('#passfeedback-salah').hide();
				$('#icon-password').show();

				document.getElementById("buttonLogin").disabled = false;
			}
		}

	</script>
</body>

</html>
