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
<h5 class="m-b-10">Role Master</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Role </a></li>
</ul>
</div>
</div>
</div>
</div>

<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Add Role</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">
		<div class="row form-group m-b-20">
			<div class="col-md-3">
				<h4 class="f-16  m-0 p-0 font-weight-bold">Role Name</h4>
			</div>
			<div class="col-md-8">
				<input class="form-control" type="text" placeholder="Role Name"/>
			</div>
		</div>
		
		<div class="row form-group m-b-20">
			<div class="col-md-3">
				<h4 class="f-16  m-0 p-0 font-weight-bold">Role </h4>
			</div>
			<div class="col-md-8">
				<input class="form-control" type="text" placeholder="Role"/>
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
<h5>Role Master</h5>
<a href="#" data-toggle="modal" data-target=".project-details"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Role</button></a>
</div>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="basic-btn" class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th>Sr.no</th>
<th>Role Name</th>
<th>Role</th>
<th>Created Date</th>
<th>Modify Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>SuperAdmin</td>
<td>Admin</td>
<td>10/04/2020</td>
<td>12/04/2020</td>
<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
</td>
</tr>
<tr>
<td>2</td>
<td>User</td>
<td>Volunteer</td>
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