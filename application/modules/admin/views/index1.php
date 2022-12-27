<style>
.table td, .table th {
	white-space: normal !important;
}
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
<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
</ul>
</div>
<!--<div class="col-md-6 text-right">
<button type="button" class="btn btn-primary m-r-5"><i class="fa fa-plus"></i> Filter</button>
<button type="button" class="btn btn-outline-primary"><i class="fa fa-repeat"></i> Reload</button>
</div>-->
</div>
</div>
</div>





<div class="row">
<div class="col-md-12 col-lg-12">
<?php
if($this->session->userdata('volenteership_verify'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Volunteer has been verified.<?php //echo $this->session->userdata('volenteership_verify'); ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('volenteership_verify'); } ?>
<?php
if($this->session->userdata('volenteership_block'))
{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Volunteer has been blocked.<?php //echo $this->session->userdata('volenteership_block'); ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('volenteership_block'); } ?>
</div>
<div class="col-lg-3 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#f95476" data-thickness=".2" value="85" />
<i class="fa fa-hdd-o text-danger"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Total Volunteer
<h6 class="text-muted m-b-0"><strong><?php echo $totalvolunteer; ?></strong> </h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-3 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#4886ff " data-thickness=".2" value="40" />
<i class="fa fa-spinner text-primary"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Total Task</h2>
<h6 class="text-muted m-b-0"><strong><?php echo $totaltask; ?></strong> </h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-3 col-md-12">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#ffb74e" data-thickness=".2" value="89" />
<i class="fa fa-repeat text-warning"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Total Hours</h2>
<?php $to_time = $timetask[0]['dailyReportTimeIn'];
$from_time = $timeouttask[0]['dailyReportTimeOut'];
$diff= $from_time - $to_time ;
$hours = floor($diff / 3600);
$minutes = floor(($diff - $hours * 3600) / 60);
$seconds = $diff - $hours * 3600 - $minutes * 60;
?>
<h6 class="text-muted m-b-0 mt-2"><strong><?php echo "$hours hours";?></strong></h6>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-3 col-md-12">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#7ad835" data-thickness=".2" value="89" />
<i class="fa fa-repeat text-success"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Assigned Task</h2>
<h6 class="text-muted m-b-0"><strong><?php echo $totalassigntask; ?></strong></h6>
</div>
</div>
</div>
</div>
</div>

</div>

<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card panel-main o-income panel-refresh">

<div class="card-body panel-wrapper">
<div class="d-flex m-b-10 no-block">
<h5 class="card-title m-b-0 align-self-center">Pending Volunteer Report</h5>
</div>
<div class="row scrollbox">
<div class="col-lg-12 " id="slimtest1" style="height:auto;">
<div class="table-responsive m-t-10">
<table id="dom-table" class="table table-bordered table-hover">
<thead>
<tr>
<th>S.no</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Location</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($userDetails as $key => $value){
  $encode_userID = rtrim(strtr(base64_encode($value['userID']), "+/", "-_"), "=");
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $value['firstName'] ; ?></td>
<td><?php echo $value['email'] ; ?></td>
<td><?php echo $value['mobile'] ; ?></td>
<td><?php echo $value['correspontenceAddress'] ; ?></td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
 <a href="<?php echo base_url();?>volenteership-verify/<?php echo $encode_userID; ?>/admin-dashboard" class="dropdown-item">Verify</a>
 <a href="<?php echo base_url();?>volenteership-block/<?php echo $encode_userID; ?>/admin-dashboard" class="dropdown-item">Block</a>
</div>
</td>
</tr>
<?php $i++; } ?>

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-12 col-md-12">
<div class="card panel-main random-data o-income panel-refresh">
<div class="refresh-container">
<div class="preloader">
<div class="loader">
</div>
</div>
</div>
<div class="card-body p-10 panel-wrapper">
<div class="d-flex m-b-10 no-block">
<h5 class="card-title m-b-0 align-self-center">Task Wise Hours</h5>
</div>
<div class="row scrollbox">
<div class="col-lg-12 " id="slimtest1" style="height:680px;">
<div class="table-responsive m-t-10 ">
<table id="myTable" class="table table-bordered table-hover">
<thead>
<tr>
<th>S.no</th>
<th>Date</th>
<th>Task</th>
<th>Recent File</th>
<th>Total Volunteer</th>
<th>Total Hours</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>15/04/2020</td>
<td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
<td><a href="#">abc.pdf</a></td>
<td>5 Hours</td>
<td>Delhi</td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
  <a href="view-daily-report.php " class="dropdown-item" href="#">Daily Report</a>
 <a href="view-task.php" class="dropdown-item">View Task</a>
</div>
</td>
</tr>

<tr>
<td>2</td>
<td>17/04/2020</td>
<td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
<td><a href="#">abc.pdf</a></td>
<td>10 Hours</td>
<td>Delhi</td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
  <a href="view-daily-report.php " class="dropdown-item" href="#">Daily Report</a>
 <a href="view-task.php" class="dropdown-item">View Task</a>
</div>
</td>
</tr>

<tr>
<td>3</td>
<td>11/04/2020</td>
<td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
<td><a href="#">abc.pdf</a></td>
<td>3 Hours</td>
<td>Delhi</td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
   <a href="view-daily-report.php " class="dropdown-item" href="#">Daily Report</a>
 <a href="view-task.php" class="dropdown-item">View Task</a>
</div>
</td>
</tr>

<tr>
<td>4</td>
<td>14/04/2020</td>
<td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
<td><a href="#">abc.pdf</a></td>
<td>15 Hours</td>
<td>Delhi</td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
   <a href="view-daily-report.php " class="dropdown-item" href="#">Daily Report</a>
 <a href="view-task.php" class="dropdown-item">View Task</a>
</div>
</td>
</tr>

<tr>
<td>5</td>
<td>12/04/2020</td>
<td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
<td><a href="#">abc.pdf</a></td>
<td>7 Hours</td>
<td>Delhi</td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
   <a href="view-daily-report.php " class="dropdown-item" href="#">Daily Report</a>
 <a href="view-task.php" class="dropdown-item">View Task</a>
</div>
</td>
</tr>

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


</div>



</div>
</div>

</div>


