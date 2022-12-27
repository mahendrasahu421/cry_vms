<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PROFILE DETAILS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Volunteer Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Volunteer Daily Report</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="mb-0">
							<div class="card-header bg-danger-light">
								<h4 class="card-title col-md-6"><i class="fa fa-filter me-2"></i> Search Filters</h4>
								<select class="form-control select2-show-search form-select">
									<option value="">Select Task</option>
									<option value="6">Peace Building</option>
									<option value="5">Health And Nutrition</option>
									<option value="4">Anti Human Trafficking & Safe Migration</option>
									<option value="3">Livelihood And Skill Development</option>
									<option value="2">Climate Adaptive Agriculture And Food Sovereignty</option>
									<option value="1">Humanitarian Aid And Disaster Risk Reduction</option>
								</select>
								<div class="input-group col-md-3 p-0">
									<input type="date" class="form-control " placeholder="Search for...">
									<span class="input-group-text btn btn-warning">Go!</span>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th>SNo</th>
											<th>Volunteer Name</th>
											<th>Mobile</th>
											<th>Email</th>
											<th>Total Time</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Amelia A Nicholas
												<br>
												<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">(Task Details)</a>
											</td>
											<td>8448773451</td>
											<td>anicholasamelia@gmail.com</td>
											<td>12</td>
											<td>
												<div class="btn-group dropstart">
													<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
													</button>
													<ul class="dropdown-menu">
														<li><a href="view-task">Approve</a></li>
														<li><a href="view-daily-report">Disapprove</a></li>
													</ul>
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
	</div>