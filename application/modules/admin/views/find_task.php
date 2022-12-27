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
</style>
<section class="pcoded-main-container">
	<div class="pcoded-content">

		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Find Task List</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard"><i class="fa fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Find Task</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5> Find Task List</h5>
					</div>
					<hr>
					<div class="row ml-2">
						<div class="col-md-4">
							<div class="card-header">
								<h5>Search By State</h5>
							</div>
							<div class="card-body">
								<select class="form-control">
									<option>Select State</option>
									<option>Agra</option>
									<option>Kanpur</option>
									<option>Lucknow</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card-header">
								<h5>Search By City</h5>
							</div>
							<div class="card-body">
								<select class="form-control">
									<option>Select City</option>
									<option>Agra</option>
									<option>Kanpur</option>
									<option>Lucknow</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card-header">
								<h5>Search By Cause</h5>
							</div>
							<div class="card-body">
								<select class="form-control">
									<option>Select Cause</option>
									<option>Humanitarian Aid and Disaster Risk Reduction</option>
									<option>Climate Adaptive Agriculture and Food Sovereignty</option>
									<option>Livelihood and Skill Development</option>
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
						</ul>
					</div>

					<div class="clearfix"></div>
					<div class="card-body">
						<div class="dt-responsive table-responsive">
							<table id="dom-table" class="table table-striped table-bordered pre-line">
								<thead>
									<tr>
										<th class="w-20"></th>
										<th>Published Date</th>
										<th>Task</th>
										<th>Description</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-warning"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>Edinburgh</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
										<td><button class="btn btn-outline-success">Send Request </button></td>
									</tr>
									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-warning"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>Tokyo</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
										<td><button class="btn btn-outline-success">Send Request</button></td>
									</tr>

									<tr>
										<td>
											<ul class="list-inline  text-uppercase m-0   font-medium font-12">
												<li><i class="fa fa-circle f-10  text-warning"></i></li>
											</ul>
										</td>
										<td>03/26/1994</td>
										<td>San Francisco</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
										<td><button class="btn btn-outline-success">Send Request</button></td>
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