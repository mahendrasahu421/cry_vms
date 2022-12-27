<style>
	table td {
		white-space: initial !important;
	}

	.tk {
		margin-bottom: 0px !important;
	}

	.card .card-block,
	.card .card-body {
		padding: 1px 25px !important;
	}

	.ck {
		height: 180px;
	}

	/*#tbl_div div {
    display:none;
}*/
</style>
<section class="pcoded-main-container">
	<div class="pcoded-content">

		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Edit Assign Task</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!"> Edit Assign Task</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Edit Assign Task</h5>
					</div>
					<hr>

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
											<h4 class="f-16 m-0 p-0 font-weight-bold">Working Hours</h4>
										</div>
										<div class="col-md-9">
											4 Days
										</div>
									</div>
									<div class="row form-group m-b-20">
										<div class="col-md-3">
											<h4 class="f-16  m-0 p-0 font-weight-bold">Start Working Date</h4>
										</div>
										<div class="col-md-9">
											15/01/2020
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
						<div class="row">
							<div class="col-md-6">
								<form>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Choose Task</label>
										<div class="col-sm-8">
											<select class="form-control" id="exampleFormControlSelect1">
												<option>Select Task</option>
												<option>Select One</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Assigned Date</label>
										<div class="col-sm-8">
											<input type="text" name="birthday" value="04/08/2020" class="form-control" />
										</div>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4 col-form-label">Task Location</label>
									<div class="col-sm-8">
										<select class="form-control" onchange="change_tbl(this.value)">
											<option value="tb1">Kanpur </option>
										</select>
									</div>
								</div>
								<script>
									function change_tbl(dhi) {
										if (dhi == '') {
											return;
										}
										$('#tbl_div > div').css('display', 'none');
										$('#' + dhi).css('display', 'block');
									}
								</script>

							</div>
							<div class="col-md-12">
								<div id="tbl_div">
									<div id="tb1">
										<table class="table table-striped table-bordered pre-line">
											<thead>
												<tr>
													<th></th>
													<th>Name</th>
													<th>Mobile</th>
													<th>Email</th>
													<th>Address</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox" /></td>
													<td>Mr. XYZ</td>
													<td>9856412365</td>
													<td>dummy@gmail.com</td>
													<td>Kanpur</td>
													<td><span class="badge badge-success">Assigned</span><br>
														<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox" checked /></td>
													<td>Mr. XYZ</td>
													<td>9856412365</td>
													<td>dummy@gmail.com</td>
													<td>Kanpur</td>
													<td><span class="badge badge-danger">Not Assigned</span></td>
												</tr>
												<tr>
													<td><input type="checkbox" checked /></td>
													<td>Mr. XYZ</td>
													<td>9856412365</td>
													<td>dummy@gmail.com</td>
													<td>Kanpur</td>
													<td><span class="badge badge-success">Assigned</span><br>
														<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox" checked /></td>
													<td>Mr. XYZ</td>
													<td>9856412365</td>
													<td>dummy@gmail.com</td>
													<td>Kanpur</td>
													<td><span class="badge badge-success">Assigned</span><br>
														<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>


								<button type="submit" class="btn btn-primary pull-right mb-5">Submit</button>
							</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>

</div>