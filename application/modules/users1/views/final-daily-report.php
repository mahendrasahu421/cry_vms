<style>
table td{white-space:initial !important;}
.col-md-5 .card-header {
padding: 6px 25px !important;}
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
.btn-group, .btn-group-vertical {
	position: absolute !important;
}
.tp{margin-top:-10px;}
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
<li class="breadcrumb-item"><a href="#!">Report</a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Daily Report </h5>
</div><hr>
<form method="GET" action="<?php echo base_url(); ?>final-daily-filter">
<div class="row ml-3">
    <div class="col-md-5">
        <div class="card-header">
            <h5>Choose Task</h5>
        </div>
        <div class="card-body">
            <select class="form-control" name="tasks">
                <option value="">Select Task</option>
                <?php foreach($task as $key => $value){?>
				<option <?php if($tasks==$value['taskID']){echo "selected"; } ?> value="<?php echo $value['taskID']?>"><?php echo $value['taskTitle']?></option>
				<?php } ?>
            </select>
        </div>
    </div>
	<div class="col-md-5">
        <div class="card-header">
            <h5>By Date</h5>
        </div>
        <div class="card-body">
            <input type="text" value="<?php //echo $datefilter; ?>" name="datefilter" class="form-control" placeholder="select date" />
        </div>
    </div>
	<div class="col-md-2">
		<div class="card-header"></div>
		<div class="card-body">
			<button class="btn btn-primary form-control tp"><i class="fa fa-search"></i></button>
		</div>
	</div>
</div>
</form>
<hr>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="basic-btn" class="table table-striped table-bordered nowrap">
    <thead>
        <tr>
            <th>Sr.no</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Task</th>
            <th>Total Time</th>
            <th>Attachment</th>
        </tr>
    </thead>
<tbody>
<?php $i=1; foreach($report as $re){
	$timeIn= $re['dailyReportTimeIn'];
	$time = date('g:i A', strtotime($timeIn));
	$timeOut= $re['dailyReportTimeOut'];
	$time1 = date('g:i A', strtotime($timeOut));
	 
	$diff = abs(strtotime($time) - strtotime($time1));
	$tmins = $diff/60;
	$hours = floor($tmins/60);
	$mins = $tmins%60;
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $time ;?></td>
<td><?php echo $time1 ;?></td>
<td><?php echo $re['dailyReportActivity'];?></td>
<td><?php echo "<b>$hours</b> hour <b>$mins</b> min</b>" ?></td>
<td><?php 
$join_data = array(
        array(
            'table'=>'attachment',
            'fields'=>array('attachmentName','attachmentSize','attachmentDate','userID','attachmentTypeID'),
            'joinWith'=>array('attachmentTypeID'),
            'where'=>array(
                'status'=>1,
                'dailyReportID'=>$re['dailyReportID']
            ),
        ),
        array(
            'joined'=>0,
            'table'=>'attachment_type',
            'fields'=>array('attachmentTypeName','attachmentFileType'),
            'joinWith'=>array('attachmentTypeID','left'),
        ),
    );

    $limit = '';
    $order_by ='';
    $attachment = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
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
</section>

</div>