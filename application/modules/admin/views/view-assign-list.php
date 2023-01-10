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

	.assign {
		width: 30px;
	}
</style>
<section class="pcoded-main-container">
	<div class="pcoded-content">

		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Task List</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
							<li class="breadcrumb-item text-warning"><a href="#!">User Task</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Assigned Task List</h5>
						<a href="add-task.php"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Task</button></a>
					</div>
					<hr>
					<div class="row ml-3">

						<div class="col-md-4">
							<div class="card-header">
								<h5>Search By Task</h5>
							</div>
							<div class="card-body">
								<select class="form-control">
									<option>Select Task</option>
									<option>Select One</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card-header">
								<h5>Search By Date</h5>
							</div>
							<div class="card-body">
								<input type="text" name="daterange" class="form-control" value="01/01/2020 - 01/15/2020" />
							</div>
						</div>

						<div class="col-md-4">
							<div class="card-header">
								<h5>Search By Location</h5>
							</div>
							<div class="card-body">
								<select class="form-control">
									<option readonly>Select State</option>
									<optgroup label="State">
										<option value="UP">Uttar Pradesh</option>
										<option value="Delhi">Delhi</option>
									</optgroup>
									<optgroup label="City">
										<option value="mercedes">Agra</option>
										<option value="audi">North Delhi</option>
									</optgroup>
								</select>
							</div>
						</div>
					</div>

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


					<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-uppercase font-weight-bold">Project Details</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<div class="row form-group m-b-20">
										<div class="col-md-3">
											<h4 class="f-16 m-0 p-0 font-weight-bold">Task Title</h4>
										</div>
										<div class="col-md-9">
											It’s complete shop with opportunity to buy anything anywhere for 2 minutes.
										</div>
									</div>
									<div class="row form-group m-b-20">
										<div class="col-md-3">
											<h4 class="f-16  m-0 p-0 font-weight-bold">Choose Reason</h4>
										</div>
										<div class="col-md-8">
											<select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" id="mylist" onchange="yesnoCheck(this);">
												<option value="Category 1">Select Reason</option>
												<option value="Category 1">Category 1</option>
												<option value="Category 2">Category 2</option>
												<option value="other">Other</option>
											</select>

											<div id="ifYes" style="display: none;">
												<textarea class="form-control mt-3" id="myInput" rows="3"></textarea>
											</div>
											<script>
												function yesnoCheck(that) {
													if (that.value == "other") {
														document.getElementById("ifYes").style.display = "block";
													} else {
														document.getElementById("ifYes").style.display = "none";
													}
												}
											</script>


										</div>


									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-rounded btn-primary">Save</button>
									<button type="button" class="btn btn-rounded  btn-secondary">Cancel</button>
								</div>
							</div>
						</div>
					</div>




					<div class="card-body">
						<div class="dt-responsive table-responsive">
							<table id="dom-table simpletable" class="table table-striped table-bordered pre-line">
								<thead>
									<tr>
										<th></th>
										<th>Date</th>
										<th>Task</th>
										<th>Location</th>
										<th class="wid-150">Member</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-primary"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
										<td>Kanpur</td>
										<td>
											<a href="#!"><img class="img-fluid img-radius mb-1 assign" src="assets/images/user/avatar-1.jpg" alt=""></a>
											<a href="#!"><img class="img-fluid img-radius assign" src="assets/images/user/avatar-2.jpg" alt=""></a>
											<a href="edit-assigned-task.php"><i class="fa fa-plus f-w-600 m-l-5"></i></a>
										</td>
										<td><a href="#!" title="Remove"><i class="fa fa-times f-w-600 f-16 text-c-red"></i></a></td>
										<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
											<div class="dropdown-menu">
												<a href="#" class="dropdown-item" href="#">Accept</a>
												<a href="#" data-toggle="modal" data-target=".project-details" class="dropdown-item">Reject</a>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-primary"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
										<td>Kanpur</td>
										<td>
											<a href="#!"><img class="img-fluid img-radius mb-1 assign" src="assets/images/user/avatar-1.jpg" alt=""></a>
											<a href="#!"><img class="img-fluid img-radius mb-1 assign" src="assets/images/user/avatar-2.jpg" alt=""></a>
											<a href="#!"><img class="img-fluid img-radius assign" src="assets/images/user/avatar-3.jpg" alt=""></a>
											<a href="edit-assigned-task.php"><i class="fa fa-plus f-w-600 m-l-5"></i></a>
										</td>
										<td><a href="#!" title="Remove"><i class="fa fa-times f-w-600 f-16 text-c-red"></i></a></td>
										<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
											<div class="dropdown-menu">
												<a href="#" class="dropdown-item" href="#">Accept</a>
												<a href="#" class="dropdown-item" data-toggle="modal" data-target=".project-details">Reject</a>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-warning"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
										<td>Kanpur</td>
										<td>
											<a href="#!"><img class="img-fluid img-radius mb-1 assign" src="assets/images/user/avatar-1.jpg" alt=""></a>
											<a href="#!"><img class="img-fluid img-radius assign" src="assets/images/user/avatar-2.jpg" alt=""></a>
											<a href="edit-assigned-task.php"><i class="fa fa-plus f-w-600 m-l-5"></i></a>
										</td>
										<td><a href="#!" title="Remove"><i class="fa fa-times f-w-600 f-16 text-c-red"></i></a></td>
										<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
											<div class="dropdown-menu">
												<a href="#" class="dropdown-item" href="#">Accept</a>
												<a href="#" class="dropdown-item" data-toggle="modal" data-target=".project-details">Reject</a>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-success"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
										<td>Kanpur</td>
										<td>
											<a href="#!"><img class="img-fluid img-radius mb-1 assign" src="assets/images/user/avatar-1.jpg" alt=""></a>
											<a href="#!"><img class="img-fluid img-radius assign" src="assets/images/user/avatar-2.jpg" alt=""></a>
											<a href="edit-assigned-task.php"><i class="fa fa-plus f-w-600 m-l-5"></i></a>
										</td>
										<td><a href="#!" title="Remove"><i class="fa fa-times f-w-600 f-16 text-c-red"></i></a></td>
										<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
											<div class="dropdown-menu">
												<a href="#" class="dropdown-item" href="#">Accept</a>
												<a href="#" class="dropdown-item" data-toggle="modal" data-target=".project-details">Reject</a>
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
</section>

</div>