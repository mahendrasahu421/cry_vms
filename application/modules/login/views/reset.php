<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Password | Caritas Volunteer Management </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon-2.png" />

<link rel="stylesheet" href="<?php echo base_url('users/'); ?>assets/css/style.css">
</head>
<body>

<div class="auth-wrapper">

<div class="auth-content text-center">
<img src="<?php echo base_url('users/'); ?>assets/images/logo.png" alt="" class="img-fluid mb-4" width="135px">
<p>Know about <a href="https://www.caritasindia.org/covid-19/"target="_blank">(COVID-19)</a></p>
<?php
if($this->session->userdata('resent_password_success'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> <?php echo $this->session->userdata('resent_password_success'); ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('resent_password_success'); } ?>
<div class="card">
<div class="row align-items-center ">
<div class="col-md-12">
<div class="card-body">
<h4 class="mb-3 f-w-400">Reset your password</h4>
<style>
	.error
	{
		width:100%;
		text-align:left;
		color:red;
	}
</style>
<?php echo form_open('reset/'.$link2); ?>
<input type="hidden" class="form-control" name="em" id="em" required autocomplete="off" value="<?php echo $link2; ?>">
	<div class="input-group mb-4">
		<input type="password" class="form-control" placeholder="New Password" name="npass" id="npass" required autocomplete="off">
		<?php echo form_error('npass', '<div class="error">', '</div>'); ?>
    </div>
    <div class="input-group mb-4">
		<input type="password" class="form-control" placeholder="Confirm New Password" name="cnpass" id="cnpass" required autocomplete="off">
		<?php echo form_error('cnpass', '<div class="error">', '</div>'); ?>
	</div>

<button class="btn btn-block btn-primary mb-4 rounded-pill" type="submit" value="change_password" name="change_password">Reset password</button>
</form>
<p class="mb-0 text-muted"><a href="<?php echo base_url();?>" class="f-w-400">Go Home</a></p>
</div>
</div>
</div>
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

<script src="<?php echo base_url('users/'); ?>assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/waves.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/TweenMax.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/jquery.wavify.js"></script>
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
