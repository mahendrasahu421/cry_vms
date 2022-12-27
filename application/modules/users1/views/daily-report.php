<style>
table td{white-space:initial !important;}
.col-md-6 .form-group {
   margin-bottom: 0rem; 
} 
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Daily Report</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">Report</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Daily Report List</h5>
<a href="<?php echo base_url(); ?>add-daily-report"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Daily Report</button></a>
</div><hr>
<form action="<?php echo base_url()?>task-lists" method="post" id="filtercheck">
<div class="row ml-3">
<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-3 col-form-label">Choose Task</label>
			<div class="col-sm-9">
				<select class="form-control" id="task" name="task">
					<?php foreach($task as $key => $value){
						$allasid = $value['taskID'];
						$tv=$task_value;
						if($allasid==$letest_taskID){
							$tk = 'selected';
						}else{
							$tk = '';
						}
						?>
					<option value="<?php echo $value['taskID']?>" <?php echo $tk; ?>><?php echo $value['taskTitle']?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	
	</div>

<div class="col-md-2"></div>
</div>
</form>
<hr>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
	<thead>
		<tr>
			<th>Sr.no</th>
			<th>Time In</th>
			<th>Time Out</th>
			<th>Task Activity</th>
			<th>Total Time</th>
			<!--<th>Attachment</th>-->
			<th></th>
		</tr>
	</thead>
<tbody>
<?php
$i=1; foreach($report as $re){
	$encoded_id=rtrim(strtr(base64_encode($re['dailyReportID']), '+/', '-_'), '='); 
	$timeIn= $re['dailyReportTimeIn'];
	$time = date('h:i A', strtotime($timeIn));
	$timeOut= $re['dailyReportTimeOut'];
	$time1 = date('h:i A', strtotime($timeOut));
	
	$diff = abs(strtotime($time) - strtotime($time1));
	$tmins = $diff/60;
	$hours = floor($tmins/60);
	$mins = $tmins%60;
	//echo "<b>$hours</b> hours <b>$mins</b> minutes</b>";
?>
<tr>
<td><?php echo $i;  ?>, </td>
<td><?php echo $time ;?></td>
<td><?php echo $time1 ;?></td>
<td><?php echo $re['dailyReportActivity'];?></td>
<td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
<!--<td><?php 
if(sizeof($attachment)>0)
{
foreach ($attachment as $key => $value) {
?>
	<ul>
		<a href="#"><li><?php echo $value['attachmentName']; ?></li></a>
	</ul>
	<?php }}else { ?>
	<p>Not available</p>
	<?php } ?>
</td>-->
<td>
	<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	<div class="dropdown-menu">
	 <a href="<?php echo base_url().'daily-report-all-data/'.$encoded_id;?>" class="dropdown-item" href="#">View</a>
	</div>

</td>
</tr>
<?php $i++; }?>

</tbody>
</table>
</div>
</div>
</div>
</div>

</div>

</div>
</section>

</div>

