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
.tp{margin-top: -10px;}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Task Report</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">User Task Report</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Task Report</h5>
</div><hr>
<form method="GET" action="<?php echo base_url(); ?>final-task-report-filter">
<div class="row ml-3">

    <div class="col-md-5">
        <div class="card-header">
            <h5>By Theam</h5>
        </div>
        <div class="card-body">
            <select class="form-control" name="cause">
				<option value="">Select Theam</option>
				<?php foreach($causes as $c){?>
				<option <?php if($cause==$c['causesID']){echo "selected"; } ?> value="<?php echo $c['causesID']?>"><?php echo $c['causesName']; ?></option>
				<?php } ?>
			</select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-header">
            <h5>By Date</h5>
        </div>
        <div class="card-body">
            <input type="text" name="datefilter" class="form-control" placeholder="Select Date" value="<?php echo $datefilter; ?>" />
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
<div class="clearfix"></div>
<div class="mt-3">
<ul class="list-inline ml-3 text-uppercase lp-5 font-medium font-12">
<li><i class="fa fa-circle m-r-5 f-10 text-primary"></i> New</li>
<li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>
<li><i class="fa fa-circle m-r-5 f-10 text-success"></i> Done</li>
</ul>
</div>
<div class="clearfix"></div>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="basic-btn" class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th></th>
<th>Date</th>
<th>Task</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<?php foreach($task as $key => $value){
 $publishdate= $value['taskPublishedDate'];
 $tStatus = $value['taskStatus'];
?>
<tr>
<td>
<ul class="list-inline  text-uppercase m-0   font-medium font-12">
<li><i class="fa fa-circle f-10  <?php if($tStatus==0){ echo 'text-primary'; }elseif($tStatus==1){ echo 'text-success'; }elseif($tStatus==2){ echo 'text-warning'; } ?>"></i></li>
</ul>
</td>
<td><?php echo date("d-m-Y", strtotime($publishdate)); ?></td>
<td><?php echo $value['taskTitle'];?></td>
<td><?php echo $value['taskDescription']; ?></td>
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

</div>
</section>

</div>