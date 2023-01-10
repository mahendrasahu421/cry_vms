<style>
table td{white-space:initial !important;}
.col-md-4 .card-header {
padding: 6px 25px !important;}
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
.btn-group, .btn-group-vertical {
	position: absolute !important;
}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10"> Master Sub-Menu</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Sub-Menu </a></li>
</ul>
</div>
</div>
</div>
</div>

<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Add Master Sub-Menu</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">
		<div class="row form-group m-b-20">
			<div class="col-md-3">
				<h4 class="f-16  m-0 p-0 font-weight-bold">Select Menu Name</h4>
			</div>
			<div class="col-md-8">
				<select class="form-control">
					<option>Select Menu</option>
					<option>Volunteer List</option>
					<option>Task List</option>
					<option>Assign Task</option>
					<option>Daily Report List</option>
					<option>Reward Point</option>
				</select>
			</div>
		</div>
		<div class="row form-group m-b-20">
			<div class="col-md-3">
				<h4 class="f-16  m-0 p-0 font-weight-bold">Sub-Menu Name</h4>
			</div>
			<div class="col-md-8">
				<input class="form-control" type="text" placeholder="Sub-Menu Name"/>
			</div>
		</div>
		
		<div class="row form-group m-b-20">
			<div class="col-md-3">
				<h4 class="f-16  m-0 p-0 font-weight-bold">Sub-Menu Route</h4>
			</div>
			<div class="col-md-8">
				<input class="form-control" type="text" placeholder="Sub-Menu Route"/>
			</div>
		</div>
		
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-primary">Save</button>
	<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	</div>
	</div>
</div>


<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header table-card-header">
<h5>Master Sub-Menu</h5>
<a href="#" data-toggle="modal" data-target=".project-details"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Master Sub-Menu</button></a>
</div>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="basic-btn" class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th>S.no</th>
<th>Menu Name</th>
<th>Sub-Menu Name</th>
<th>Route</th>
<th>Created Date</th>
<th>Modify Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>Task List</td>
<td>Add Task</td>
<td>#</td>
<td>10/04/2020</td>
<td>12/04/2020</td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>
<tr>
<td>2</td>
<td>Task List</td>
<td>View Task</td>
<td>#</td>
<td>10/04/2020</td>
<td></td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>
<tr>
<td>3</td>
<td>Assign Task</td>
<td>Assign Task List</td>
<td>#</td>
<td>10/04/2020</td>
<td></td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>
<tr>
<td>4</td>
<td>Assign Task</td>
<td>Assign Task List</td>
<td>#</td>
<td>10/04/2020</td>
<td></td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>
<tr>
<td>5</td>
<td>Daily Report</td>
<td>View Daily Report</td>
<td>#</td>
<td>10/04/2020</td>
<td></td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>
<tr>
<td>6</td>
<td>Report</td>
<td>Volunteer Report</td>
<td>#</td>
<td>10/04/2020</td>
<td></td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>

</tbody>
</table>
</div>
</div>
</div>

</div>

</div>
</section>

</div>
