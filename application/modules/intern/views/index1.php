
<style>
.profi{padding:0px !important;}
.table td, .table th {
white-space: inherit !important;}
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
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
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

<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon">
<input class="dial" data-plugin="knob" data-width="50" data-height="50" data-linecap="round" data-fgColor="#f95476" data-thickness=".4" value="85" />
<i class="fa fa-hdd-o text-danger"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Task
<h6 class="text-muted m-b-0"><strong><?php echo $totaltask; ?></strong> </h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="50" data-height="50" data-linecap="round" data-fgColor="#4886ff " data-thickness=".4" value="40" />
<i class="fa fa-spinner text-primary"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Reward Point</h2>
<?php $totaltime=0 .' '.'Hours';
 foreach($reporttotal as $re){
	 $totaltime += $re['admin_time'];
}?>
<h6 class="text-muted m-b-0 mt-2"><strong>
<?php $ttime = substr($totaltime,1,4);
$tottime = str_replace('.',' Hours ',$totaltime);
$ttime11 = substr($tottime,0,8);
	?>
<?php echo "$ttime11";?></strong></h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-4 col-md-12">
<div class="card">
<div class="card-body profi ml-3">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="50" data-height="50" data-linecap="round" data-fgColor="#8e2c24" data-thickness=".4" value="<?php echo $totalfield; ?>" />
<i class="fa fa-user text-warning"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">Profile Status</h2>
<?php $count = 0;
foreach ($countfield as $column)
{
    if(!isset($column))
    {
        $count++;
    }
}
//echo $count;?>
<h6 class="text-muted m-b-0 mt-2"><strong><?php echo substr($totalfield,0,5); ?> % Complete</strong> </h6>
<h6 class="text-muted m-b-0"><a href="<?php echo base_url(); ?>profile"><button class="btn btn-primary mt-2 pull-right up" data-toggle="tooltip" data-placement="bottom"  title="Update Profile">Update</button></a></h6>
</div>
</div>
</div>
</div>
</div>

</div>

<div class="row">

<div class="col-lg-6 col-md-12">
<div class="card panel-main random-data o-income panel-refresh">
<div class="refresh-container">
<div class="preloader">
<div class="loader">
</div>
</div>
</div>
<div class="card-body p-10 panel-wrapper">
<?php
if($this->session->userdata('task_accept'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> This Task has been accepted.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('task_accept'); } ?>
<?php
if($this->session->userdata('task_reject'))
{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> This Task has been Reject.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('task_reject'); } ?>
<div class="d-flex m-t-10 p-l-10 m-b-10 no-block">
<h4 class="card-title m-b-0 align-self-center">Current Task</h4>
</div>
<div class="table-wrapper bookmarking">
<div class="scrollbox">
<div id="slimtest2" style="height:auto;">
<div class="table-responsive">
<?php if(sizeof($task)>0){?>
<table class="table table-hover" id="myTable">
<tbody>
<?php foreach($task as $key => $value){
 $publishdate= $value['taskPublishedDate'];
  $encoded_id=rtrim(strtr(base64_encode($value['taskID']), '+/', '-_'), '='); 
?>
<tr>
<td><span class="txt-dark weight-700" style="text-transform: capitalize;"><i class="fa fa-circle text-primary"></i><?php echo $value['taskTitle'];?>(<?php echo $value['taskPublishedDate'];?>)</span></td>
<?php if($value['status']==0){	?>
<td><a href="<?php echo base_url().'dashboard-task-accept/'.$encoded_id;?>" class="btn btn-primary" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept">Accept</a></td>
<td><a href="<?php echo base_url().'dashboard-task-reject/'.$encoded_id;?>" class="btn btn-primary" data-val="2" onclick="return confirm('Are you sure, you want to Reject it?')" title="Reject">Reject</a></td>
<?php }else if($value['status']==1){ ?>
<!--<td><a href="<?php echo base_url().'dashboard-task-reject/'.$encoded_id;?>" class="btn btn-primary" data-val="2">Reject</a></td>-->
<td><button class="btn btn-info">Accepted </button></td>
<?php } else if($value['status']==2){ ?>
<td><button class="btn btn-danger">Rejected </button></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
<?php }else { ?>
	<hr><h6 class="text-center">No Data Found</h6><h6 class="text-center"><a href="<?php echo base_url('find-task'); ?>"><button class='btn btn-primary wid-150' data-toggle="tooltip" data-placement="bottom" title="Find Task">Find Task</button></a></h6> <?php }?>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="card panel-main random-data o-income panel-refresh">
<?php
if($this->session->userdata('request_send'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> User Request Send For This Task.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div><br>
<?php $this->session->unset_userdata('request_send'); } ?>
<div class="card-body p-10 panel-wrapper">
<div class="d-flex m-t-10 p-l-10 m-b-10 no-block">
<h4 class="card-title m-b-0 align-self-center">Find Task</h4>
</div>
<div class="table-wrapper bookmarking">
<div class="scrollbox">
<div id="slimtest2" style="height:auto;">
<div class="table-responsive">
<table class="table table-hover" id="myTable">
<tbody>
<?php foreach($find_task as $key => $value){
 $publishdate= $value['taskPublishedDate'];
  $encoded_id11=rtrim(strtr(base64_encode($value['taskID']), '+/', '-_'), '='); 
?>
<tr>
<td><span class="txt-dark weight-700" style="text-transform: capitalize;"><i class="fa fa-circle text-primary"></i><?php echo $value['taskTitle'];?>(<?php echo $value['taskPublishedDate'];?>)</span></td>
<?php $this->load->model('curl/Curl_model');
		$userID = $this->session->userdata('userID');
		$fields = array(
            'taskID',
            'userID',
        );
        $where = array('userID'=>$userID,
						'taskID'=>$value['taskID'] );
        $limit = '';
        $order_by = array('userID','ASC');
        $send_status = $this->Curl_model->fetch_data_in_many_array('send_requiest',$fields,$where,$limit,$order_by);
		?>
<?php if(sizeof($send_status)==0){	?>
<td><a href="<?php echo base_url().'dashboard-send-request/'.$encoded_id11;?>" class="btn btn-outline-success" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept">Send Request</a></td>
<?php }else{ ?>
<td><button class="btn btn-danger">Request Send</button></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>



</div>



<div class="col-lg-6 col-md-12">
<div class="card panel-main o-income panel-refresh">

<div class="card-body panel-wrapper">
<div class="d-flex m-b-10 no-block">
<h5 class="card-title m-b-0 align-self-center">Daily Report List</h5>
<h5 class="ml-10">
<a href="<?php echo base_url('add-daily-report'); ?>"><button class="btn btn-info" title="Add Daily Report" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i></button></a>
<a href="<?php echo base_url('daily-report'); ?>"><button class="btn btn-danger mr-1" data-toggle="tooltip" data-placement="bottom"  title="View Daily Report"><i class="fa fa-eye"></i></button></a>
</h5>
</div>
<div class="row scrollbox">
<div class="col-lg-12 " id="slimtest1" style="height:auto;">
<div class="table-responsive m-t-10">
<?php if(sizeof($report)>0){?>
<table class="table table-striped table-bordered pre-line">
	<thead>
		<tr>
			<th>S.no</th>
			<th class="wid-120">Date</th>
			<th>Task</th>
			<th>Time In</th>
			<th>Time Out</th>
		</tr>
	</thead>
<tbody>

<?php $i=1; foreach($report as $re){
	$publishdate= $re['dailyReportDate'];
	$timeIn= $re['dailyReportTimeIn'];
	$time = date('g:i A', strtotime($timeIn));
	$timeOut= $re['dailyReportTimeOut'];
	$time1 = date('g:i A', strtotime($timeOut));
	?>

<tr>
<td><?php echo $i; ?></td>
<td class="wid-120"><?php echo date("d-m-Y", strtotime($publishdate)); ?></td>
<td><?php echo substr($re['dailyReportActivity'],0,55);?></td>
<td><?php echo $time ;?></td>
<td><?php echo $time1 ;?></td>
</tr>
	
<?php $i++; } ?>

</tbody>
</table>
<?php }else {echo "<hr><h6 class='text-center'>No Data Found</h6>"; }?>
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


