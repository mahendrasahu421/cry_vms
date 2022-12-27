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

<img src="<?php echo base_url('users/'); ?>assets/images/logo.png" alt="" class="logo" width="150px">
</a>
<a href="#!" class="mob-toggler">
<i class="feather icon-more-vertical"></i>
</a>
</div>
<div class="collapse navbar-collapse">

<ul class="navbar-nav ml-auto">
<!--<li>
<div class="dropdown">
<a class="dropdown-toggle" href="#" data-toggle="dropdown">
<i class="fa fa-bell-o"></i>
<span class="badge badge-pill badge-danger">5</span>
</a>
<div class="dropdown-menu dropdown-menu-right notification">
<div class="noti-head">
<h6 class="d-inline-block m-b-0">Notifications</h6>
<div class="float-right">
<a href="#!" class="m-r-10">mark as read</a>
<a href="#!">clear all</a>
</div>
</div>
<ul class="noti-body">
<li class="n-title">
<p class="m-b-0">NEW</p>
</li>
<li class="notification">
<div class="media">
<img class="img-radius" src="<?php echo base_url('users/'); ?>assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
 <div class="media-body">
<p><strong>John Doe</strong><span class="n-time text-muted"><i class="fa fa-clock m-r-10"></i>5 min</span></p>
<p>New ticket Added</p>
</div>
</div>
</li>
<li class="n-title">
<p class="m-b-0">EARLIER</p>
</li>
<li class="notification">
<div class="media">
<img class="img-radius" src="<?php echo base_url('users/'); ?>assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
<div class="media-body">
<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="fa fa-clock m-r-10"></i>10 min</span></p>
<p>Prchace New Theme and make payment</p>
</div>
</div>
</li>
<li class="notification">
<div class="media">
<img class="img-radius" src="<?php echo base_url('users/'); ?>assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
<div class="media-body">
<p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="fa fa-clock m-r-10"></i>12 min</span></p>
<p>currently login</p>
</div>
</div>
</li>
<li class="notification">
<div class="media">
<img class="img-radius" src="<?php echo base_url('users/'); ?>assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
<div class="media-body">
<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="fa fa-clock m-r-10"></i>30 min</span></p>
<p>Prchace New Theme and make payment</p>
</div>
</div>
</li>
</ul>
<div class="noti-footer">
<a href="#!">show all</a>
</div>
</div>
</div>
</li>-->

<li>
<div class="dropdown drp-user">
<?php  if($userDetails[0]['profile']!=''){ ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php $image = $userDetails[0]['profile']; echo base_url("user_profile/$image"); ?>" class="img-radius border" alt="User-Profile-Image">
</a>
<?php } else {?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo base_url('users/'); ?>assets/images/user/avatar-2.jpg" class="img-radius" alt="User-Profile-Image">
</a>
<?php } ?>
	
<div class="dropdown-menu dropdown-menu-right profile-notification">
<div class="pro-head">
<?php  if($userDetails[0]['profile']!=''){ ?>
<img src="<?php $image = $userDetails[0]['profile']; echo base_url("user_profile/$image"); ?>" class="img-radius" alt="User-Profile-Image">
<?php } else {?>
<img src="<?php echo base_url('users/'); ?>assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
<?php } ?>
<span><?php echo ucwords($userDetails[0]['firstName']);?> <?php echo ucwords($userDetails[0]['lastName']);?></span>
<a href="<?php echo base_url('logout'); ?>" class="dud-logout" title="Logout">
<i class="fa fa-lock"></i>
</a>
</div>
<ul class="pro-body">
<li><a href="<?php echo base_url('profile'); ?>" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></li>
<li><a href="<?php echo base_url('change-password'); ?>" class="dropdown-item"><i class="fa fa-key"></i> Change Passwpord</a></li>
<!--<li><a href="#" class="dropdown-item"><i class="fa fa-cog"></i> Setting</a></li>-->
<li><a href="<?php echo base_url('logout'); ?>" class="dropdown-item"><i class="fa fa-lock"></i> Logout</a></li>
</ul>
</div>
</div>
</li>
</ul>
</div>
</div>
</header>