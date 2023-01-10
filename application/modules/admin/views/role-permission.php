<style>
	table td {
		white-space: initial !important;
	}

	.card .card-block,
	.card .card-body {
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
							<h5 class="m-b-10">Role & Permission Master</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
							<li class="breadcrumb-item active text-warning"><a href="#!">Role & Permission Master</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Role & Permission Master</h5>
					</div>
					<hr>
					<div class="card-body">
						<div class="row">


							<div class="col-md-4" style="border-right:1px solid #ddd;">
								<div class="accordion" id="accordionExample">
									<div class="mb-2" id="headingOne">
										<h6 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus btn btn-primary"></i> Volunteer List</a></h6>
									</div>
									<div id="collapseOne" class=" card-body collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">Volunteer List</span>
											</label>
										</div>
									</div>

									<div class="mb-2" id="headingTne">
										<h6 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseTne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus btn btn-primary"></i> Task List</a></h6>
									</div>
									<div id="collapseTne" class=" card-body collapse " aria-labelledby="headingTne" data-parent="#accordionExample">
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">Add Task</span>
											</label>
										</div>
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">View Task</span>
											</label>
										</div>
									</div>

									<div class="mb-2" id="headingdne">
										<h6 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapsedne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus btn btn-primary"></i> Assign Task List</a></h6>
									</div>
									<div id="collapsedne" class=" card-body collapse " aria-labelledby="headingdne" data-parent="#accordionExample">
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">Assign Task</span>
											</label>
										</div>
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">View Assign Task</span>
											</label>
										</div>
									</div>
									<div class="mb-2" id="headingene">
										<h6 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseene" aria-expanded="true" aria-controls="collapseene"><i class="fa fa-plus btn btn-primary"></i> Daily Report</a></h6>
									</div>
									<div id="collapseene" class=" card-body collapse " aria-labelledby="headingene" data-parent="#accordionExample">
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">View Daily Report</span>
											</label>
										</div>
									</div>

									<div class="mb-2" id="headingfne">
										<h6 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapsefne" aria-expanded="true" aria-controls="collapseene"><i class="fa fa-plus btn btn-primary"></i> Reward Point</a></h6>
									</div>
									<div id="collapsefne" class=" card-body collapse " aria-labelledby="headingfne" data-parent="#accordionExample">
										<div class="d-inline-block">
											<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
												<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
												<span class="custom-control-label">View Reward Point</span>
											</label>
										</div>
									</div>

								</div>
							</div>
							<div class="col-md-8">
								<form>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Select Role</label>
										<div class="col-sm-8">
											<select class="form-control">
												<option>Select Role</option>
												<option value="admin">SuperAdmin</option>
												<option value="user">User </option>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Choose Permission</label>
										<div class="col-sm-8">
											<div class="d-inline-block">
												<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
													<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
													<span class="custom-control-label">Delete</span>
												</label>
											</div>
											<div class="d-inline-block">
												<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
													<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
													<span class="custom-control-label">Activate</span>
												</label>
											</div>
											<div class="d-inline-block">
												<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
													<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
													<span class="custom-control-label">Download</span>
												</label>
											</div>
											<div class="d-inline-block">
												<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
													<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
													<span class="custom-control-label">Create</span>
												</label>
											</div>
											<div class="d-inline-block">
												<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
													<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
													<span class="custom-control-label">View</span>
												</label>
											</div>
											<div class="d-inline-block">
												<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
													<input type="checkbox" class="custom-control-input" id="customCheck8" value="">
													<span class="custom-control-label">Edit</span>
												</label>
											</div>

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