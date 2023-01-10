<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login | Caritas Volunteer Management</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, users-scalable=0, minimal-ui">
	<link rel="icon" href="https://www.caritasindia.org/wp-content/themes/wisdom-responsive/images/favicon.ico" type="image/x-icon">
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

<body>
	<div class="auth-wrapper">
		<div class="auth-content text-center">
			<img src="<?php echo base_url('users/'); ?>assets/images/cry-image-vms.gif" alt="" class="img-fluid mb-4" width="135px">
			<p style="padding: 10px;background: #fff70f;border-radius:5px;">Know about <a href="https://www.caritasindia.org/covid-19/" target="_blank">(COVID-19)</a></p>
			<!--<a href="https://www.caritasindia.org/covid-19/"target="_blank">
    <img src="<?php echo base_url('users/'); ?>assets/images/safety-guidelines.jpeg" style="width:285px;border-radius: 5px;" class="mb-3 img-responsive"/></a>-->
			<?php
			if ($this->session->userdata('error')) {
			?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Error!</strong> <?php echo $this->session->userdata('error'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php $this->session->unset_userdata('error');
			} ?>
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="card-body">
							<h4 class="mb-3 f-w-400">Login</h4>
							<style>
								.error {
									width: 100%;
									text-align: left;
									color: red;
								}
							</style>
							<form action="#" method="post">
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Email address or mobile number" name="email" value="<?php echo $email; ?>">
									<?php echo form_error('email', '<div class="error">', '</div>'); ?>
								</div>
								<div class="input-group mb-4">
									<input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password; ?>">
									<?php echo form_error('password', '<div class="error">', '</div>'); ?>
								</div>
								<button class="btn btn-block btn-primary mb-4 rounded-pill" type="submit" name="signin" value="signin">Signin</button>
							</form>
							<p class="mb-2 text-muted">Login With Mobile Number? <a href="<?php echo base_url(); ?>otp-login" class="f-w-400">Click Here</a></p>
							<p class="mb-2 text-muted">Forgot password? <a href="<?php echo base_url(); ?>reset-password" class="f-w-400">Reset</a></p>
							<p class="mb-0 text-muted">Don’t have an account? <a href="<?php echo base_url(); ?>signup" class="f-w-400">Signup</a></p>
							<p class="mb-0 text-muted"><a href="<?php echo base_url(); ?>partner-login" class="f-w-400">Patners Login</a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="saprator my-4"><span>OR</span></div>
				<button class="btn text-white btn-primary mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fa fa-linkedin"></i></button>
				<button class="btn text-white btn-primary mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fa fa-twitter"></i></button>

			</div>
		</div>
		<svg width="100%" height="250px" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave bg-wave">
			<title>Wave</title>
			<defs></defs>
			<path id="feel-the-wave" d="" />
		</svg>
		<svg width="100%" height="250px" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave bg-wave">
			<title>Wave</title>
			<defs></defs>
			<path id="feel-the-wave-two" d="" />
		</svg>
		<svg width="100%" height="250px" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave bg-wave">
			<title>Wave</title>
			<defs></defs>
			<path id="feel-the-wave-three" d="" />
		</svg>
	</div>

	<!--<footer>
<p class="text-center mt-3">Copyright 2020 All Rights Reserved | Developed By <a href="http://www.neuralinfo.in/" target="_blank">Neural Info Solutions Pvt. Ltd.</a></p>
</footer>-->
<script src="<?php echo base_url('users/'); ?>assets/js/jquery.min.js"></script>

	<!-- BOOTSTRAP JS -->
	<script src="<?php echo base_url('users/'); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url('users/'); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- SPARKLINE JS -->
	<script src="<?php echo base_url('users/'); ?>assets/js/jquery.sparkline.min.js"></script>

	<!-- CHART-CIRCLE JS -->
	<script src="<?php echo base_url('users/'); ?>assets/js/circle-progress.min.js"></script>

	<!-- Perfect SCROLLBAR JS-->
	<script src="<?php echo base_url('users/'); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>

	<!-- INPUT MASK JS -->
	<script src="<?php echo base_url('users/'); ?>assets/plugins/input-mask/jquery.mask.min.js"></script>

	<!-- Color Theme js -->
	<script src="<?php echo base_url('users/'); ?>assets/js/themeColors.js"></script>

	<!-- CUSTOM JS -->
	<script src="<?php echo base_url('users/'); ?>assets/js/custom.js"></script>


	<script>
		$('#feel-the-wave').wavify({
			height: 100,
			bones: 3,
			amplitude: 90,
			color: 'rgba(146, 43, 33 , 4)',
			speed: .25
		});
		$('#feel-the-wave-two').wavify({
			height: 70,
			bones: 5,
			amplitude: 60,
			color: 'rgba(169, 50, 38 , .3)',
			speed: .35
		});
		$('#feel-the-wave-three').wavify({
			height: 50,
			bones: 4,
			amplitude: 50,
			color: 'rgba(192, 57, 43 , .2)',
			speed: .45
		});
	</script>
</body>

</html>