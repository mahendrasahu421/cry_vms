<style>
table td{white-space:initial !important;}
.col-md-4 .card-header {
padding: 6px 25px !important;}
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
<h5 class="m-b-10">Tasks</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Task List</a></li>
</ul>
</div>
</div>
</div>
</div>




<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Tasks List</h5>
</div>
<hr>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
<thead>
<tr>
<th>S.no</th>
<th>Published Date</th>
<th>Task Title</th>
<th></th>
</tr>
</thead>
<tbody>
<?php 
	$count = 1;
	foreach ($task as $key => $value) {
	$encode_taskID = rtrim(strtr(base64_encode($value['taskID']), "+/", "-_"), "=");
?>
<tr>
	<td><?php echo $count++; ?></td>
	<td><?php echo date("d/m/Y", strtotime($value['taskPublishedDate'])); ?></td>
	<td> <?php echo ucwords($value['taskTitle']); ?></td>
	<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	<div class="dropdown-menu">
	<a class="dropdown-item" href="<?php echo base_url();?>view-task-info/<?php echo $encode_taskID; ?>">View Details</a>
	</div>
	</td>
</tr>
<?php
	}
?>

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
