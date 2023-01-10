<style>
.table td, .table th {
	white-space: normal !important;
}
.tp{padding: 15px 9px !important;
	height:95px !important;}
</style>

<div class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-header-title">
<h5 class="m-b-10">Dashboard Analytics</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body tp">
<div class="d-flex pt-1 pb-1 no-block">
<div class="align-self-center mr-2 knob-icon">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#f95476" data-thickness=".2" value="0" />
<i class="fa fa-user text-danger"></i> </div>
<div class="align-slef-center mr-auto">
<h4 class="m-b-0 text-uppercase f-18 font-medium lp-5">Total Volunteer</h4>
<h5 class="text-muted m-b-0"><strong><?php echo $totalvolunteer; ?></strong> </h5>
</div>
</div>
</div>
</div>
</div>

<?php 
$h=0;
$m=0;
 foreach($reporttotal as $re){
   
   $splt_admin_time = explode('.',$re['admin_time']);
   $h += $splt_admin_time[0]; 
   $m += $splt_admin_time[1]; 
}
$sss = $m%60;
$h += ($m-$sss)/60;
$totaltime = $h.'H ';
$m = $sss.'';
?>
<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body tp">
<div class="d-flex pt-1 pb-2 no-block">
<div class="align-self-center mr-2 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#4886ff " data-thickness=".2" value="0" />
<i class="fa fa-tasks text-primary"></i> </div>
<div class="align-slef-center mr-auto">
<h4 class="m-b-0 text-uppercase f-18 font-medium lp-5">Total Hours</h4>
<a href="#"><h5 class="text-muted m-b-0"><strong><?php echo $totaltime;?> <?php echo $m.'M';?></strong> </h5></a>
</div>
</div>
</div>
</div>
</div>


<!--<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body tp">
<div class="d-flex pt-1 pb-1 no-block">
<div class="align-self-center mr-2 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#7ad835" data-thickness=".2" value="0" />
<i class="fa fa-users text-success"></i> </div>
<div class="align-slef-center mr-auto">
<h4 class="m-b-0 text-uppercase f-18 font-medium lp-5">Volunteer Engaged</h4>
<a href="#"><h5 class="text-muted m-b-0"><strong>0</strong></h5></a>
</div>
</div>
</div>
</div>
</div>-->

</div>




</div>
</div>

</div>


