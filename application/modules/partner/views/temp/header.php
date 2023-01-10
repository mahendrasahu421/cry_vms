<?php 
$dioceses_id = $this->session->userdata('dioceses_id');
$partner_data=$this->Curl_model->fetch_all_data("name,profile_img",'dioceses','status=1 and dioceses_id='.$dioceses_id);
?>
<body>

<div class="loader-bg">
<div class="loader-track">
<div class="loader-fill"></div>
</div>
</div>



<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
<div class="content-main  container">
<div class="m-header">
<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
<a href="index.php" class="b-brand">

<img src="<?php echo base_url('admin/'); ?>assets/images/logo.png" alt="" class="logo" width="150px">
</a>
<a href="#!" class="mob-toggler">
<i class="feather icon-more-vertical"></i>
</a>
</div>
<div class="collapse navbar-collapse">

<ul class="navbar-nav ml-auto">
<li class="">Welcome <?php echo $partner_data[0]['name'];?> !</li>

<li>
<div class="dropdown drp-user">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php  if($partner_data[0]['profile_img']!=''){ ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php $image = $partner_data[0]['profile_img']; echo base_url("partner_profile/$image"); ?>" class="img-radius border" alt="User-Profile-Image" style="width: 45px;">
</a>
<?php } else {?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo base_url('users/'); ?>assets/images/user/avatar-2.jpg" class="img-radius" alt="User-Profile-Image" style="width: 45px;">
</a>
<?php } ?>
</a>
<div class="dropdown-menu dropdown-menu-right profile-notification">
<div class="pro-head">

<span>Partner</span>
<a href="#" class="dud-logout" title="Logout">
<i class="fa fa-lock"></i>
</a>
</div>
<ul class="pro-body">
<li><a href="<?php echo base_url('partner-profile'); ?>" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></li>
<li><a href="<?php echo base_url('partner-change-pwd'); ?>" class="dropdown-item"><i class="fa fa-key"></i> Change Password</a></li>
<li><a href="<?php echo base_url('partner-logout'); ?>" class="dropdown-item"><i class="fa fa-lock"></i> Logout</a></li>
</ul>
</div>
</div>
</li>
</ul>
</div>
</div>
</header>