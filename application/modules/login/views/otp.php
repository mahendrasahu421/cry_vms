<!DOCTYPE html>
<html lang="en">
<head>
<title>Verify OTP | Caritas Volunteer Management</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon-2.png" />
<link rel="stylesheet" href="<?php echo base_url('users/'); ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url('users/'); ?>assets/mystyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
@media screen and (min-width: 320px) {
  .pad-75 {
  padding: 10px;
  top:0px;}
  
  .auth-wrapper {
      display: flow-root;}
  .card{width:59%;
  }
 .card-body {
    padding: 0px 0px; 
  }
  .auth-wrapper .auth-content {
    padding: 5px;
	}
 .auth-wrapper .auth-content:not(.container) .card-body  {
    padding: 12px 2px 10px 2px !important
}
  
}
@media only screen and (max-width: 767px){
.auth-wrapper .auth-content:not(.container) .card-body  {
    padding: 12px 2px 10px 2px !important
} }

</style>
<style>
@media screen and (min-width: 420px){
  .pad-75 {
  padding: 10px;
  top:0px;}
  
  .auth-wrapper {
      display: flow-root;}
  .card{width:59%;
  }
 .card-body {
    padding: 0px 0px; 
  }
  .auth-wrapper .auth-content {
    padding: 5px;
	}
	.auth-wrapper .auth-content:not(.container) .card-body  {
    padding: 12px 2px 10px 2px !important
}
}
</style>
<style>
@media screen and (min-width: 780px) {
  .pad-75 {
  padding: 10px;
  top:0px;}
  
  .auth-wrapper {
      display: flow-root;}
  .card{width:100%;
  }
 .card-body {
    padding: 0px 0px; 
  }
  .auth-wrapper .auth-content {
    padding: 5px;
	}
}
</style>
<style>
@media screen and (min-width: 1300px) {
  .pad-75 {
  padding: 40px;
  top:0px;}
  
  .auth-wrapper {
      display: flex;}
  .card{width:100%;
  }
 .card-body {
    padding: 0px 0px; 
  }
  .auth-wrapper .auth-content {
    padding: 5px;
	}
	.mob-cause{display:none;}
}
</style>
</head>
<body>

<div class="row">
<div class="auth-wrapper signup-img">
<div class="col-lg-6 col-md-12 pad-75">
<!--<center><img src="<?php echo base_url('users/'); ?>assets/images/caritaswhitelogo.png" alt="" class="img-fluid mb-4" width="140px"></center>-->
	<h3 class="f-w-400 text-center text-white">Become a Caritas India Volunteer</h3>
	<center><span class="small text-center mb-4 text-white">Already have an account? Click here to <a href="login" style="color:#fff">login.</a></span></center><br>
	<p class ="text-white" style="line-height: 30px;">Before you register, please take the time to familiarize yourself with the values and commitment, we expect from all Caritas India volunteers, and basic requirement for anyone wishing to create an account in volunteers candidate pool.</p>
	<div class="valuesCommit mt-3">
	<h6 class=" text-white">Values and Commitment</h6>
		<ul class="text-white">
			<li class="text-white">We expect volunteers to be strongly committed to the values and principles of volunteerism.</li>
			<li class="text-white">We expect volunteers to be able to work in a multi-cultural environment.</li>
			<li class="text-white">We expect volunteers to be able to adjust to difficult living conditions.</li>
			<li class="text-white">We expect volunteers to have strong interpersonal and organizational skills.</li>
		</ul>
		<!--<div class="valBtnBox"><a class="valBtn" data-target="#myModal" data-toggle="modal" href="javascript:void(0);">Please consult the professional areas in demand before you apply.</a></div>-->
	</div>
</div>

<div class="col-lg-6 col-md-12 text-center">
<div class="auth-wrapper">
<div class="auth-content text-center mt-2 mb-2" style="border: 5px solid #fff;">
<?php //echo validation_errors(); ?>
<?php
if($this->session->userdata('success'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> <?php echo $this->session->userdata('success'); ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('success'); } ?>
<!--<img src="<?php echo base_url('users/'); ?>assets/images/logo.png" alt="" class="img-fluid mb-4" width="135px">-->
<div class="card">
<div class="row align-items-center ">
<div class="col-md-12">
<div class="card-body">
<h4 class="mb-3 f-w-400">Verify OTP</h4>
<style>
	.error
	{
		width:100%;
		text-align:left;
		color:red;
	}
#calendar_details_b2c,
#calendar_details_b2b
{
    display: none;
}
.signup-img{background: url(<?php echo base_url('users/'); ?>assets/images/caritas-s.jpg) no-repeat fixed !important;}
</style>
<form class='form_div'>
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="OTP" name="uotp" id="uotp" required value="" autocomlpete="off">
<input type="hidden" id="email" name="email" value="<?php echo $email?>" />
<input type="hidden" id="userid" name="userid" value="<?php echo trim($userID)?>" />
</div>
<button class="btn btn-primary btn-block mb-4 rounded-pill" type="button" id="otp" name="otp" value="otp">Submit</button>
</form>
<span id='message'></span>
<p class="mb-2 success">Resend <a href="" class="f-w-400">OTP</a></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<footer>
<p class="text-center mt-3">Copyright <?php echo date('Y');?> All Rights Reserved | Developed By <a href="http://www.neuralinfo.in/" target="_blank">Neural Info Solutions Pvt. Ltd.</a></p>
</footer>

<script src="<?php echo base_url('users/'); ?>assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/menu-setting.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/waves.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/TweenMax.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/jquery.wavify.js"></script>
<script>
  $('document').ready(function(){
   $('#otp').on('click',function(){
    var uid = $('#userid').val();
    var uotp = $('#uotp').val();
        $.ajax({
        url: '<?php echo base_url(); ?>verfy-mobile-otp',
        type: 'POST',
        data:{uid:uid,uotp:uotp},
        cache:false,
        success: function(response){
         if(response.trim() =='2'){
          $('#message').html('<p style="color:red;">Invalid OTP! Try Again</p>');
          $('.success').html('');
         }
         else{
          $('#message').html('');
          $('.form_div').hide();
          $('.success').html('OTP verified Successfully. <a href="<?php echo base_url()?>login" style="color:blue;">Click Here</a> to log in.'); 
         }
        },
      });
   });
  })
</script>
<script>
$('body').bind('copy paste',function(e) {
    e.preventDefault(); return false; 
});
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
<script src="<?php echo base_url('users/'); ?>assets/js/my_js.js"></script>


</body>
</html>
