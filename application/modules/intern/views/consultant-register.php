<!DOCTYPE html>
<html lang="en">
<head>
<title>Signup | Caritas Volunteer Management</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<link rel="icon" href="https://www.caritasindia.org/wp-content/themes/wisdom-responsive/images/favicon.ico" type="image/x-icon">
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
@media screen and (min-width: 420px{
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
  padding: 75px;
  top:-75px;}
  
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
	<h6 class="mb-4 mt-4 text-white">Values and Commitment</h6>
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
<h4 class="mb-3 f-w-400">Sign up</h4>
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
<?php echo form_open('signup'); ?>
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="First name" style="margin-right: 5px;" name="fname" id="fname" required value="<?php echo set_value('fname'); ?>" autocomlpete="off">
<input type="text" class="form-control" placeholder="Last name" name="lname" id="lname" required value="<?php echo set_value('lname'); ?>" autocomlpete="off">
<?php echo form_error('fname', '<div class="error">', '</div>'); ?>
<?php echo form_error('lname', '<div class="error">', '</div>'); ?>
</div>
<div class="input-group mb-3">
<input type="email" class="form-control" placeholder="Email address" name="email" id="email" required value="<?php echo set_value('email'); ?>" autocomlpete="off">
<?php echo form_error('email', '<div class="error">', '</div>'); ?>
</div>
<div class="input-group mb-3">
<input type="email" class="form-control" placeholder="Confirm Email address" name="cemail" id="cemail" required value="<?php echo set_value('cemail'); ?>" autocomlpete="off">
<?php echo form_error('cemail', '<div class="error">', '</div>'); ?>
</div>
<div class="input-group mb-4">
<input type="password" class="form-control" placeholder="Password" name="password" id="password" required value="<?php echo set_value('password'); ?>" autocomlpete="off">
<?php echo form_error('password', '<div class="error">', '</div>'); ?>
</div>
<div class="input-group mb-4">
<input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword" required value="<?php echo set_value('cpassword'); ?>" autocomlpete="off">
<?php echo form_error('cpassword', '<div class="error">', '</div>'); ?>
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1" ><i class="fa fa-eye-slash" onclick="show('cpassword')" id="display"></i></span>
</div>
</div>
<script>
function show(a) {
  var x=document.getElementById(a);
  var c=x.nextElementSibling
  if (x.getAttribute('type') == "password") {
  //c.removeAttribute("class");
  //c.setAttribute("class","fa fa-eye");
  x.removeAttribute("type");
    x.setAttribute("type","text");
  } else {
  x.removeAttribute("type");
    x.setAttribute('type','password');
  //c.removeAttribute("class");
  //c.setAttribute("class","fa fa-eye-slash");
  }
}

</script>
<div class="input-group mb-4">
<input type="text" class="form-control" placeholder="Mobile No" name="mobile" id="mobile" required value="<?php echo set_value('mobile'); ?>" autocomlpete="off" minlength="10" maxlength="10">
<?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
</div>

<div class="input-group mb-4">
<select class="form-control" name="heard_us" id="heard_us" required >
<option value="">Heard about Caritas India Volunteer from</option>
<option value="Partner Organisation - DSSS">Partner Organisation - DSSS</option>
<option value="Regional Forum">Regional Forum</option>
<option value="Social Networking Sites">Social Networking Sites</option>
<option value="Caritas India Website">Caritas India Website</option>
<option value="Word of Mouth">Word of Mouth</option>
<option value="Other">Other</option>
</select>
<?php echo form_error('heard_us', '<div class="error">', '</div>'); ?>
</div>

<div class="input-group mb-4">
<select class="form-control" name="state_id" id="state_id" required >
<option value="">Choose State</option>
<?php foreach($states as $st){?>
<option value="<?php echo $st['stateID'];?>"><?php echo $st['stateName'];?></option>
<?php } ?>
</select>
<?php echo form_error('state_id', '<div class="error">', '</div>'); ?>
</div>

<div class="input-group mb-4">
 <h6>Area of Interest</h6>
<ul style="margin-left: -48px;">
<?php
foreach($aoi as $key=>$value)
{
?>
  <li><input type="checkbox" id="cb<?php echo $value['causesID'];?>" name="cb[]" value="<?php echo $value['causesID'];?>" />
    <label for="cb<?php echo $value['causesID'];?>">
        <img src="<?php echo base_url(); ?>aoi/<?php echo $value['causesImg'];?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo ucwords($value['causesName']);?>"/>
        <h6 class="mob-cause" style="font-size:12px;"><?php echo ucwords($value['causesName']);?></h6>
    </label>
  </li>
<?php } ?>
</ul>
<?php echo form_error('cb[]', '<div class="error">', '</div>'); ?>
</div>
<fieldset>
  <legend>Choose Diocese/Partner:</legend>
  <input type="radio" name="caritas" value="caritasIndia" >
  <span>Caritas India</span>
   <input type="radio" id="hii" name="caritas" value="dioceses">
  <span><input list="dioceses"  id="answerInput" placeholder="Choose Your Dioceses" style="border: none; width:180px;"/></label>
		<datalist id="dioceses" >
		<?php
		foreach($dioceses as $key=>$value1)
		{
		?>
		  <option data-value="<?php echo $value1['dioceses_id'];?>"><?php echo $value1['name'];?></option>
		<?php } ?>
		</datalist>
		<input type="hidden" name="dioceses" id="answerInput-hidden">
		
        <!--<select name="dioceses" id="dioceses" style="border: none;">
		<option value="0">Choose Your Dioceses</option>
		<?php
		foreach($dioceses as $key=>$value1)
		{
		?>
			<option value="<?php echo $value1['dioceses_id'];?>"><?php echo $value1['name'];?></option>
		<?php } ?>
		</select>-->
  </span>
  <?php echo form_error('caritas', '<div class="error">', '</div>'); ?>
</fieldset>
<button class="btn btn-primary btn-block mb-4 rounded-pill" type="submit" id="submit" name="signup" value="signup">Sign up</button>
</form>
<p class="mb-2">Already have an account? <a href="<?php echo base_url(); ?>login" class="f-w-400">Signin</a></p>
</div>
</div>
</div>
</div>
<!--<div class="text-center">
<div class="saprator my-4"><span>OR</span></div>
<button class="btn text-white btn-primary mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fa fa-linkedin"></i></button>
<button class="btn text-white btn-primary mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fa fa-twitter"></i></button>
</div>-->
</div>

</div>

</div>

<!--<svg width="100%" height="250px" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave bg-wave">
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
</svg>-->
</div>
</div>

<footer>
<p class="text-center mt-3">Copyright 2020 All Rights Reserved | Developed By <a href="http://www.neuralinfo.in/" target="_blank">Neural Info Solutions Pvt. Ltd.</a></p>
</footer>

<script src="<?php echo base_url('users/'); ?>assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/menu-setting.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/waves.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/TweenMax.min.js"></script>
<script src="<?php echo base_url('users/'); ?>assets/js/pages/jquery.wavify.js"></script>
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
<script>
	var cd = '<?php echo $cd; ?>';
	var splt = cd.split(',');
	//console.log(splt);
	$.each(splt, function( index, value ) {
	$("#cb"+value).attr('checked','checked');	
	//alert(value);
	});
</script>
<script>
    document.querySelector('input[list]').addEventListener('input', function(e) {
    var input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
        inputValue = input.value;

    hiddenInput.value = inputValue;

    for(var i = 0; i < options.length; i++) {
        var option = options[i];

        if(option.innerText === inputValue) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }
    }
});
</script>
</body>
</html>
