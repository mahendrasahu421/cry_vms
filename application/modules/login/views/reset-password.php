<?php $base_url = base_url() . 'admin_assets/'; ?>
<!doctype html>
<html lang="en" dir="ltr">

<head>

	<!-- META DATA -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon-2.png" />

	<!-- TITLE -->
	<title>CRY: VMS</title>

	<!-- BOOTSTRAP CSS -->
	<link id="style" href="<?php echo base_url('users/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- STYLE CSS -->
	<link href="<?php echo base_url('users/'); ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url('users/'); ?>assets/css/dark-style.css" rel="stylesheet" />
	<link href="<?php echo base_url('users/'); ?>assets/css/skin-modes.css" rel="stylesheet" />
	<link href="<?php echo base_url('users/'); ?>assets/css/transparent-style.css" rel="stylesheet" />

	<!--- FONT-ICONS CSS -->
	<link href="<?php echo base_url('users/'); ?>assets/css/icons.css" rel="stylesheet" />

	<!-- COLOR SKIN CSS -->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('users/'); ?>assets/colors/color1.css" />

</head>
<!-- <style>
    .login100-form {
		width: 573px;
	}
</style> -->

<body>

	<!-- BACKGROUND-IMAGE -->
	<div class="bg-warning">

		<!-- GLOABAL LOADER -->
		<div id="global-loader">
			<img src="<?php echo base_url('users/'); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End GLOABAL LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="">

				<!-- CONTAINER OPEN -->
				<div class="col col-login mx-auto">
					<div class="text-center">
						<img src="<?php echo base_url('users/'); ?>assets/images/brand/ezgif.com-gif-maker.gif" class="" alt="">
					</div>
				</div>
				<div class="container-login100">
					<div class="wrap-login100 p-0">
						<div class="card-body">
							<form class="login100-form validate-form">
								<span class="login100-form-title">
									Forgot Password
								</span>
								<label class="form-label fw-bold">Enter Registered Email Id</label>
								<div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
									<input class="input100" type="text" name="email" placeholder="Email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-email" aria-hidden="true"></i>
									</span>
								</div>


								<div class="container-login100-form-btn">
									<a href="dashboard" class="login100-form-btn btn-warning">
										Login
									</a>
								</div>
								<div class="text-center pt-3">
									<p class="text-dark mb-0">Not a member?<a href="<?php echo base_url(); ?>signup" class="text-warning ms-1">Create an Account</a></p>
								</div>
							</form>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-center my-3">
								<a href="" class="social-login  text-center me-4">
									<i class="fa fa-google"></i>
								</a>
								<a href="" class="social-login  text-center me-4">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="" class="social-login  text-center">
									<i class="fa fa-twitter"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- CONTAINER CLOSED -->
			</div>
		</div>
		<!--END PAGE -->

	</div>
	<!-- BACKGROUND-IMAGE CLOSED -->

	<!-- JQUERY JS -->
	<script src="<?php echo base_url('users/'); ?>assets/js/jquery.min.js"></script>

	<!-- BOOTSTRAP JS -->
	<script src="<?php echo base_url('users/'); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url('users/'); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- SPARKLINE JS-->
	<script src="<?php echo base_url('users/'); ?>assets/js/jquery.sparkline.min.js"></script>

	<!-- CHART-CIRCLE JS-->
	<script src="<?php echo base_url('users/'); ?>assets/js/circle-progress.min.js"></script>

	<!-- Perfect SCROLLBAR JS-->
	<script src="<?php echo base_url('users/'); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>

	<!-- INPUT MASK JS-->
	<script src="<?php echo base_url('users/'); ?>assets/plugins/input-mask/jquery.mask.min.js"></script>

	<!-- Color Theme js -->
	<script src="<?php echo base_url('users/'); ?>assets/js/themeColors.js"></script>

	<!-- CUSTOM JS -->
	<script src="<?php echo base_url('users/'); ?>assets/js/custom.js"></script>

</body>

</html>