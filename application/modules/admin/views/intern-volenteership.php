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
				<button type="button" class="btn btn-primary">Save changes</button>
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
					<h1 class="page-title">Intern Volenteership</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Intern Volenteership</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Intern Volenteership</h3>
						</div>
						<div class="mb-0 bg-default">
							<div class="card-header bg-danger-light">
								<h4 class="card-title col-md-6"><i class="fa fa-filter me-2"></i> Search Filters</h4>
								<select class="form-control col-md-3 me-2">
									<option value="">Select Task</option>
									<option value="6">Peace Building</option>
									<option value="5">Health And Nutrition</option>
									<option value="4">Anti Human Trafficking & Safe Migration</option>
									<option value="3">Livelihood And Skill Development</option>
									<option value="2">Climate Adaptive Agriculture And Food Sovereignty</option>
									<option value="1">Humanitarian Aid And Disaster Risk Reduction</option>
								</select>
								<div class="input-group col-md-3 p-0">
									<!-- <input type="date" class="form-control " placeholder="Search for..."> -->
									<span class="input-group-text btn btn-warning">Go!</span>
								</div>
							</div>
						</div>

						<div class="card-body">
							<div class="table-responsive export-table">
								<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
									<thead>
										<tr class="bg-gray-light">
											<th>S.no</th>
											<th>Volunteer ID </th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Email</th>
											<th>Reg. Date</th>
											<th>Location</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td> CS/AS/22/98
											</td>
											<td>
												RIMI GOGOI

												<br>
												<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">(View Profile)</a>
											</td>
											<td>6003153463</td>
											<td>ankumonikonwar@gmail.com</td>
											<td>20/07/2022 </td>
											<td>Assam </td>
											<td>
												<div class="btn-group dropstart">
													<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">

													</button>
													<ul class="dropdown-menu">
														<li><a href="#">Block</a></li>


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
</div>
</div>