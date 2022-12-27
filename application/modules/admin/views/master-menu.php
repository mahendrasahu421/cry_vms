<style>
	table td {
		white-space: initial !important;
	}

	.col-md-4 .card-header {
		padding: 6px 25px !important;
	}

	.card .card-block,
	.card .card-body {
		padding: 1px 25px !important;
	}

	.btn-group,
	.btn-group-vertical {
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
							<h5 class="m-b-10"> Master Menu</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard"><i class="fa fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Menu </a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-uppercase font-weight-bold">Add Master Menu</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="row form-group m-b-20">
							<div class="col-md-3">
								<h4 class="f-16  m-0 p-0 font-weight-bold">Menu Name</h4>
							</div>
							<div class="col-md-8">
								<input class="form-control" type="text" placeholder="Menu Name" />
							</div>
						</div>

						<div class="row form-group m-b-20">
							<div class="col-md-3">
								<h4 class="f-16  m-0 p-0 font-weight-bold">Menu Route</h4>
							</div>
							<div class="col-md-8">
								<input class="form-control" type="text" placeholder="Menu Route" />
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
						<h5>Master Menu</h5>
						<a href="#" data-toggle="modal" data-target=".project-details"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Master Menu</button></a>
					</div>
					<div class="card-body">
						<div class="table-responsive ">
							<table id="example" class="display nowrap" style="width:100%">
								<thead>
									<tr class="bg-gray-light">
										<th>Sr.no</th>
										<th>Menu Name</th>
										<th>Route Name</th>
										<th>Created Date</th>
										<th>Modify Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Volunteer List</td>
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
										<td>#</td>
										<td>10/04/2020</td>
										<td></td>
										<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
											<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
										</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Daily Report</td>
										<td>#</td>
										<td>10/04/2020</td>
										<td></td>
										<td><a href="#"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> |
											<a href="#"><span class="badge badge-danger"><i class="fa fa-trash"></i></span></a>
										</td>
									</tr>
									<tr>
										<td>5</td>
										<td>Reward Point</td>
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